<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Blog\Category
 *
 * @property int $id
 * @property string $title
 * @property string $picture
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blog\Post[] $posts
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Category wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Category whereTitle($value)
 * @mixin \Eloquent
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
