<?php

namespace App\Http\Controllers\Blog;

use App\Models\Blog\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    private $request;

    function store($postId)
    {
        $this->validate($this->request, ['commContent' => 'required|max:255']);
        Comment::create([
            'content' => $this->request->post('commContent'),
            'post_id' => $postId,
            'user_id' => $this->request->user()->id
        ]);
        return redirect()->back();
    }

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}
