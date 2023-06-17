<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $webinars = $category->webinars;
        return view('categories.show',compact('webinars'));
    }
}
