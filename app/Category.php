<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Category
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Post[] $posts
 * @mixin \Eloquent
 * @property int $id
 * @property string $title
 * @property string $picture
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereTitle($value)
 */
class Category extends Model
{
    protected $fillable = ['title', 'picture'];
    public $timestamps = false;
    function posts()
    {
        return $this->hasMany(Post::class);
    }
}
