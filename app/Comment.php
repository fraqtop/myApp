<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['content'];

    function user()
    {
        $this->belongsTo(User::class, 'user_id');
    }
    function post()
    {
        $this->belongsTo(Post::class, 'post_id');
    }
}
