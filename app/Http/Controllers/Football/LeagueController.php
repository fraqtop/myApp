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
    public function get()
    {
        return view('football.index', ['leagues' => League::all()]);
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
            return view('football.standingsAPI', ['standings' => $standings]);
        }
        return view('football.standingsDB', ['standings' => $league->standings()]);
    }

    private function updateStandings($leagueId)
    {
        $standings = session('standings');
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
        session()->remove('standings');
        session()->remove('leagueAPI');
        return "standings have been updated";
    }

    public function setLogo(Request $request, $leagueId)
    {
        $league = League::find($leagueId, ['name', 'areaName', 'logo']);
        if($request->method() == 'GET')
        {
            return view('football.logo', ['league' => $league]);
        }
        $file = new File($request->file('newLogo'));
        $path = Storage::disk('public')->putFile('leagueLogos', $file);
        $league->logo = Storage::url($path);
        $league->save();
        return redirect('/football');
    }

    public function refreshLeagues()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        League::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        $leaguesAPI = Football::getLeagues(['plan' => 'TIER_ONE']);
        $leaguesAPIArray = [];
        $leaguesAPI->each(function ($league) use(&$leaguesAPIArray){
            $leaguesAPIArray[$league->id] = [
                $league->name,
                $league->area->name,
                new \DateTime($league->currentSeason->startDate),
                new \DateTime($league->currentSeason->endDate),
                $league->currentSeason->currentMatchday
            ];
        });
        $leaguesDB = League::all();
        $leaguesDB->each(function (League $league) use(&$leaguesAPIArray){
            if ($leagueData = @$leaguesAPIArray[$league->id])
            {
                unset($leaguesAPIArray[$league->id]);
            }
            else
            {
                $league->delete();
            }
        });
        foreach ($leaguesAPIArray as $id => $fields)
        {
            $newLeague = League::create([
                'id' =>  $id,
                'name' => $fields[0],
                'areaName' => $fields[1],
                'startDate' => $fields[2],
                'endDate' => $fields[3],
                'matchday' => $fields[4]
            ]);
            $leaguesDB->add($newLeague);
        }
        return redirect('/football');
    }
}
