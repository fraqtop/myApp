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
    private const LEAGUES_COUNT = 10;

    public function get()
    {
        $leagues = League::count() < self::LEAGUES_COUNT ? $this->loadLeagues(): League::all();
        $topLeagues = $leagues->reject(function (League $element){
           return !$element->isFavorite();
        });
        $leagues = $leagues->diff($topLeagues);
        return view('football.index', ['leagues' => $leagues, 'topLeagues' => $topLeagues]);
    }

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
        $standings = $league->standings->where('type', '=', 'TOTAL');
        return view('football.standingsDB', ['standings' => $standings]);
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
                    'position' => $row->position,
                    'points' => $row->points,
                    'won' => $row->won,
                    'draw' => $row->draw,
                    'lost' => $row->lost,
                    'goalsFor' => $row->goalsFor,
                    'goalsAgainst' => $row->goalsAgainst
                ];
                if ($isNewStandings) {
                    Team::firstOrCreate([
                        'id' => $row->team->id,
                        'name' => $row->team->name,
                        'logoURL' => $row->team->crestUrl
                    ]);
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
        $file = new File($request->file('newLogo'));
        $path = Storage::disk('public')->putFile('leagueLogos', $file);
        $path = Storage::url($path);
        $league->update(['logo' => $path]);
        return redirect('/football');
    }

    public function loadLeagues()
    {
        $leaguesAPI = Football::getLeagues(['plan' => 'TIER_ONE']);
        $leagues = [];
        $leaguesAPI->each(function ($league) use(&$leagues){
            $newLeague = League::create([
                'id' =>  $league->id,
                'name' => $league->name,
                'areaName' => $league->area->name,
                'startDate' => new \DateTime($league->currentSeason->startDate),
                'endDate' => new \DateTime($league->currentSeason->endDate),
                'matchday' => $league->currentSeason->currentMatchday
            ]);
            $leagues[] = $newLeague;
        });
        return collect($leagues);
    }
}
