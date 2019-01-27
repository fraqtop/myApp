<?php

namespace App\Console\Commands;

use App\Models\Football\League;
use App\Models\Football\Team;
use Illuminate\Console\Command;
use Football;

class UpdateTeams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:teams {league}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates teams if they don\'t exist';

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
        if ($leagueId = $this->argument('league')){
            if (League::find($leagueId)->isNeverUpdated()){
                $teams = Football::getLeagueTeams($leagueId);
                $teams->each(function ($team){
                    Team::updateOrCreate([
                        'id' => $team->id,
                        'name' => $team->name,
                    ]);
                });
            }
        }
    }
}
