<?php

namespace App\Http\Controllers\Football;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Football\{
    League, Match, Result
};


class MatchController extends Controller
{
    public function get(Request $request, $date = null)
    {
        if ($date) {
            $matchDay = Carbon::createFromFormat('Y-m-d', $date);
            $matchDay->setTime(0, 0, 0, 0);
        }
        else{
            $matchDay = Carbon::today();
        }
        $matches = Match::with(['homeTeam', 'awayTeam', 'league', 'results'])
            ->whereBetween('startAt', [$matchDay, $matchDay->copy()->addDay()])
            ->orderBy('startAt')
            ->get();
        return view('football.index', [
            'matches' => $matches,
            'leagues' => League::all(),
            'date' => $matchDay
        ]);
    }
}
