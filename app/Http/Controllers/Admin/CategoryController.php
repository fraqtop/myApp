<?php

namespace App\Http\Controllers\Admin;

use App\Services\FileService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog\Category;

class CategoryController extends Controller
{
    private $files;
    private $request;

    public function get()
    {
        return view('admin.categories', ['categories' => Category::all()]);
    }

    public function create()
    {
        $this->validate($this->request, [
            'categoryTitle' => 'required',
            'categoryPicture' => 'required'
        ]);
        $path = $this->files->save($this->request->file('categoryPicture'), 'categories');
        Category::create([
            'title' => $this->request->post('categoryTitle'),
            'picture' => $path
        ]);
        return redirect()->back();
    }

    public function update($categoryId)
    {
        $this->validate($this->request, [
            'categoryTitle' => 'required'
        ]);
        $category = Category::find($categoryId);
        $category->title = $this->request->post('categoryTitle');
        if ($this->request->hasFile('categoryPicture'))
        {
            $path = $this->files->save($this->request->file('categoryPicture'), 'categories');
            $category->picture = $path;
        }
        $category->save();
        return view('admin.traffic');
    }

    public function delete($categoryId)
    {
        $category = Category::find($categoryId);
        $this->files->remove($category->picture);
        $category->delete();
        return redirect()->back();
    }

    public function __construct(FileService $fileService, Request $request)
    {
        $this->files = $fileService;
        $this->request = $request;
    }
}
