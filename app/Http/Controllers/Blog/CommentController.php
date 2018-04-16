<?php

namespace App\Http\Controllers\blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;

class CommentController extends Controller
{
    function storeComment(Request $request, $postId)
    {
        $this->validate($request, ['commContent' => 'required']);
        Post::find($postId)->comments()->create([
            'content' => $request->post('commContent'),
            'user_id' => $request->user()->id
        ]);
        return redirect()->back();
    }
}
