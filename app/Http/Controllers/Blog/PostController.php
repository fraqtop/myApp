<?php

namespace App\Http\Controllers\blog;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Storage;
use Illuminate\Http\File;
use App\Category;

class PostController extends Controller
{
    function getAllPosts()
    {
        $posts = Post::with('category')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('blog.posts', ['posts' => $posts]);
    }

    function createPost(Request $request)
    {
        if ($this->authorize('create', Post::class))
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
                    'title' => $request->post('postTitle'),
                    'content' => $request->post('postContent'),
                    'category_id' => $request->post('postCategory'),
                    'picture' => $path
                ]);
                return redirect('/posts');
            }
            return view('blog.createPost', ['categories' => Category::all()]);
        }
    }

    function getPost(int $postId)
    {
        $post = Post::find($postId);
        $comments = Comment::with('user')
            ->where('post_id', '=', $postId)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('blog.post', ['post' => $post, 'comments' => $comments]);
    }
}
