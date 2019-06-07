<?php

namespace App\Console\Commands;

use App\Services\LeagueService;
use Illuminate\Console\Command;
use Football;

class UpdateLeagues extends Command
{
    private $leagues;

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
     * @param LeagueService $leagueService
     *
     * @return void
     */
    public function __construct(LeagueService $leagueService)
    {
        parent::__construct();
        $this->leagues = $leagueService;
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
            $this->leagues->refresh($league);
        });
        $this->info('leagues were updated');
    }
}
