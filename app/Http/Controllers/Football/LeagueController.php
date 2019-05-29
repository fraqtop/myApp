<?php

namespace App\Http\Controllers\Football;

use App\Models\Football\League;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Football;
use Storage;
use Illuminate\Http\File;

class LeagueController extends Controller
{
    public function getStandings(int $leagueId)
    {
        $league = League::find($leagueId);
        if ($league->hasOutdatedMatches() or $league->isNeverUpdated()){
            $leagueAPI = Football::getLeague($leagueId);
            $lastUpdatedAPI = $leagueAPI->get('lastUpdated');
            if ($league->isOutdated($lastUpdatedAPI)) {
                $league->update([
                    'name' => $leagueAPI->get('name'),
                    'startDate' => $leagueAPI['currentSeason']->startDate,
                    'endDate' => $leagueAPI['currentSeason']->endDate,
                    'matchday' => $leagueAPI['currentSeason']->currentMatchday
                ]);
                $standings = $league->getUpdatedStandings();
            }
        } else {
            $standings = $league->standings;
        }
        return view('football.standings', [
            'standings' => $standings
        ]);
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
