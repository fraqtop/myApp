<?php

namespace Tests\Feature;

use App\Models\Football\League;
use App\Services\LeagueService;
use App\Services\TeamService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StandingsLoadingTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @var LeagueService $leagues
     */
    private $leagues;

    protected function setUp(): void
    {
        parent::setUp();
        $this->leagues = new LeagueService(new TeamService());
    }

    public function testGetNotStartedSeason()
    {
        $league = $this->leagues->get(2001);
        $league->update([
            'startDate' => '9999-12-12'
        ]);
        $response = $this->get("/football/$league->id");
        $response->assertSee('not started yet');
    }

}
