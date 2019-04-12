<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Visit
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property string $visitorId
 * @property-read \App\Models\Visitor $visitor
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visit query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visit whereVisitorId($value)
 * @mixin \Eloquent
 */
class Visit extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $dates = ['created_at'];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class, 'visitorId');
    }
}
