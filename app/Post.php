<?php

namespace App;

class Post extends \Eloquent
{
    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
