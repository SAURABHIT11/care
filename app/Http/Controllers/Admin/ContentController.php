<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgeGroup;
use App\Models\Category;
use App\Models\Content;
use App\Models\SubCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    public function index()
{
    $contents = Content::with([
            'category',
            'subCategory',
            'files' => function ($query) {
                $query->where('status', 1)
                      ->orderBy('sort_order');
            }
        ])
        ->latest()
        ->paginate(20);


    return view('admin.contents.index', compact('contents'));
}

    public function create()
    {
        $categories = Category::where('status', 1)->orderBy('sort_order')->get();
        $subCategories = SubCategory::where('status', 1)->orderBy('sort_order')->get();
        $ageGroups = AgeGroup::where('status', 1)->orderBy('sort_order')->get();
        $tags = Tag::where('status', 1)->orderBy('name')->get();

        return view('admin.contents.create', compact(
            'categories',
            'subCategories',
            'ageGroups',
            'tags'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:sub_categories,id',
            'type' => 'required|in:blog,game',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'language' => 'nullable|in:english,hindi,urdu',
            'difficulty' => 'nullable|in:easy,medium,hard',
            'access_type' => 'required|in:free,premium',
            'price' => 'nullable|numeric|min:0',
            'is_featured' => 'nullable|boolean',
            'status' => 'nullable|boolean',
            'age_groups' => 'nullable|array',
            'tags' => 'nullable|array',
              // ✅ NEW
    'files' => 'nullable|array',
    'files.*' => 'file|max:20480|mimes:pdf,jpg,jpeg,png,mp4',
        ]);

        $content = Content::create([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'type' => $request->type,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'language' => $request->language,
            'difficulty' => $request->difficulty,
            'access_type' => $request->access_type,
            'price' => $request->price ?? 0,
            'is_featured' => $request->is_featured ?? 0,
            'status' => $request->status ?? 1,
        ]);
// ✅ upload files
if ($request->hasFile('files')) {
    foreach ($request->file('files') as $uploadedFile) {

        $path = $uploadedFile->store('contents/' . $content->id, 'public');

        $content->files()->create([
            'file_path' => $path,
            'original_name' => $uploadedFile->getClientOriginalName(),
            'file_type' => $uploadedFile->getClientMimeType(),
            'file_size_kb' => round($uploadedFile->getSize() / 1024, 2),
        ]);
    }
}
        // attach age groups
        if ($request->age_groups) {
            $content->ageGroups()->sync($request->age_groups);
        }

        // attach tags
        if ($request->tags) {
            $content->tags()->sync($request->tags);
        }

        return redirect()->route('admin.contents.index')->with('success', 'Content created!');
    }

    public function show(Content $content)
    {
        $content->load(['category', 'subCategory', 'files', 'ageGroups', 'tags']);
        return view('admin.contents.show', compact('content'));
    }

    public function edit(Content $content)
    {
        $categories = Category::where('status', 1)->orderBy('sort_order')->get();
        $subCategories = SubCategory::where('status', 1)->orderBy('sort_order')->get();
        $ageGroups = AgeGroup::where('status', 1)->orderBy('sort_order')->get();
        $tags = Tag::where('status', 1)->orderBy('name')->get();

        $content->load(['ageGroups', 'tags']);

        return view('admin.contents.edit', compact(
            'content',
            'categories',
            'subCategories',
            'ageGroups',
            'tags'
        ));
    }

    public function update(Request $request, Content $content)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:sub_categories,id',
            'type' => 'required|in:blog,game',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'language' => 'nullable|in:english,hindi,urdu',
            'difficulty' => 'nullable|in:easy,medium,hard',
            'access_type' => 'required|in:free,premium',
            'price' => 'nullable|numeric|min:0',
            'is_featured' => 'nullable|boolean',
            'status' => 'nullable|boolean',
            'age_groups' => 'nullable|array',
            'tags' => 'nullable|array',
            'files' => 'nullable|array',
'files.*' => 'file|max:20480|mimes:pdf,jpg,jpeg,png,mp4',

        ]);

        $content->update([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'type' => $request->type,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'language' => $request->language,
            'difficulty' => $request->difficulty,
            'access_type' => $request->access_type,
            'price' => $request->price ?? 0,
            'is_featured' => $request->is_featured ?? 0,
            'status' => $request->status ?? 1,
        ]);
// ✅ upload new files
if ($request->hasFile('files')) {
    foreach ($request->file('files') as $uploadedFile) {

        $path = $uploadedFile->store('contents/' . $content->id, 'public');

        $content->files()->create([
            'file_path' => $path,
            'original_name' => $uploadedFile->getClientOriginalName(),
            'file_type' => $uploadedFile->getClientMimeType(),
            'file_size_kb' => round($uploadedFile->getSize() / 1024, 2),
        ]);
    }
}

        $content->ageGroups()->sync($request->age_groups ?? []);
        $content->tags()->sync($request->tags ?? []);

        return redirect()->route('admin.contents.index')->with('success', 'Content updated!');
    }

    public function destroy(Content $content)
    {
        $content->delete();
        return redirect()->route('admin.contents.index')->with('success', 'Content deleted!');
    }
}
