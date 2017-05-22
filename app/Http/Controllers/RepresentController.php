<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;

class RepresentController extends Controller
{
    function indexAction()
    {
        return view('represent.index');
    }
    function blogAction()
    {
        return view('represent.posts', ['posts' => Post::all()]);
    }
}
