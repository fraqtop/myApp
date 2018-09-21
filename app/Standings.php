<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Standings
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $stage
 * @property string $type
 * @property string|null $group
 * @property string $stats
 * @property int $league_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Standings whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Standings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Standings whereLeagueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Standings whereStage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Standings whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Standings whereStats($value)
 */
class Standings extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $casts = [
      'table' => 'collection'
    ];

    public function getStatsAttribute($value)
    {
        return json_decode($value);
    }

    public function setStatsAttribute($value)
    {
        $this->attributes['stats'] = json_encode($value);
    }
}
