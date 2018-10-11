<?php

namespace App\Models\Blog;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\User;

/**
 * App\Models\Blog\Post
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string|null $picture
 * @property int $user_id
 * @property int $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Blog\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blog\Comment[] $comments
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post whereUserId($value)
 * @mixin \Eloquent
 */
class Post extends Model
{
    protected $fillable = ['title', 'content', 'picture', 'category_id'];
    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    function comments()
    {
        return $this->hasMany(Comment::class);
    }
    function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    function getPicture()
    {
        if ($this->picture)
            return $this->picture;
        return $this->category->picture;
    }
    function getUpdatedAtAttribute($value)
    {
        $value = Carbon::createFromTimeString($value)->setTimezone('Europe/Moscow');
        return $value->format('d M Y H:i');
    }
}
