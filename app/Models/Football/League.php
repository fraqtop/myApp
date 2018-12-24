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
        $standings = $this->standings;
        dd($standings);
        $this->standings->each(function (Standings $standing) use(&$teams){
            $teams->merge($standing->teams);
        });
        dd($teams);
    }

    public function isOutdated(string $lastUpdate)
    {
        $lastUpdate = Carbon::createFromTimeString($lastUpdate);
        if ($lastUpdate > $this->lastUpdated) {
            return true;
        }
        return false;
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
