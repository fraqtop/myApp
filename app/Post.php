<?php

namespace App;

class Post extends \Eloquent
{
    protected $fillable = ['title', 'content'];
    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
