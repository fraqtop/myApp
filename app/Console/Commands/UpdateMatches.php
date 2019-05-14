<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Football\Match;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Football;

class UpdateMatches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:matches {--days=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates matches data for certain date 
    or for a few days with option "days"';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $endDate = Carbon::now();
        if ($days = $this->option('days')) {
            $endDate->addDays($days);
        }
        $endDate = $endDate->format('Y-m-d');
        $matches = Football::getMatches([
            'dateFrom' => $yesterday,
            'dateTo' => $endDate
        ]);
        $matches->each(function ($matchAPI) {
            if ($matchDB = Match::find($matchAPI->id)) {
                $lastUpdateAPI = Carbon::createFromTimeString($matchAPI->lastUpdated);
                if($isOutdated = $matchDB->isOutdated($lastUpdateAPI)) {
                    $matchDB->update([
                        'referee' => $matchAPI->referees[0]->name ?? 'Unknown Person',
                        'startAt' => Carbon::createFromTimeString($matchAPI->utcDate),
                    ]);
                }
            }
            else
            {
                $isOutdated = true;
                $this->comment("updating match between ".$matchAPI->homeTeam->name." and ".$matchAPI->awayTeam->name);
                $matchData = [
                    'id' => $matchAPI->id,
                    'referee' => $matchAPI->referees[0]->name ?? "Unknown Person",
                    'startAt' => Carbon::createFromTimeString($matchAPI->utcDate),
                    'lastUpdated' => Carbon::createFromTimeString($matchAPI->lastUpdated),
                    'homeId' => $matchAPI->homeTeam->id,
                    'awayId' => $matchAPI->awayTeam->id,
                    'leagueId' => $matchAPI->competition->id
                ];
                try{
                    $matchDB = Match::create($matchData);
                } catch (QueryException $e) {
                    $this->call('sync:teams', ['league' => $matchAPI->competition->id]);
                    $matchDB = Match::create($matchData);
                }
            }
            if ($matchAPI->status === 'FINISHED' and $isOutdated)
            {
                $matchDB->setResults((array)$matchAPI->score);
            }
        });
    }
}
