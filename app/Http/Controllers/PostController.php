<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;

class PostController extends Controller {

public function index(Request $request) 
{
    $query = Post::query();

    // Search logic for Title or Keywords
    if ($request->has('search')) {
        $search = $request->get('search');
        $query->where('title', 'LIKE', "%{$search}%")
              ->orWhere('keywords', 'LIKE', "%{$search}%");
    }

    // Latest first, 12 items per page
    $posts = $query->latest()->paginate(12);

    return view('posts.index', compact('posts'));
}
    public function create() {
        return view('posts.create');
    }

    public function store(Request $request) {
    $request->validate(['images.*' => 'required|image']);
    
    // The path where your Python script lives
    $pythonDir = 'C:\LLM-Helpers\AI_Upscaler';
    // The path where Laravel stores public files
    $storagePath = public_path('storage/upscaled');

    // Create the storage directory if it doesn't exist
    if (!File::exists($storagePath)) {
        File::makeDirectory($storagePath, 0755, true);
    }

    foreach ($request->file('images') as $index => $file) {
        $uniqueName = time() . '_' . $file->getClientOriginalName();
        
        // 1. Save to the Python Input Folder
        $file->move($pythonDir . '\inputs', $uniqueName);

        // 2. Save Metadata to DB
        $postData = $request->input("data.$index");
        Post::create([
            'title' => $postData['title'] ?? 'Untitled',
            'description' => $postData['description'] ?? '',
            'keywords' => $postData['keywords'] ?? '',
            'original_filename' => $uniqueName,
            'upscaled_filename' => 'upscaled/4k_' . $uniqueName, // Relative path for the <img> tag
        ]);
    }

    // 3. Trigger Python Script using full Windows path
    // We pass the public storage path as an argument to the script
    $process = new Process([
        'python', 
        $pythonDir . '\batch_upscale.py',
        $storagePath // Sending Laravel's public path to Python
    ]);
    
    $process->setTimeout(3600);
    $process->run();

    return back()->with('success', 'Images upscaled and saved to public storage!');
}
}