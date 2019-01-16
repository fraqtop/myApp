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
            if ($team->isOutdated($teamAPI->get('lastUpdated')))
            {
                $team = $this->update($team, $teamAPI);
            }
        }
        return view('football.team', ['team' => $team]);
    }

    function create($teamAPI)
    {
        $team = Team::create([
                'id' => $teamAPI->get('id'),
                'name' => $teamAPI->get('name'),
                'shortName' => $teamAPI->get('shortName'),
                'tla' => $teamAPI->get('tla'),
                'site' => $teamAPI->get('website'),
                'founded' => $teamAPI->get('founded'),
                'colors' => $teamAPI->get('clubColors'),
                'stadium' => $teamAPI->get('venue'),
            ]);
        $team->updateSquad($teamAPI->get('squad'));
        return $team;
    }

    function update(Team $teamDB, $teamAPI)
    {
        $teamDB->update([
            'name' => $teamAPI->get('name'),
            'tla' => $teamAPI->get('tla'),
            'site' => $teamAPI->get('website'),
            'founded' => $teamAPI->get('founded'),
            'colors' => $teamAPI->get('clubColors'),
            'stadium' => $teamAPI->get('venue')
        ]);
        $teamDB->updateSquad($teamAPI->get('squad'));
        return $teamDB;
    }
}
