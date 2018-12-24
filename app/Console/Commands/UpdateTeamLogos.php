<?php

namespace App\Console\Commands;

use App\Models\Football\League;
use App\Models\Football\Team;
use Illuminate\Console\Command;
use Goutte;


class UpdateTeamLogos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:logos {--league=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates logos of league teams';

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
     * @return mixed
     */
    public function handle()
    {
        $leagueId = $this->option('league');
        switch ($leagueId){
            case 2019:
                $href = 'https://www.eurosport.ru/football/serie-a/standing.shtml';
                break;
            case 2001:
                $href = 'qweqweqew';
                break;
            default:
                $href = '';
        }
        League::find($leagueId)->teams();
        $page = Goutte::request('get', $href);
        $page->filter('span.image>img')->each(function ($node){
            $this->info($node->attr('data-isg-lazy'));
        });
    }
}
