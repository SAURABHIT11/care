<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::orderBy('name')
            ->latest()
            ->paginate(40);

        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
            'status' => 'nullable|boolean',
        ]);

        Tag::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('admin.tags.index')
            ->with('success', 'Tag created!');
    }

    public function show(Tag $tag)
    {
        return view('admin.tags.show', compact('tag'));
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $tag->id,
            'status' => 'nullable|boolean',
        ]);

        $tag->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('admin.tags.index')
            ->with('success', 'Tag updated!');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('admin.tags.index')
            ->with('success', 'Tag deleted!');
    }
}
