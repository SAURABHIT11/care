<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Content;
use App\Models\Blog;

class HomeController extends Controller
{


public function index()
{
    // Categories
    $categories = Category::where('status', 1)
        ->orderBy('sort_order')
        ->take(8)
        ->get();

    // Latest Contents
    $latestContents = Content::with(['category', 'subCategory'])
        ->where('status', 1)
        ->latest()
        ->take(9)
        ->get();

    // Stats
    $stats = [
        'worksheets' => Content::where('type', 'worksheet')->where('status', 1)->count(),
        'coloring'   => Content::where('type', 'coloring_page')->where('status', 1)->count(),
        'books'      => Content::where('type', 'coloring_book')->where('status', 1)->count(),
        'downloads'  => Content::sum('download_count'),
    ];

    // ✅ NEW: Latest Blogs
    $blogs = Blog::with('category')
        ->where('status', 'published')
        ->latest('published_at')
        ->take(6)
        ->get();

         // 🔥 NEW: Recipes (IMPORTANT)
    $recipes = Content::with(['files'])
        ->where('type', 'recipes')
        ->where('status', 1)
        ->latest()
        ->take(8)
        ->get();

    return view('home', compact(
        'categories',
        'latestContents',
        'stats',
        'blogs',
        'recipes'
    ));
}
}
