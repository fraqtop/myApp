<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;
use phpDocumentor\Reflection\Types\Integer;

class BlogController extends Controller
{
    function posts()
    {
        return view('blog.posts', ['posts' => Post::with('user')->get()]);
    }

    function createPost(Request $request)
    {
        return view('blog.createPost');
    }

    function storePost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'postContent' => 'required'
        ]);
        $request->user()->posts()->create([
           'title' => $request->title,
            'content' => $request->postContent
        ]);
        return redirect('/posts');
    }

    function getPost(Request $request, $postId)
    {
        return view('blog.post', ['post' => Post::find($postId)]);
    }

    function storeComment(Request $request)
    {

    }
}
