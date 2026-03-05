<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;
use App\Models\AgeGroup;

class PublicContentController extends Controller
{
   public function worksheets()
{
    $query = Content::where('status', 1)->where('type', 'worksheet');

    // Search
    if (request('q')) {
        $query->where('title', 'like', '%' . request('q') . '%');
    }

    // Category filter
    if (request('category')) {
        $query->where('category_id', request('category'));
    }

    // Age group filter
    if (request('age')) {
        $query->where('age_group_id', request('age'));
    }

    // Sorting
    $sort = request('sort', 'newest');

    if ($sort === 'popular') {
        $query->orderByDesc('downloads');
    } else {
        $query->latest();
    }

    $contents = $query->paginate(12)->withQueryString();

    $categories = Category::where('status', 1)->orderBy('name')->get();
    $ageGroups = AgeGroup::where('status', 1)->orderBy('label')->get();

    // Stats
    $stats = [
        'total' => Content::where('status', 1)->where('type', 'worksheet')->count(),
        'free' => Content::where('status', 1)->where('type', 'worksheet')->where('access_type', 'free')->count(),
        'premium' => Content::where('status', 1)->where('type', 'worksheet')->where('access_type', 'premium')->count(),
    ];

    return view('public.worksheets.index', compact('contents', 'categories', 'ageGroups', 'stats', 'sort'));
}


    public function coloring()
  
{
    $query = Content::where('status', 1)
        ->where('type', 'coloring_page');

    if (request('q')) {
        $query->where('title', 'like', '%' . request('q') . '%');
    }

    if (request('category')) {
        $query->where('category_id', request('category'));
    }

    if (request('age')) {
        $query->where('age_group_id', request('age'));
    }

    $sort = request('sort', 'newest');

    if ($sort === 'popular') {
        $query->orderByDesc('downloads');
    } else {
        $query->latest();
    }

    $contents = $query->paginate(12)->withQueryString();

    $categories = Category::where('status', 1)->orderBy('name')->get();
    $ageGroups = AgeGroup::where('status', 1)->orderBy('label')->get();
 $stats = [
        'total' => Content::where('status', 1)->where('type', 'coloring_page')->count(),
        'free' => Content::where('status', 1)->where('type', 'coloring_page')->where('access_type', 'free')->count(),
        'premium' => Content::where('status', 1)->where('type', 'coloring_page')->where('access_type', 'premium')->count(),
    ];



    return view('public.coloring.index', compact('contents', 'categories', 'ageGroups', 'stats', 'sort'));
}
   public function books()
{
    $query = Content::with(['category', 'ageGroup'])
        ->where('status', 1)
        ->where('type', 'book');

    if (request('q')) {
        $query->where('title', 'like', '%' . request('q') . '%');
    }

    if (request('category')) {
        $query->where('category_id', request('category'));
    }

    if (request('age')) {
        $query->where('age_group_id', request('age'));
    }

    $sort = request('sort', 'newest');

    if ($sort === 'popular') {
        $query->orderByDesc('downloads');
    } else {
        $query->latest();
    }

    $contents = $query->paginate(12)->withQueryString();

    $categories = Category::where('status', 1)->orderBy('name')->get();
    $ageGroups = AgeGroup::where('status', 1)->orderBy('label')->get();
 $stats = [
        'total' => Content::where('status', 1)->where('type', 'book')->count(),
        'free' => Content::where('status', 1)->where('type', 'book')->where('access_type', 'free')->count(),
        'premium' => Content::where('status', 1)->where('type', 'book')->where('access_type', 'premium')->count(),
    ];

    return view('public.books.index', compact('contents', 'categories', 'ageGroups', 'stats', 'sort'));
}

public function games()
{
    $query = Content::with(['category', 'ageGroup'])
        ->where('status', 1)
        ->where('type', 'game');

    if (request('q')) {
        $query->where('title', 'like', '%' . request('q') . '%');
    }

    if (request('category')) {
        $query->where('category_id', request('category'));
    }

    if (request('age')) {
        $query->where('age_group_id', request('age'));
    }

    $sort = request('sort', 'newest');

    if ($sort === 'popular') {
        $query->orderByDesc('downloads');
    } else {
        $query->latest();
    }

    $contents = $query->paginate(12)->withQueryString();

    $categories = Category::where('status', 1)->orderBy('name')->get();
    $ageGroups = AgeGroup::where('status', 1)->orderBy('label')->get();
 $stats = [
        'total' => Content::where('status', 1)->where('type', 'game')->count(),
        'free' => Content::where('status', 1)->where('type', 'game')->where('access_type', 'free')->count(),
        'premium' => Content::where('status', 1)->where('type', 'game')->where('access_type', 'premium')->count(),
    ];
    $stats = [
        'total' => Content::where('status', 1)->where('type', 'game')->count(),
        'free' => Content::where('status', 1)->where('type', 'game')->where('is_premium', 0)->count(),
        'premium' => Content::where('status', 1)->where('type', 'game')->where('is_premium', 1)->count(),
    ];

    return view('public.games.index', compact('contents', 'categories', 'ageGroups', 'stats', 'sort'));
}


    public function category($slug)
    {
        $category = Category::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        $contents = Content::where('status', 1)
            ->where('category_id', $category->id)
            ->latest()
            ->paginate(20);

        return view('public.category.show', compact('category', 'contents'));
    }

    public function show($slug)
    {
        $content = Content::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        return view('public.content.show', compact('content'));
    }

public function showWorksheet($slug)
    {
        return $this->showByType($slug, 'worksheet', 'public.worksheets.show');
    }

    public function showColoringPage($slug)
    {
        return $this->showByType($slug, 'coloring_page', 'public.coloring.show');
    }

    public function showBook($slug)
    {
        return $this->showByType($slug, 'coloring_book', 'public.books.show');
    }

    private function showByType($slug, $type, $view)
    {
        $content = Content::with(['category', 'subCategory', 'ageGroups', 'tags', 'files'])
            ->where('status', 1)
            ->where('type', $type)
            ->where('slug', $slug)
            ->firstOrFail();

        // Suggestions: same category, same type, exclude current
        $suggestions = Content::where('status', 1)
            ->where('type', $type)
            ->where('category_id', $content->category_id)
            ->where('id', '!=', $content->id)
            ->latest()
            ->take(8)
            ->get();

        return view($view, compact('content', 'suggestions'));
    }

     public function fill($slug)
    {
        $coloring = Content::where('type', 'coloring_page')
            ->where('status', 1)
            ->where('slug', $slug)
            ->firstOrFail();

        // Suggestions (latest 12, excluding current)
        $latestColorings = Content::where('type', 'coloring_page')
            ->where('status', 1)
            ->where('id', '!=', $coloring->id)
            ->latest()
            ->take(12)
            ->get();

        return view('public.coloring.fill', compact('coloring', 'latestColorings'));
    }

}
