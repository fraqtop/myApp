<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;
class BlogController extends Controller
{
    function posts()
    {
        return view('blog.posts', ['posts' => Post::all()]);
    }

    function createPost(Request $request)
    {
        return view('blog.createPost');
    }

    function storePost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ]);
        $request->user()->posts()->create([
           'title' => $request->title,
            'content' => $request->postContent
        ]);
        redirect('/posts');
    }

}
