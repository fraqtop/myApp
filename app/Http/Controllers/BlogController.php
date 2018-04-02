<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Post;
use Storage;

class BlogController extends Controller
{
    function posts()
    {
        $posts = Post::with('category')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('blog.posts', ['posts' => $posts]);
    }

    function createPost(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $path = null;
            if($request->hasFile('postPicture'))
            {
                $path = Storage::disk('public')
                    ->putFile('postPics', new File($request->file('postPicture')));
                $path = Storage::url($path);
            }
            $request->user()->posts()->create([
                'title' => $request->postTitle,
                'content' => $request->postContent,
                'category_id' => $request->postCategory,
                'picture' => $path
            ]);
            return redirect('/posts');
        }
        return view('blog.createPost', ['categories' => Category::all()]);
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

    function createCategory(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'categoryTitle' => 'required',
                'categoryPicture' => 'required'
            ]);
            $path = Storage::disk('public')
                ->putFile('categoryPics', new File($request->file('categoryPicture')));
            Category::create([
               'title' => $request->categoryTitle,
                'picture' => Storage::url($path)
            ]);
            return redirect()->back();
        }
        return view('blog.createCategory');
    }
}
