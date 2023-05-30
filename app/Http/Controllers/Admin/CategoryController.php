<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index',compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'parent_id'=>'nullable|exists:categories,id'
        ]);

        Category::create($request->all());
        return redirect(route('admin.categories.index'));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back();
    }
}
