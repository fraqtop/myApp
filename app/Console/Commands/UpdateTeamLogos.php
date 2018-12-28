<?php

namespace App\Console\Commands;

use App\Models\Football\League;
use App\Models\Football\Team;
use Carbon\Carbon;
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

    private $hrefs;

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
        $this->hrefs = [
            2019 => 'https://www.eurosport.ru/football/serie-a/standing.shtml',
            2021 => 'https://www.eurosport.ru/football/premier-league/standing.shtml',
            2014 => 'https://www.eurosport.ru/football/la-liga/standing.shtml',
            2016 => 'https://www.eurosport.ru/football/championship/standing.shtml',
            2002 => 'https://www.eurosport.ru/football/bundesliga/standing.shtml',
            2015 => 'https://www.eurosport.ru/football/ligue-1/standing.shtml',
            2017 => 'https://www.eurosport.ru/football/portuguese-superliga/standing.shtml',
            2013 => 'https://www.eurosport.ru/football/brazilian-serie-a/standing.shtml',
            2003 => 'https://www.eurosport.ru/football/eredivisie/standing.shtml',
        ];
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (!$leagueId = $this->option('league')){
            foreach ($this->hrefs as $key => $value)
            {
                $this->updateTeams($key);
            }
        }
        else{
            if ($this->updateTeams($leagueId)){
                $this->info('logos were updated');
            }
            else{
                $this->info('there is no league with such id');
            }
        }
    }
    private function updateTeams(int $leagueId)
    {
        if ($league = League::find($leagueId)){
            $this->call('sync:teams', ['league' => $leagueId]);
            $teams = $league->teams();
            $this->info($league->name." teams on the way, count is".$teams->count());
            $page = Goutte::request('get', $this->hrefs[$leagueId]);
            $page->filter('span.image')->each(function ($node) use(&$teams){
                $team = $teams->shift();
                if ($node->children('img')->count() > 0){
                    $team->logoURL = $node->children('img')->first()->attr('data-isg-lazy');
                    $team->save();
                }
            });
            return true;
        }
        return false;
    }
}
