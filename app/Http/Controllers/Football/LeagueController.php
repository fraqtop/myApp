<?php

namespace App\Http\Controllers\Football;

use App\Models\Football\League;
use App\Models\Football\Standings;
use App\Models\Football\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Football;
use DB;
use Storage;
use Illuminate\Http\File;

class LeagueController extends Controller
{
    public function getStandings(Request $request, $leagueId)
    {
        if ($request->method() == 'PATCH')
        {
            return $this->updateStandings($leagueId);
        }
        $league = League::find($leagueId);
        $leagueAPI = Football::getLeague($leagueId);
        $lastUpdatedAPI = $leagueAPI->get('lastUpdated');
        if ($league->isOutdated($lastUpdatedAPI)) {
            $standings = Football::getLeagueStandings($leagueId);
            session()->put('leagueAPI', $leagueAPI);
            session()->put('standings', $standings);
            return view('football.standingsAPI', ['standings' => $standings->where('type', '=', 'TOTAL')]);
        }
        $standings = $league->standings;
        return view('football.standingsDB', [
            'standings' => $standings->where('type', '=', 'TOTAL')
        ]);
    }

    private function updateStandings($leagueId)
    {
        $standings = session('standings');
        DB::beginTransaction();
        $standings->each(function ($standingAPI) use($leagueId, &$updatedStandings){
            $standingData = [
                'stage' => $standingAPI->stage,
                'type' => $standingAPI->type,
                'group' => $standingAPI->group,
                'league_id' => $leagueId
            ];
            $isNewStandings = false;
            if(!$standingsDB = Standings::where($standingData)->first())
            {
                $standingsDB = Standings::create($standingData);
                $isNewStandings = true;
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
                    $team = Team::firstOrCreate([
                        'id' => $row->team->id,
                        'name' => $row->team->name
                    ]);
                    if (!$team->logoURL){
                        $team->logoURL = $row->team->crestUrl;
                    }
                    $standingsDB->teams()->attach($row->team->id, $stats);
                } else {
                    $standingsDB->teams()->updateExistingPivot($row->team->id, $stats);
                }
            }
            $leagueAPI = session()->get('leagueAPI');
            $league = League::find($leagueId);
            $league->update([
                'name' => $leagueAPI->get('name'),
                'areaName' => $leagueAPI->get('area')->name,
                'startDate' => $leagueAPI->get('currentSeason')->startDate,
                'endDate' => $leagueAPI->get('currentSeason')->endDate,
                'matchday' => $leagueAPI->get('currentSeason')->currentMatchday
            ]);
            $league->save();
        });
        DB::commit();
        session()->remove('standings');
        session()->remove('leagueAPI');
        return "standings have been updated";
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
