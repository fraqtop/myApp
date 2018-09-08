<?php

namespace App\Http\Controllers\Football;

use App\League;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Football;

class LeagueController extends Controller
{
    function get()
    {
        $leagues = $this->update();
        return view('football.index', ['leagues' => $leagues]);
    }

    public function update()
    {
        $leaguesAPI = Football::getLeagues(['plan' => 'TIER_ONE']);
        $leaguesAPIArray = [];
        $leaguesAPI->each(function ($league) use(&$leaguesAPIArray){
           $leaguesAPIArray[$league->id] = [$league->name, $league->currentSeason->id, new \DateTime($league->lastUpdated)];
        });
        $leaguesDB = League::all();
        $leaguesDB->each(function (League $league) use(&$leaguesAPIArray, &$updated){
            if ($leagueData = @$leaguesAPIArray[$league->id])
            {
                $dbTime = new \DateTime($league->lastUpdated, new \DateTimeZone('z'));
                if ($dbTime != $leagueData[2])
                {
                    $league->name = $leagueData[0];
                    $league->lastSeasonId = $leagueData[1];
                    $league->lastUpdated = $leagueData[2];
                    $league->save();
                    $updated++;
                }
            unset($leaguesAPIArray[$league->id]);
            }
            else
            {
                $league->delete();
            }
        });
        foreach ($leaguesAPIArray as $id => $fields)
        {
            League::create([
                'id' =>  $id,
                'name' => $fields[0],
                'lastSeasonId' => $fields[1],
                'lastUpdated' => $fields[2]
            ]);
        }
        return $leaguesDB;
    }
}
