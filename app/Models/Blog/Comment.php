<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use App\User;


/**
 * App\Models\Blog\Comment
 *
 * @property int $id
 * @property string $content
 * @property int $post_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Blog\Post $post
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Comment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Comment wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Comment whereUserId($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Comment query()
 */
class Comment extends Model
{
    protected $fillable = ['content', 'user_id'];

    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
