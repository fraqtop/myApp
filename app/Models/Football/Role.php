<?php

namespace App\Models\Football;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Football\Role
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Role whereName($value)
 * @mixin \Eloquent
 */
class Role extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
}
