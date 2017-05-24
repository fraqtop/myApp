<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class BlogController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

}
