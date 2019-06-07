<?php

namespace App\Console\Commands;

use App\Models\Football\League;
use App\Models\Football\Team;
use App\Services\TeamService;
use Illuminate\Console\Command;
use Football;

class UpdateTeams extends Command
{
    private $teams;
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
    public function __construct(TeamService $teamService)
    {
        parent::__construct();
        $this->teams = $teamService;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if ($leagueId = $this->argument('league')){
            $this->comment("searching for new teams for $leagueId");
            $teams = Football::getLeagueTeams($leagueId);
            $teams->each(function ($team){
                $this->teams->refresh($team);
            });
        }
    }
}
