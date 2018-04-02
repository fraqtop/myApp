<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Comment
 *
 * @property-read \App\Post $post
 * @property-read \App\User $user
 * @mixin \Eloquent
 * @property int $id
 * @property string $content
 * @property int $post_id
 * @property int $user_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereUserId($value)
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
