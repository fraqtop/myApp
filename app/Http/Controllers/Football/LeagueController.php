<?php

namespace App\Http\Controllers\Football;

use App\Models\Football\League;
use App\Models\Football\Standings;
use App\Models\Football\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Football;
use DB;
use Storage;
use Illuminate\Http\File;

class LeagueController extends Controller
{
    public function getStandings(int $leagueId)
    {
        $league = League::find($leagueId);
        $matchesCount = $league->matches()
            ->whereBetween('startAt', [$league->lastUpdated, Carbon::now()])
            ->count();
        if ($matchesCount or $league->isNeverUpdated()){
            $leagueAPI = Football::getLeague($leagueId);
            $lastUpdatedAPI = $leagueAPI->get('lastUpdated');
            if ($league->isOutdated($lastUpdatedAPI)) {
                $league->update([
                    'name' => $leagueAPI->get('name'),
                    'startDate' => $leagueAPI['currentSeason']->startDate,
                    'endDate' => $leagueAPI['currentSeason']->endDate,
                    'matchday' => $leagueAPI['currentSeason']->currentMatchday
                ]);
                $standings = $this->updateStandings($league);
            }
        } else {
            $standings = $league->standings;
        }
        return view('football.standings', [
            'standings' => $standings
        ]);
    }

    private function updateStandings(League $league)
    {
        $standingsAPI = Football::getLeagueStandings($league->id);
        $standingsDB = [];
        $teams = $league->teams();
        DB::beginTransaction();
        $standingsAPI->each(function ($standingAPI) use($league, &$standingsDB, $teams){
            $standingData = [
                'stage' => $standingAPI->stage,
                'type' => $standingAPI->type,
                'group' => $standingAPI->group
            ];
            $standingDB = $league->standings()->firstOrNew($standingData);
            if($isNewStandings = !$standingDB->id)
            {
                $standingDB->league_id = $league->id;
                $standingDB->seasonStart = $league->startDate;
                $standingDB->save();
            }
            foreach ($standingAPI->table as $row) {
                $stats = [
                    'points' => $row->points,
                    'won' => $row->won,
                    'draw' => $row->draw,
                    'lost' => $row->lost,
                    'goalsFor' => $row->goalsFor,
                    'goalsAgainst' => $row->goalsAgainst
                ];
                if ($isNewStandings) {
                    $team = $teams->where('id', $row->team->id)->first();
                    if (!$team) {
                        $team = Team::updateOrCreate([
                            'id' => $row->team->id
                        ],
                        [
                            'name' => $row->team->name
                        ]);
                    }
                    if (!$team->logoURL){
                        $team->logoURL = $row->team->crestUrl;
                    }
                    $team->save();
                    $standingDB->teams()->attach($row->team->id, $stats);
                } else {
                    $standingDB->teams()->updateExistingPivot($row->team->id, $stats);
                }
            }
            $standingsDB[] = $standingDB;
        });
        DB::commit();
        return collect($standingsDB);
    }

    public function setLogo(Request $request, $leagueId)
    {
        $league = League::find($leagueId);
        if($request->method() == 'GET')
        {
            return view('football.logo', ['league' => $league]);
        }
        if ($request->file('newLogoLocal')) {
            $file = new File($request->file('newLogoLocal'));
            $path = Storage::disk('public')->putFile('leagueLogos', $file);
            $path = Storage::url($path);
        }
        else{
            $path = $request->post('newLogoRemote') ?? "/img/code.jpg";
        }
        $league->update(['logo' => $path]);
        return redirect('/football');
    }
}
