<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        //$webinars = $category->webinars;

        $categories = Category::with('webinars')->whereHas('webinars', function ($query) use($category) {
            $query->where('confirmed', '=', 1);
            $query->where('id','=',$category->id);
        })->get();

        return view('categories.show',compact('categories'));
    }
}
