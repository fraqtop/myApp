<?php

namespace App\models\Football;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\models\Football\Match
 *
 * @property int $id
 * @property string $referee
 * @property string $startAt
 * @property string $lastUpdated
 * @property int $homeId
 * @property int $awayId
 * @property int $leagueId
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\Football\Match whereAwayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\Football\Match whereHomeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\Football\Match whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\Football\Match whereLastUpdated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\Football\Match whereLeagueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\Football\Match whereReferee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\Football\Match whereStartAt($value)
 * @mixin \Eloquent
 * @property int|null $thrillRating
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\models\Football\Result[] $results
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\Football\Match whereThrillRating($value)
 * @property-read \App\Models\Football\Team $awayTeam
 * @property-read \App\Models\Football\Team $homeTeam
 * @property-read \App\Models\Football\League $league
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\Football\Match newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\Football\Match newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\Football\Match query()
 */
class Match extends Model
{
    private const STAGES = [
        'halfTime',
        'fullTime',
        'extraTime',
        'penalties'
    ];
    public $incrementing = false;
    protected $guarded = [];
    public $timestamps = false;
    protected $dates = ['lastUpdated', 'startAt'];

    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'homeId');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'awayId');
    }

    public function league()
    {
        return $this->belongsTo(League::class, 'leagueId');
    }

    public function results()
    {
        return $this->hasMany(Result::class, 'matchId');
    }

    public function setResults(array $newResults)
    {
        foreach (self::STAGES as $stage)
        {
            if ($newResults[$stage]->homeTeam !== null)
            {
                $this->results()->updateOrCreate([
                    'stage' => $stage
                ],
                [
                    'homeScore' => $newResults[$stage]->homeTeam,
                    'awayScore' => $newResults[$stage]->awayTeam
                ]
                );
            }
        }
        $this->updateRating();
    }

    public function updateRating($additionalStats = null)
    {
        $results = $this->results;
        $homeScored = 0;
        $awayScored = 0;
        $results->each(function (Result $result) use(&$homeScored, &$awayScored){
            $homeScored += $result->homeScore - $homeScored;
            $awayScored += $result->awayScore - $awayScored;
        });
        $totalGoals = $homeScored + $awayScored;
        $this->thrillRating = $totalGoals - 3;
        if(abs($homeScored - $awayScored) < 3 and $totalGoals > 3){
            $this->thrillRating += 2;
        }
        $this->thrillRating = $this->thrillRating < 0 ? 0: $this->thrillRating;
        $this->save();
    }

    public function isOutdated(string $lastUpdate)
    {
        $lastUpdate = Carbon::createFromTimeString($lastUpdate);
        return $lastUpdate > $this->lastUpdated;
    }

    protected static function boot()
    {
        parent::boot();
        static::saving(function(Match $match){
           $match->lastUpdated = $match->freshTimestamp();
        });
    }
}
