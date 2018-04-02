<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {}
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lastPosts = Post::take(3)
            ->orderBy('created_at', 'desc')
            ->with('category')
            ->get();
        return view('index', ['posts' => $lastPosts]);
    }
    public function profile()
    {
        return view('home');
    }
}
