<?php

namespace App\Http\Controllers\Football;

use App\Models\Football\Team;
use Carbon\Carbon;
use Football;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class TeamController extends Controller
{
    function get($teamId)
    {
        $teamAPI = Football::getTeam($teamId);
        if ( !$team = Team::find($teamId))
        {
            $team = $this->create($teamAPI);
        }
        else
        {
            $lastUpdate = Carbon::createFromTimeString($teamAPI->get('lastUpdated'));
            if ($lastUpdate > $team->lastUpdated)
            {
                $team = $this->update($team, $teamAPI);
            }
        }
        return view('football.team', ['team' => $team]);
    }

    function create($teamAPI)
    {
        return Team::create([
                'id' => $teamAPI->get('id'),
                'name' => $teamAPI->get('name'),
                'shortName' => $teamAPI->get('shortName'),
                'tla' => $teamAPI->get('tla'),
                'logoURL' => $teamAPI->get('crestUrl'),
                'site' => $teamAPI->get('website'),
                'founded' => $teamAPI->get('founded'),
                'colors' => $teamAPI->get('clubColors'),
                'stadium' => $teamAPI->get('venue'),
            ]);
    }

    function update(Team $teamDB, $teamAPI)
    {
        $teamDB->name = $teamAPI->get('name');
        $teamDB->shortName = $teamAPI->get('shortName');
        $teamDB->tla = $teamAPI->get('tla');
        $teamDB->logoURL = $teamAPI->get('crestUrl');
        $teamDB->site = $teamAPI->get('website');
        $teamDB->founded = $teamAPI->get('founded');
        $teamDB->colors = $teamAPI->get('clubColors');
        $teamDB->stadium = $teamAPI->get('venue');
        $teamDB->save();
        $teamDB->updateSquad($teamAPI->get('squad'));
        return $teamDB;
    }
}
