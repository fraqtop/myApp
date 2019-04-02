<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $dates = ['created_at'];
}
