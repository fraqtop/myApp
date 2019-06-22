<?php

namespace App\Http\Controllers\Football;

use App\Services\FileService;
use App\Services\LeagueService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Football;

class LeagueController extends Controller
{
    private $leagues;
    private $files;
    private $request;

    public function getStandings(int $leagueId)
    {
        $this->leagues->set($leagueId);
        if ($this->request->query('season', null)) {
            $standings = $this->leagues->getStandings(null, $this->request->query('season'));
            if (!$standings->count()) {
                return view('reports.empty-season');
            }
            return view('football.standings', [
                'standings' => $standings
            ]);
        }
        if ($this->leagues->needsToUpdate()) {
            $this->leagues->refresh(Football::getLeague($leagueId));
            $standings = $this->leagues->getStandings(Football::getLeagueStandings($leagueId));
        } else {
            $standings = $this->leagues->getStandings();
        }
        if (!$standings->count()) {
            return view('reports.empty-season');
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
        if ($this->request->hasFile('newLogoLocal')) {
            $path = $this->files->save($this->request->file('newLogoLocal'));
        }
        else{
            $path = $this->request->post('newLogoRemote') ?? $this->files->getDefaultLink();
        }
        $league->update(['logo' => $path]);
        return redirect('/football');
    }

    public function __construct(LeagueService $leagueService, FileService $fileService, Request $request)
    {
        $this->leagues = $leagueService;
        $this->files = $fileService;
        $this->request = $request;
    }
}
