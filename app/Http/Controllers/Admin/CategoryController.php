<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $slug = Str::slug($request->name);

        $existingCategory = Category::where('slug', $slug)->first();

        if ($existingCategory) {
            return redirect()->back()->with('error', 'Slug đã tồn tại. Vui lòng chọn tên khác cho danh mục.');
        }

        $data = $request->all();
        $data['slug'] = $slug;
        Category::create($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }


    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $slug = Str::slug($request->name);

        $existingCategory = Category::where('slug', $slug)
            ->where('id', '!=', $category->id)
            ->first();

        if ($existingCategory) {
            return redirect()->back()->with('error', 'Slug đã tồn tại. Vui lòng chọn tên khác cho danh mục.');
        }

        $category->slug = $slug;
        $category->update($request->all());

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }


    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
