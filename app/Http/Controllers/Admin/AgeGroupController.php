<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgeGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AgeGroupController extends Controller
{
    public function index()
    {
        $ageGroups = AgeGroup::orderBy('sort_order')
            ->latest()
            ->paginate(30);

        return view('admin.age_groups.index', compact('ageGroups'));
    }

    public function create()
    {
        return view('admin.age_groups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        AgeGroup::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('admin.age-groups.index')
            ->with('success', 'Age Group created!');
    }

    public function show(AgeGroup $ageGroup)
    {
        return view('admin.age_groups.show', compact('ageGroup'));
    }

    public function edit(AgeGroup $ageGroup)
    {
        return view('admin.age_groups.edit', compact('ageGroup'));
    }

    public function update(Request $request, AgeGroup $ageGroup)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        $ageGroup->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('admin.age-groups.index')
            ->with('success', 'Age Group updated!');
    }

    public function destroy(AgeGroup $ageGroup)
    {
        $ageGroup->delete();

        return redirect()->route('admin.age-groups.index')
            ->with('success', 'Age Group deleted!');
    }
}
