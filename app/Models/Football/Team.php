<?php

namespace App\Models\Football;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Football\Team
 *
 * @property int $id
 * @property string $name
 * @property string $shortName
 * @property string $logoURL
 * @property string $tla
 * @property string $site
 * @property string $founded
 * @property string $colors
 * @property string $stadium
 * @property \Illuminate\Support\Carbon $lastUpdated
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Football\Player[] $players
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Team whereColors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Team whereFounded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Team whereLastUpdated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Team whereLogoURL($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Team whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Team whereSite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Team whereStadium($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Team whereTla($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Football\Standings[] $standings
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Team query()
 */
class Team extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $dates = ['lastUpdated'];
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();
        static::saving(function (Team $team){
            $team->lastUpdated = $team->freshTimestamp();
        });
    }

    public function players()
    {
        return $this->hasMany(Player::class, 'teamId');
    }

    public function standings()
    {
        return $this->belongsToMany(Standings::class);
    }

    public function updateSquad($newSquad)
    {

    }
}