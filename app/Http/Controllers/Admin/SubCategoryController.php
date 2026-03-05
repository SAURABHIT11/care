<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subCategories = SubCategory::with('category')
            ->orderBy('sort_order')
            ->latest()
            ->paginate(30);

        return view('admin.sub_categories.index', compact('subCategories'));
    }

    public function create()
    {
        $categories = Category::where('status', 1)->orderBy('sort_order')->get();
        return view('admin.sub_categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        SubCategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('admin.sub-categories.index')->with('success', 'Sub Category created!');
    }

    public function show(SubCategory $subCategory)
    {
        return view('admin.sub_categories.show', compact('subCategory'));
    }

    public function edit(SubCategory $subCategory)
    {
        $categories = Category::where('status', 1)->orderBy('sort_order')->get();
        return view('admin.sub_categories.edit', compact('subCategory', 'categories'));
    }

    public function update(Request $request, SubCategory $subCategory)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        $subCategory->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('admin.sub-categories.index')->with('success', 'Sub Category updated!');
    }

    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        return redirect()->route('admin.sub-categories.index')->with('success', 'Sub Category deleted!');
    }
}
