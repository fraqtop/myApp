<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Football;
use App\Models\Football\League;

class UpdateLeagues extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:leagues';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Loads leagues to database';

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
        $leaguesAPI = Football::getLeagues(['plan' => 'TIER_ONE']);
        $leagues = [];
        $leaguesAPI->each(function ($league) use(&$leagues){
            League::updateOrCreate([
                'id' =>  $league->id,
                'name' => $league->name,
                'areaName' => $league->area->name,
                'startDate' => new \DateTime($league->currentSeason->startDate),
                'endDate' => new \DateTime($league->currentSeason->endDate),
                'matchday' => $league->currentSeason->currentMatchday,
            ]);
        });
    }
}
