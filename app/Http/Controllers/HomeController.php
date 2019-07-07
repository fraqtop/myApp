<?php

namespace App\Http\Controllers;

use App\Services\FileService;
use App\Services\MailService;
use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $users;
    private $posts;
    private $mails;
    private $files;
    private $request;

    public function index()
    {
        $lastPosts = $this->posts->getMany(3);
        $picture = $this->users->get()->avatar;
        return view('index', ['posts' => $lastPosts, 'picture' => $picture]);
    }

    public function profile()
    {
        if ($this->request->user()->id == 1)
        {
            return redirect('/admin');
        }
        return view('home');
    }

    public function contact()
    {
        if ($this->request->isMethod('post'))
        {
            if ($this->mails->isSpam($this->request)) {
                $this->users->markRobot($this->request->session()->get('visitorId'));
                return view('reports.spam');
            }
            $this->mails->send($this->request->input());
            return redirect('/');
        }
        return view('contact');
    }

    public function avatar()
    {
        if ($this->request->method() === 'POST' && $this->request->hasFile('newAvatar')) {
            $newAvatar = $this->files->save($this->request->file('newAvatar'));
            $this->request->user()->avatar = $newAvatar;
            $this->request->user()->save();
        }
        return view('admin.avatar');
    }

    public function __construct(
        UserService $userService,
        PostService $postService,
        MailService $mailService,
        FileService $fileService,
        Request $request
    )
    {
        $this->users = $userService;
        $this->posts = $postService;
        $this->mails = $mailService;
        $this->files = $fileService;
        $this->request = $request;
    }
}
