<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
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
