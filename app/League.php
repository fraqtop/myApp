<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\League
 *
 * @property int $id
 * @property string $name
 * @property int $lastSeasonId
 * @property string $lastUpdated
 * @method static \Illuminate\Database\Eloquent\Builder|\App\League whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\League whereLastSeasonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\League whereLastUpdated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\League whereName($value)
 * @mixin \Eloquent
 * @property string $startDate
 * @property string $endDate
 * @property int $matchday
 * @method static \Illuminate\Database\Eloquent\Builder|\App\League whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\League whereMatchday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\League whereStartDate($value)
 * @property string $areaName
 * @method static \Illuminate\Database\Eloquent\Builder|\App\League whereAreaName($value)
 */
class League extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $guarded = ['lastUpdated'];
    protected $dates = [
        'startDate',
        'endDate',
        'lastUpdated'
    ];
    public function getStandings()
    {
        return $this->hasMany(Standings::class)->get();
    }

    public static function boot()
    {
        parent::boot();
        static::saving(function (League $league){
                $league->lastUpdated = $league->freshTimestamp();
        });
        static::creating(function (League $league){
            $league->lastUpdated = (new \DateTime())->setTimestamp(0);
        });
    }
}
