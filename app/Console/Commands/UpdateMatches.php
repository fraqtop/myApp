<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\models\Football\Match;
use Illuminate\Console\Command;
use Football;

class UpdateMatches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'matches:sync {--days=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates matches data for certain date 
    or for a few days with flag';

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
        $matches->each(function ($matchAPI) use ($yesterday){
            if ($matchDB = Match::find($matchAPI->id)) {
                $lastUpdateAPI = Carbon::createFromTimeString($matchAPI->lastUpdated);
                if($isOutdated = $matchDB->isOutdated($lastUpdateAPI)) {
                    $matchDB->update([
                        'referee' => $matchAPI->referees[0]->name ?? 'Unknown Person',
                        'startAt' => Carbon::createFromTimeString($matchAPI->utcDate),
                        'homeId' => $matchAPI->homeTeam->id,
                        'awayId' => $matchAPI->awayTeam->id
                    ]);
                }
            }
            else
            {
                $isOutdated = true;
                $this->call('teams:sync', [
                    'teams' => [(array)$matchAPI->homeTeam, (array)$matchAPI->awayTeam]
                ]);
                $matchDB = Match::create([
                    'id' => $matchAPI->id,
                    'referee' => $matchAPI->referees[0]->name ?? "Unknown Person",
                    'startAt' => Carbon::createFromTimeString($matchAPI->utcDate),
                    'lastUpdated' => Carbon::createFromTimeString($matchAPI->lastUpdated),
                    'homeId' => $matchAPI->homeTeam->id,
                    'awayId' => $matchAPI->awayTeam->id,
                    'leagueId' => $matchAPI->competition->id
                ]);
            }
            if ($matchDB->startAt < Carbon::now() and $isOutdated)
            {
                $matchDB->setResults((array)$matchAPI->score);
            }
        });
    }
}
