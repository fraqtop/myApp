<?php


namespace App\Services;


use Illuminate\Support\Collection;
use App\Models\Football\Match;

class MatchService
{
    public function getByDate(\DateTime $start, \DateTime $end): Collection
    {
        return Match::with(['homeTeam', 'awayTeam', 'league', 'results'])
            ->whereBetween('startAt', [$start, $end])
            ->orderBy('startAt')
            ->get();
    }
}