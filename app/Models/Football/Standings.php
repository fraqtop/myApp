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
 * @property int $league_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Football\Team[] $teams
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Standings whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Standings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Standings whereLeagueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Standings whereStage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Standings whereType($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Standings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Standings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Standings query()
 */
class Standings extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    public function teams()
    {
        return $this->belongsToMany(Team::class)->withPivot([
            'points',
            'won',
            'draw',
            'lost',
            'goalsFor',
            'goalsAgainst'
        ])->orderByRaw('`points` desc, `pivot_goalsFor` - `pivot_goalsAgainst` desc, `pivot_goalsFor` desc');
    }
}
