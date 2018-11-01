<?php

namespace App\models\Football;

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
 */
class Match extends Model
{
    private const STAGES = [
        'fullTime',
        'halfTime',
        'extraTime',
        'penalties'
    ];
    public $incrementing = false;
    protected $guarded = [];
    public $timestamps = false;
    protected $dates = ['lastUpdated', 'startAt'];

    public function results()
    {
        return $this->hasMany(Result::class, 'matchId');
    }

    public function setResults(array $newResults)
    {
        $results = $this->results();
        foreach (self::STAGES as $stage)
        {
            if ($newResults[$stage]->homeTeam)
            {
                $results->updateOrCreate([
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

    }

    protected static function boot()
    {
        parent::boot();
        static::saving(function(Match $match){
           $match->lastUpdated = $match->freshTimestamp();
        });
    }
}
