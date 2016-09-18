<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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

        return redirect('system/category');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('category.edit')->with($category->toArray());
    }

    public function update(Requests\CategoryStoreRequest $request, $id)
    {
        $category = Category::findOrFail($id);

        $category->first = $request->input('first');
        $category->second = $request->input('second');

        $category->save();

        return redirect('system/category')->with('info', ['修改成功']);
    }
}
