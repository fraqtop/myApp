<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Post;
use App\User;
use Mail;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
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

    public function contact(Request $request)
    {
        if ($request->isMethod('post'))
        {
            if($request->post('contactAdvanced') != '')
            {
                Mail::to(User::find(1))->send(new ContactMail('anti spam system',
                    'spam message was caught', ''));
            }
            Mail::to(User::find(1))->send(new ContactMail($request->post('contactAuthor'),
                $request->post('contactMessage'), $request->post('contactFeedback')));
            return redirect('/');
        }
        return view('contact');

    }
}
