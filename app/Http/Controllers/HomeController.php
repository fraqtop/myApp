<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Blog\Post;
use App\Models\Visitor;
use App\User;
use Mail;
use Illuminate\Http\{Request, File};
use Storage;

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
        $lastPosts = Post::with('category')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
        $picture = User::find(1)->avatar;
        return view('index', ['posts' => $lastPosts, 'picture' => $picture]);
    }

    public function profile(Request $request)
    {
        if ($request->user()->id == 1)
        {
            return redirect('/admin');
        }
        return view('home');
    }

    private function isSpam($input)
    {
        $fakeField = $input['contactAdvanced'] ?? null;
        $postingPeriod = (new \DateTime())->getTimestamp() - $input['contactTime'];
        $keyPressDiff = (int)$input['contactCounter'] - strlen($input['contactMessage']);
        if($fakeField != null || $postingPeriod < 5 || $keyPressDiff < -20)
        {
            $traps = [$fakeField, $postingPeriod, $keyPressDiff];
            $this->registerSpamMessage($input['contactAuthor'], $traps);
            return true;
        }
        return false;
    }

    private function registerSpamMessage(string $spamName, array $trapsValues)
    {
        $log = fopen("spamlog.txt", 'a+');
        $time = new \DateTime();
        fwrite($log, $spamName." - ".$time->format('d M Y H:i'));
        if (strlen($trapsValues[0])>10)
            $trapsValues[0] = 'garbage';
        foreach ($trapsValues as $trap)
        {
            fwrite($log, " ".$trap." ");
        }
        fwrite($log, PHP_EOL);
        fclose($log);
    }

    public function contact(Request $request)
    {
        if ($request->isMethod('post'))
        {
            if($this->isSpam($request->input()))
            {
                Visitor::find($request->session()->get('visitorId'))->update(['isHuman' => 0]);
                return view('reports.spam');
            }
            else
            {
                Mail::to(User::find(1))->send(new ContactMail($request->post('contactAuthor'),
                    $request->post('contactMessage'), $request->post('contactFeedback')));
                return redirect('/');
            }
        }
        return view('contact');
    }

    public function avatar(Request $request)
    {
        if ($request->method() === 'POST'){
            $newAvatar = Storage::disk('public')
                ->putFile('profilePics', new File($request->file('newAvatar')));
            $request->user()->avatar = Storage::url($newAvatar);
            $request->user()->save();
        }
        return view('admin.avatar');
    }
}
