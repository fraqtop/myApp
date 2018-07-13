<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
use App\Category;
use Illuminate\Http\File;

class CategoryController extends Controller
{
    public function getCategories()
    {
        return view('admin.categories', ['categories' => Category::all()]);
    }

    public function createCategory(Request $request)
    {
        $this->validate($request, [
            'categoryTitle' => 'required',
            'categoryPicture' => 'required'
        ]);
        $path = Storage::disk('public')
            ->putFile('categoryPics', new File($request->file('categoryPicture')));
        Category::create([
            'title' => $request->post('categoryTitle'),
            'picture' => Storage::url($path)
        ]);
        return redirect()->back();
    }

    public function editCategory(Request $request, $categoryId)
    {
        $this->validate($request, [
            'categoryTitle' => 'required'
        ]);
        $category = Category::find($categoryId);
        $category->title = $request->post('categoryTitle');
        if ($request->hasFile('categoryPicture'))
        {
            $path = Storage::disk('public')
                ->putFile('categoryPics', new File($request->file('categoryPicture')));
            $category->picture = Storage::url($path);
        }
        $category->save();
        return view('admin.traffic');
    }
}
