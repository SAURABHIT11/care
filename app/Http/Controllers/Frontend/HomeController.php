<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Content;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)
            ->orderBy('sort_order')
            ->take(8)
            ->get();

        $latestContents = Content::with(['category', 'subCategory'])
            ->where('status', 1)
            ->latest()
            ->take(9)
            ->get();

        $stats = [
            'worksheets' => Content::where('type', 'worksheet')->where('status', 1)->count(),
            'coloring'   => Content::where('type', 'coloring_page')->where('status', 1)->count(),
            'books'      => Content::where('type', 'coloring_book')->where('status', 1)->count(),
            'downloads'  => Content::sum('download_count'), // column must exist
        ];

        return view('home', compact('categories', 'latestContents', 'stats'));
    }
}
