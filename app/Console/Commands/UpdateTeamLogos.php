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
            case 2021:
                $href = 'https://www.eurosport.ru/football/premier-league/standing.shtml';
                break;
            case 2014:
                $href = 'https://www.eurosport.ru/football/la-liga/standing.shtml';
                break;
            case 2016:
                $href = 'https://www.eurosport.ru/football/championship/standing.shtml';
                break;
            case 2002:
                $href = 'https://www.eurosport.ru/football/bundesliga/standing.shtml';
                break;
            case 2015:
                $href = 'https://www.eurosport.ru/football/ligue-1/standing.shtml';
                break;
            case 2017:
                $href = 'https://www.eurosport.ru/football/portuguese-superliga/standing.shtml';
                break;
            case 2013:
                $href = 'https://www.eurosport.ru/football/brazilian-serie-a/standing.shtml';
                break;
            case 2003:
                $href = 'https://www.eurosport.ru/football/eredivisie/standing.shtml';
                break;
            default:
                $href = null;
        }
        if ($href){
            $teams = League::find($leagueId)->teams();
            $page = Goutte::request('get', $href);
            $page->filter('span.image')->each(function ($node) use(&$teams){
                $team = $teams->shift();
                if ($node->children('img')->count() > 0){
                    $team->logoURL = $node->children('img')->first()->attr('data-isg-lazy');
                    $team->save();
                }
            });
            $this->info('logos were updated');
        }
    }
}
