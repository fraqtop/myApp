<?php

namespace App\Models\Football;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Football\Standings
 *
 * @property int $id
 * @property string $stage
 * @property string $type
 * @property string|null $group
 * @property string $stats
 * @property int $league_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Standings whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Standings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Standings whereLeagueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Standings whereStage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Standings whereStats($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Standings whereType($value)
 * @mixin \Eloquent
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
