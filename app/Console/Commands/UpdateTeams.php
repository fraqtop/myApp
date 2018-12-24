<?php

namespace App\Console\Commands;

use App\Models\Football\Team;
use Illuminate\Console\Command;

class UpdateTeams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:teams {teams}';

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
        foreach ($this->argument('teams') as $team) {
            if(!Team::find($team['id'])) {
                Team::create([
                    'id' => $team['id'],
                    'name' => $team['name']
                ]);
            }
        }
    }
}
