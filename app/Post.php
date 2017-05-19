<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    function getUser()
    {
        return $this->belongsTo(User::class);
    }
}
