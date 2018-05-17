<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Post;
use App\User;
use Faker\Provider\DateTime;
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

    private function isSpam(Request $request)
    {
        $fakeField = $request->post('contactAdvanced');
        $postingPeriod = (new \DateTime())->getTimestamp() - $request->post('contactTime');
        $keyPressDiff = (int)$request->post('contactCounter') - strlen($request->post('contactMessage'));
        if($fakeField != null || $postingPeriod < 5 || $keyPressDiff < 0)
        {
            return true;
        }
        return false;
    }

    public function contact(Request $request)
    {
        if ($request->isMethod('post'))
        {
            if($this->isSpam($request))
            {
                Mail::to(User::find(1))->send(new ContactMail('anti spam system',
                    'spam message was caught', ''));
            }
            else
                Mail::to(User::find(1))->send(new ContactMail($request->post('contactAuthor'),
                    $request->post('contactMessage'), $request->post('contactFeedback')));
            return redirect('/');
        }
        return view('contact');

    }
}
