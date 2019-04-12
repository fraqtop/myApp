<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Visitor
 *
 * @property string $uuid
 * @property string|null $platform
 * @property int $isHuman
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor whereIsHuman($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor wherePlatform($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor whereUuid($value)
 * @mixin \Eloquent
 * @property string $id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Visit[] $visits
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor whereId($value)
 */
class Visitor extends Model
{
    protected $guarded = [];
    public $incrementing = false;

    public function visits()
    {
        return $this->hasMany(Visit::class, 'visitorId');
    }

    public function isStoringSession($currentTime):bool
    {
        $lastVisit = $this->visits()
            ->orderBy('id', 'desc')
            ->first('created_at');
        if (!$lastVisit) {
            return true;
        }
        return $lastVisit->created_at->diffInMinutes($currentTime) > 5;
    }
}
