<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('books')->orderBy('name')->paginate(30);

        return view('admin.categories.index', compact('categories'));
    }

    public function show($id)
    {
        $category = Category::with('books')->where('id', $id)->first();

        return view('admin.categories.detail', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $category->update($this->validateInput($request));

        return redirect('/admin/categories')->with('status', 'Success')->with('message', 'Category ' . $category->name . ' has been updated');
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        Category::create($this->validateInput($request));

        return redirect('/admin/categories')->with('status', 'Success')->with('message', 'Category ' . $request->name . ' has been updated');
    }

    public function destroy($id)
    {
        Category::where('id', $id)->delete();

        return redirect('/admin/categories')->with('status', 'Success')->with('message', 'Category has been deleted');
    }

    private function validateInput($input) 
    {
        return $input->validate([
            'name' => ['required', 'min:5', 'max:100', 'unique:categories']
        ]);
    }
}
