<?php

namespace App\Http\Controllers;

use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Http\UploadedFile;
use Storage;

class BlogController extends Controller
{
    function posts()
    {
        return view('blog.posts', ['posts' => Post::with('user')->get()]);
    }

    function createPost()
    {
        return view('blog.createPost');
    }

    function storePost(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'title' => 'required',
                'postContent' => 'required'
            ]);
            $path = Storage::disk('public')->putFile('postpics', new File($request->file('postPicture')));
            $request->user()->posts()->create([
                'title' => $request->title,
                'content' => $request->postContent,
                'picture' => Storage::url($path)
            ]);
            return redirect('/posts');
        }
        return view('blog.createPost');
    }

    function getPost($postId)
    {
        return view('blog.post', ['post' => Post::find($postId)]);
    }

    function storeComment(Request $request, $postId)
    {
        $this->validate($request, ['commContent' => 'required']);
        Post::find($postId)->comments()->create([
            'content' => $request->commContent,
            'user_id' => $request->user()->id
        ]);
        return redirect()->back();
    }
}
