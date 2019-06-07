<?php

namespace App\Http\Controllers\Blog;

use App\Models\Blog\Comment;
use App\Services\PostService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog\Post;
use Storage;
use Illuminate\Http\File;
use App\Models\Blog\Category;

class PostController extends Controller
{
    private $posts;
    private $request;

    function getAll()
    {
        return view('blog.posts', ['posts' => $this->posts->getMany()]);
    }

    function create()
    {
        if ($this->authorize('create', Post::class))
        {
            if ($this->request->isMethod('post'))
            {
                $this->posts->create($this->request);
                return redirect('/posts');
            }
            return view('blog.createPost', ['categories' => Category::all()]);
        }
        abort(403);
    }

    function get(int $postId)
    {
        $post = $this->posts->get($postId);
        $comments = $post->comments;
        return view('blog.post', ['post' => $post, 'comments' => $comments]);
    }

    function edit($postId)
    {
        if($this->request->isMethod('patch'))
        {
            $post = $this->posts->update($this->request);
            $comments = $post->comments;
            return view('blog.post', ['post' => $post, 'comments' => $comments]);
        }
        return view('blog.createPost', [
            'post' => $this->posts->get($postId),
            'categories' => Category::all()
        ]);
    }

    function delete(int $postId)
    {
       $this->posts->delete($postId);
       return redirect('/posts');
    }

    public function __construct(PostService $postService, Request $request)
    {
        $this->posts = $postService;
        $this->request = $request;
    }
}
