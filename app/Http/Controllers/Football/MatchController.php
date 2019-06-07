<?php

namespace App\Http\Controllers\Football;

use App\Services\LeagueService;
use App\Services\MatchService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class MatchController extends Controller
{
    private $matches;
    private $leagues;
    private $request;

    public function get($date = null)
    {
        if ($date) {
            $matchDay = Carbon::createFromFormat('Y-m-d', $date);
            $matchDay->setTime(0, 0, 0, 0);
        }
        else{
            $matchDay = Carbon::today();
        }
        $matches = $this->matches->getByDate($matchDay, $matchDay->copy()->addDay());
        return view('football.index', [
            'matches' => $matches,
            'leagues' => $this->leagues->getAll(),
            'date' => $matchDay
        ]);
    }

    public function __construct(MatchService $matchService, LeagueService $leagueService, Request $request)
    {
        $this->matches = $matchService;
        $this->leagues = $leagueService;
        $this->request = $request;
    }
}
