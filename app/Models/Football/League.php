<?php

namespace App\Models\Football;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Football;
use DB;
use Illuminate\Support\Collection;


/**
 * App\Models\Football\League
 *
 * @property int $id
 * @property string $name
 * @property string $areaName
 * @property \Illuminate\Support\Carbon $startDate
 * @property \Illuminate\Support\Carbon $endDate
 * @property \Illuminate\Support\Carbon $lastUpdated
 * @property int $matchday
 * @property string|null $logo
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Football\Standings[] $standings
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\League whereAreaName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\League whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\League whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\League whereLastUpdated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\League whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\League whereMatchday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\League whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\League whereStartDate($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\League newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\League newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\League query()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Football\Match[] $matches
 * @property int|null $locationId
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\League whereLocationId($value)
 * @property-read \App\Models\Football\Location|null $location
 */
class League extends Model
{
    use UpdatesFromAPI;

    public $timestamps = false;
    public $incrementing = false;
    protected $guarded = ['lastUpdated'];
    protected $dates = [
        'startDate',
        'endDate',
        'lastUpdated'
    ];

    public function standings()
    {
        return $this->hasMany(Standings::class)
            ->where('seasonStart', '=', $this->startDate);
    }

    public function teams()
    {
        $teams = collect();
        $allStandings = $this->hasMany(Standings::class);
        $allStandings->each(function (Standings $standing) use(&$teams){
            $teams = $teams->merge($standing->teams);
        });
        $teams = $teams->unique('id');
        return $teams;
    }

    public function matches()
    {
        return $this->hasMany(Match::class, 'leagueId');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'locationId');
    }

    public static function boot()
    {
        parent::boot();
        static::saving(function (League $league){
                $league->lastUpdated = $league->freshTimestamp();
        });
        static::creating(function (League $league){
            $league->lastUpdated = Carbon::create()->setTimestamp(0);
        });
    }

    public function getUpdatedStandings(): Collection
    {
        $standingsAPI = Football::getLeagueStandings($this->id);
        $standingsDB = [];
        $teams = $this->teams();
        DB::beginTransaction();
        $standingsAPI->each(function ($standingAPI) use(&$standingsDB, $teams){
            $standingData = [
                'stage' => $standingAPI->stage,
                'type' => $standingAPI->type,
                'group' => $standingAPI->group
            ];
            $standingDB = $this->standings()->firstOrNew($standingData);
            if($isNewStandings = !$standingDB->id)
            {
                $standingDB->league_id = $this->id;
                $standingDB->seasonStart = $this->startDate;
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
                        $team = Team::updateOrCreate([
                            'id' => $row->team->id
                        ],
                            [
                                'name' => $row->team->name
                            ]);
                    }
                    if (!$team->logoURL){
                        $team->logoURL = $row->team->crestUrl;
                    }
                    $team->save();
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

    public function hasOutdatedMatches(): bool
    {
        return (bool)$this->matches()
            ->whereBetween('startAt', [$this->lastUpdated, Carbon::now()])
            ->count();
    }
}
