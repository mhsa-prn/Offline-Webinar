<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $key = $request->search;

        if($key){
            $ids=$categories=Category::where('name','like',"%{$key}%")->get('id');
            $categories=Category::where('name','like',"%{$key}%")
                ->orWhereIn('parent_id',$ids)
                ->paginate(10);
        }
        else{
            $categories = Category::latest()->paginate(10);
        }
        return view('admin.categories.index',compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:categories,name',
            'parent_id'=>'nullable|exists:categories,id'
        ]);

        Category::create($request->all());
        return redirect(route('admin.categories.index'));
    }

    public function destroy(Category $category)
    {

        $ids=Category::whereNotNull('parent_id')->get('parent_id');

        foreach ($ids as $id){
            if($id->parent_id == $category->id){
                return redirect(route('admin.categories.index'))->with(['error' => 'دسته بندی مورد نظر دارای دسته بندی می باشد . قابل حذف نیست']);

            }
        }
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
