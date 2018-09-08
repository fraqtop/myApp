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
 */
class League extends Model
{
    public $timestamps = false;
    protected $fillable = ['id', 'name', 'lastSeasonId', 'lastUpdated'];
}
