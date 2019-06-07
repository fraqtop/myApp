<?php


namespace App\Services;


use App\Models\Football\{League, Location};
use Carbon\Carbon;
use Illuminate\Support\Collection;
use DB;

class LeagueService
{
    private $unusedTournaments;
    private $noUpdateDaysLimit;
    private $teams;
    /**
     * @var League
     */
    private $league;

    public function refresh($data): ?League
    {
        if (!in_array($data->id, $this->unusedTournaments)) {
            return League::updateOrCreate(
                [
                    'id' =>  $data->id
                ],
                [
                    'name' => $data->name,
                    'locationId' => Location::where('name', '=', $data->area->name)->first()->id ?? null,
                    'startDate' => new \DateTime($data->currentSeason->startDate),
                    'endDate' => new \DateTime($data->currentSeason->endDate),
                    'matchday' => $data->currentSeason->currentMatchday,
                ]
            );
        }
        return null;
    }

    public function get(int $id): League
    {
        if (!$this->league) {
            $this->set($id);
        }
        return $this->league;
    }

    public function set(int $id)
    {
        if (!$this->league || $this->league->id !== $id) {
            $this->league = League::find($id);
        }
    }

    public function getAll()
    {
        return League::with('location')->get();
    }

    public function needsToUpdate(): bool
    {
        $currentDate = Carbon::now();
        if ($this->league->hasOutdatedMatches()) {
            return true;
        }
        if ($this->league->lastUpdated->diffInDays($currentDate) > $this->noUpdateDaysLimit) {
            return true;
        }
        return false;
    }

    public function getStandings(Collection $data = null): Collection
    {
        return $data === null ? $this->league->standings: $this->updateStandings($data);
    }

    private function updateStandings(Collection $data): Collection
    {
        $standingsDB = [];
        $teams = $this->league->teams();
        DB::beginTransaction();
        $data->each(function ($standingAPI) use(&$standingsDB, $teams){
            $standingData = [
                'stage' => $standingAPI->stage,
                'type' => $standingAPI->type,
                'group' => $standingAPI->group
            ];
            $standingDB = $this->league->standings()->firstOrNew($standingData);
            if($isNewStandings = !$standingDB->id)
            {
                $standingDB->league_id = $this->league->id;
                $standingDB->seasonStart = $this->league->startDate;
                $standingDB->save();
            }
            foreach ($standingAPI->table as $row) {
                $stats = [
                    'points' => $row->points,
                    'won' => $row->won,
                    'draw' => $row->draw,
                    'lost' => $row->lost,
                    'goalsFor' => $row->goalsFor,
                    'goalsAgainst' => $row->goalsAgainst
                ];
                if ($isNewStandings) {
                    $team = $teams->where('id', $row->team->id)->first();
                    if (!$team) {
                        $this->teams->refresh($row->team);
                    }
                    $standingDB->teams()->attach($row->team->id, $stats);
                } else {
                    $standingDB->teams()->updateExistingPivot($row->team->id, $stats);
                }
            }
            $standingsDB[] = $standingDB;
        });
        DB::commit();
        return collect($standingsDB);
    }

    public function __construct()
    {
        $this->unusedTournaments = [2000, 2018];
        $this->noUpdateDaysLimit = 14;
        $this->teams = new TeamService();
    }
}