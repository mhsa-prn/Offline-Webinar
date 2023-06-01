<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'name'=>'required|unique:categories,names',
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

    public function edit(Category $category)
    {
        return view('admin.categories.update',compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'=>['required',Rule::unique('categories','name')->ignore($category->id)],
            'parent_id'=>'nullable|exists:categories,id'
        ]);

        $category->update($request->all());
        return redirect(route('admin.categories.index'));
    }
}
