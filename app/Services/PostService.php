<?php


namespace App\Services;


use App\Models\Blog\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Storage;
use Illuminate\Http\File;

class PostService
{
    public function getMany($limit = 10): Collection
    {
        return Post::with(['category', 'comments'])
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function get(int $id): Post
    {
        return Post::find($id);
    }

    public function create(Request $request)
    {
        $request->validate([
            'postTitle' => 'required|max:150',
            'postContent' => 'required|max:2000',
            'postCategory' => 'required|integer'
        ]);
        $path = null;
        if($request->hasFile('postPicture'))
        {
            $path = Storage::disk('public')
                ->putFile('postPics', new File($request->file('postPicture')));
            $path = Storage::url($path);
        }
        $newPost = $request->user()->posts()->create([
            'title' => $request->post('postTitle'),
            'content' => $request->post('postContent'),
            'category_id' => $request->post('postCategory'),
            'picture' => $path
        ]);
        return $newPost;
    }

    public function update(Request $request): Post
    {
        $post = Post::find($request->route('post_id'));
        $post->title = $request->post('postTitle');
        $post->content = $request->post('postContent');
        $post->category_id = $request->post('postCategory');
        if($request->hasFile('postPicture'))
        {
            $path = Storage::disk('public')
                ->putFile('postPics', new File($request->file('postPicture')));
            $post->picture = Storage::url($path);
        }
        $post->save();
        return $post;
    }

    public function delete($id)
    {
        Post::find($id)->delete();
    }
}