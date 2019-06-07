<?php

namespace App\Http\Controllers\Football;

use App\Services\LeagueService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Football;
use Storage;
use Illuminate\Http\File;

class LeagueController extends Controller
{
    private $leagues;
    private $request;

    public function getStandings(int $leagueId)
    {
        $this->leagues->set($leagueId);
        if ($this->leagues->needsToUpdate()) {
            $this->leagues->refresh(Football::getLeague($leagueId));
            $standings = $this->leagues->getStandings(Football::getLeagueStandings($leagueId));
        } else {
            $standings = $this->leagues->getStandings();
        }
        return view('football.standings', [
            'standings' => $standings
        ]);
    }

    public function setLogo($leagueId)
    {
        $league = $this->leagues->get($leagueId);
        if($this->request->method() == 'GET')
        {
            return view('football.logo', ['league' => $league]);
        }
        if ($this->request->file('newLogoLocal')) {
            $file = new File($this->request->file('newLogoLocal'));
            $path = Storage::disk('public')->putFile('leagueLogos', $file);
            $path = Storage::url($path);
        }
        else{
            $path = $this->request->post('newLogoRemote') ?? "/img/code.jpg";
        }
        $league->update(['logo' => $path]);
        return redirect('/football');
    }

    public function __construct(LeagueService $leagueService, Request $request)
    {
        $this->leagues = $leagueService;
        $this->request = $request;
    }
}
