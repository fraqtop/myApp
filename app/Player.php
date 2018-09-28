<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Player
 *
 * @property int $id
 * @property string $name
 * @property string $position
 * @property string $birth
 * @property string $birthCountry
 * @property string $nationality
 * @property string $role
 * @property int $teamId
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player whereBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player whereBirthCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player whereNationality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player whereTeamId($value)
 * @mixin \Eloquent
 */
class Player extends Model
{
    //
}
