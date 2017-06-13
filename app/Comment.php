<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
