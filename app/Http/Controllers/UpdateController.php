<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

class UpdateController extends Controller
{
    public function showCategoryList()
    {
        $categories = Category::all();

        return view('category.index')->with('categories', $categories);
    }

    public function showCategoryCreateForm()
    {
        return view('category.create');
    }

    public function storeCategory(Requests\CategoryStoreRequest $request)
    {
        $category = new Category($request->all());
        $category->serial = '';

        $category->save();

        return redirect('/category');
    }
}
