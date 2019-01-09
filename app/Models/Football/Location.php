<?php

namespace App\Models\Football;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Football\Location
 *
 * @property int $id
 * @property string $name
 * @property string $flagURL
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Location newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Location newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Location query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Location whereFlagURL($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Location whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Location whereName($value)
 * @mixin \Eloquent
 */
class Location extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
}
