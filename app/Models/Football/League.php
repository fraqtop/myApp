<?php

namespace App\Models\Football;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;



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
        return $this->hasMany(Standings::class);
    }

    public function teams()
    {
        $teams = collect();
        $this->standings->each(function (Standings $standing) use(&$teams){
            $teams = $teams->merge($standing->teams);
        });
        $teams = $teams->unique('id');
        return $teams;
    }

    public function matches()
    {
        return $this->hasMany(Match::class, 'leagueId');
    }

    public function isOutdated(string $lastUpdate)
    {
        $lastUpdate = Carbon::createFromTimeString($lastUpdate);
        if ($lastUpdate > $this->lastUpdated) {
            return true;
        }
        return false;
    }

    public function isNeverUpdated()
    {
        return $this->lastUpdated == Carbon::createFromTimestamp(0);
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
}
