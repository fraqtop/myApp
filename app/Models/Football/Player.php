<?php

namespace App\Models\Football;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Football\Player
 *
 * @property int $id
 * @property string $name
 * @property string $position
 * @property string $birth
 * @property string $birthCountry
 * @property string $nationality
 * @property string $role
 * @property int $teamId
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Player whereBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Player whereBirthCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Player whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Player whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Player whereNationality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Player wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Player whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Player whereTeamId($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Player newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Player newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Player query()
 * @property int|null $roleId
 * @property int|null $nationalityId
 * @property int|null $birthCountryId
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Player whereBirthCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Player whereNationalityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Player whereRoleId($value)
 * @property int|null $positionId
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Player wherePositionId($value)
 */
class Player extends Model
{
    protected $guarded = [];
    public $timestamps = false;
}
