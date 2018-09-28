<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Team
 *
 * @property int $id
 * @property string $name
 * @property string $shortName
 * @property string $tla
 * @property string $site
 * @property int $founded
 * @property string $colors
 * @property string $stadium
 * @property string $lastUpdated
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereColors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereFounded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereLastUpdated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereSite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereStadium($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereTla($value)
 * @mixin \Eloquent
 * @property string $logoURL
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereLogoURL($value)
 */
class Team extends Model
{
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

    public function updateSquad($newSquad)
    {

    }
}