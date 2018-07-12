<?php
namespace App\Http\Controllers;

use App\Http\Controllers\blog\PostController;
use App\Post;
use Request;

class AdminController extends PostController
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.index', ['posts' => Post::all()]);
    }
}
