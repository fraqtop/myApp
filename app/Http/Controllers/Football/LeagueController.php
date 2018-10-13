<?php

namespace App\Http\Controllers\Football;

use App\Models\Football\League;
use App\Models\Football\Standings;
use App\Models\Football\Team;
use Carbon\Carbon;
use Faker\Provider\zh_TW\DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Football;

class LeagueController extends Controller
{
    public function get()
    {
        return view('football.index', ['leagues' => League::all()]);
    }

    public function getStandings($leagueId)
    {
        $league = League::find($leagueId);
        $leagueAPI = Football::getLeague($leagueId);
        $lastUpdatedAPI = Carbon::createFromTimeString($leagueAPI->get('lastUpdated'));
        if ($lastUpdatedAPI > $league->lastUpdated) {
            $standings = $this->updateStandings($leagueId);
            $league->update([
                'name' => $leagueAPI->get('name'),
                'areaName' => $leagueAPI->get('area')->name,
                'startDate' => $leagueAPI->get('currentSeason')->startDate,
                'endDate' => $leagueAPI->get('currentSeason')->endDate,
                'matchday' => $leagueAPI->get('currentSeason')->currentMatchday
            ]);
            $league->save();
        }
        else {
            $standings = $league->getStandings();
        }
        $standings = collect($standings);
        return view('football.overview', [
            'league' => $league,
            'standings' => $standings
        ]);
    }

    private function updateStandings($leagueId)
    {
        $updatedStandings = [];
        $standings = Football::getLeagueStandings($leagueId);
        $standings->each(function ($standingAPI) use($leagueId, &$updatedStandings){
            $standingData = [
                'stage' => $standingAPI->stage,
                'type' => $standingAPI->type,
                'group' => $standingAPI->group,
                'league_id' => $leagueId
            ];
            $standingsDB = Standings::firstOrCreate($standingData);
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
                if(!$team = Team::find($row->team->id)) {
                    Team::create([
                        'id' => $row->team->id,
                        'name' => $row->team->name,
                        'logoURL' => $row->team->crestUrl
                    ]);
                    $standingsDB->teams()->attach($row->team->id, $stats);
                }
                else {
                    $standingsDB->teams()->updateExistingPivot($row->team->id, $stats);
                }
            }
            $updatedStandings[] = $standingsDB;
        });
        return collect($updatedStandings);
    }

    public function refreshLeagues()
    {
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
