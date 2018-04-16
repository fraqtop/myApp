<?php

namespace App\Http\Controllers\blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
use App\Category;
use Illuminate\Http\File;

class CategoryController extends Controller
{
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
                'title' => $request->post('categoryTitle'),
                'picture' => Storage::url($path)
            ]);
            return redirect()->back();
        }
        return view('blog.createCategory');
    }
}
