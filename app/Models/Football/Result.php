<?php

namespace App\Models\Football;

use Illuminate\Database\Eloquent\Model;

/**
 * App\models\Football\Result
 *
 * @property int $id
 * @property string $stage
 * @property int $homeScore
 * @property int $awayScore
 * @property int $matchId
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\Football\Result whereAwayScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\Football\Result whereHomeScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\Football\Result whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\Football\Result whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\Football\Result whereStage($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\Football\Result newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\Football\Result newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\Football\Result query()
 */
class Result extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
}
