<?php

namespace App\Http\Controllers; 
use App\Models\Category;   
use App\Models\Blog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;                             

use Illuminate\Http\Request;    

class BlogController extends Controller
{
public function create()
{
    $categories = Category::orderBy('name')->get();

    $recentBlogs = Blog::latest()
        ->take(1) // show last 5 blogs
        ->get();

    return view('blogs.create', compact('categories', 'recentBlogs'));
}



public function generatePrompt(Request $request)
{
    Log::info('=== AI Prompt Generation Started ===');

    $request->validate([
        'user_prompt' => 'required|string|max:1500',
        'tone' => 'required|string',
        'word_count' => 'required|integer|min:250|max:5000'
    ]);

    Log::info('AI Prompt Input Received', [
        'user_prompt' => $request->user_prompt,
        'tone' => $request->tone,
        'word_count' => $request->word_count
    ]);

    try {

        $apiKey = config('services.gemini.key');
        $geminiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}";

        $promptEngineerText = "
        Act as a senior AI prompt engineer.

        Convert this topic into a detailed, research-driven,
        SEO-optimized blog generation prompt.

        Topic: {$request->user_prompt}
        Tone: {$request->tone}
        Target Words: {$request->word_count}

        Return only the refined prompt text.
        ";

        Log::info('Sending request to Gemini for prompt refinement');

        $response = Http::timeout(60)->post($geminiUrl, [
            'contents' => [[
                'parts' => [['text' => $promptEngineerText]]
            ]]
        ]);

        if ($response->failed()) {

            Log::error('Gemini Prompt Generation Failed', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return back()->withErrors("Prompt generation failed.");
        }

        Log::info('Gemini Prompt Response Received');

        $refinedPrompt = $response->json('candidates.0.content.parts.0.text');

        if (!$refinedPrompt) {
            Log::warning('Gemini returned empty refined prompt.');
            return back()->withErrors("AI returned empty prompt.");
        }

        Log::info('Refined Prompt Generated Successfully');

        // Store in session
        session([
            'ai_user_prompt' => $request->user_prompt,
            'ai_tone' => $request->tone,
            'ai_word_count' => $request->word_count,
            'ai_refined_prompt' => $refinedPrompt
        ]);

        Log::info('Refined Prompt Stored in Session');

        return redirect()->back()->with('success', 'Prompt generated successfully!');

    } catch (\Exception $e) {

        Log::critical('AI Prompt Generation Exception', [
            'message' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile()
        ]);

        return back()->withErrors("System Error: " . $e->getMessage());
    }
}


public function generateBlogFromPrompt(Request $request)
{
    $request->validate([
        'refined_prompt' => 'required|string',
        'category_id' => 'nullable|exists:categories,id',
        'status' => 'required|in:draft,review,published'
    ]);

    $apiKey = config('services.gemini.key');
    $geminiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}";

    $finalPrompt = "
    {$request->refined_prompt}

    Generate full blog in strict JSON:

    {
        \"title\": \"Blog Title\",
        \"content\": \"Full HTML content\",
        \"keywords\": [],
        \"meta_description\": \"\"
    }
    ";

    $response = Http::timeout(120)->post($geminiUrl, [
        'contents' => [[
            'parts' => [['text' => $finalPrompt]]
        ]],
        'generationConfig' => [
            'temperature' => 0.6,
            'maxOutputTokens' => 4096
        ]
    ]);

    if ($response->failed()) {
        return back()->withErrors("Blog generation failed.");
    }

    $rawText = $response->json('candidates.0.content.parts.0.text');
    preg_match('/\{.*\}/s', $rawText, $matches);
    $data = json_decode($matches[0] ?? '', true);

    if (!$data || !isset($data['content'])) {
        return back()->withErrors("Invalid blog JSON.");
    }

    $blog = Blog::create([
        'title' => $data['title'],
        'excerpt' => \Str::limit(strip_tags($data['content']), 160),
        'content' => $data['content'],
        'prompt' => session('ai_user_prompt'),
        'refined_prompt' => $request->refined_prompt,
        'tone' => session('ai_tone'),
        'word_count' => str_word_count(strip_tags($data['content'])),
        'keywords' => $data['keywords'] ?? [],
        'meta_title' => $data['title'],
        'meta_description' => $data['meta_description'] ?? null,
        'category_id' => $request->category_id,
        'status' => $request->status,
        'published_at' => $request->status === 'published' ? now() : null,
        'ai_model' => 'gemini-2.5-flash',
        'temperature' => 0.6,
        'is_ai_generated' => true,
        'user_id' => auth()->id()
    ]);

    session()->forget(['ai_user_prompt','ai_tone','ai_word_count','ai_refined_prompt']);

    return redirect()->route('admin.blogs.create', $blog->id)
        ->with('success', 'AI Blog generated successfully!');
}

public function generateBlog(Request $request)
{
   
  
    Log::info('=== Gemini Blog Generation Started ===');

    $request->validate([
        'user_prompt' => 'required|string|max:1500',
        'tone' => 'required|string',
        'word_count' => 'required|integer|min:250|max:5000',
        'category_id' => 'nullable|exists:categories,id',
        'status' => 'required|in:draft,review,published'
    ]);
 
    $apiKey = config('services.gemini.key');

    $userPrompt = $request->user_prompt;
    $tone = $request->tone;
    $wordCount = $request->word_count;

    $systemPrompt = "
    Act as a professional blog writer.

    Topic: {$userPrompt}
    Tone: {$tone}
    Target Word Count: {$wordCount}

    Requirements:
    - SEO optimized
    - Engaging introduction
    - Proper H2 and H3 headings
    - Bullet points where appropriate
    - Strong conclusion
    - Return clean HTML content
    - Generate 5 SEO keywords
    - Generate meta description

    Return STRICT JSON only:
    {
        \"title\": \"Blog Title\",
        \"content\": \"Full HTML blog content\",
        \"keywords\": [\"k1\",\"k2\",\"k3\",\"k4\",\"k5\"],
        \"meta_description\": \"SEO meta description\"
    }
    ";

    try {

        // STEP 1: Generate Blog Content via Gemini
        $geminiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}";

        $response = Http::timeout(120)->post($geminiUrl, [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $systemPrompt]
                    ]
                ]
            ],
            'generationConfig' => [
                'temperature' => 0.7,
                'maxOutputTokens' => 4096
            ]
        ]);
       

        if ($response->failed()) {
    Log::error('Gemini Blog Failed', ['body' => $response->body()]);
    return back()->withErrors("Gemini failed to generate blog.");
}

// STEP 1: Extract Raw Text
$rawText = $response->json('candidates.0.content.parts.0.text');

if (!$rawText) {
    return back()->withErrors("No content returned from Gemini.");
}

// STEP 2: Extract JSON safely (production-safe method)
preg_match('/\{.*\}/s', $rawText, $matches);

$jsonString = $matches[0] ?? null;

if (!$jsonString) {
    return back()->withErrors("AI returned invalid JSON structure.");
}

// STEP 3: Decode JSON
$data = json_decode($jsonString, true);

if (!$data || !isset($data['content'])) {
    return back()->withErrors("AI failed to create valid blog JSON.");
}


// STEP 4: Store Blog
$blog = Blog::create([
    'title' => $data['title'] ?? 'Untitled',
    'excerpt' => \Str::limit(strip_tags($data['content']), 160),
    'content' => $data['content'],
    'prompt' => $userPrompt,
    'tone' => $tone,
    'word_count' => str_word_count(strip_tags($data['content'])),
    'keywords' => $data['keywords'] ?? [],
    'meta_title' => $data['title'] ?? null,
    'meta_description' => $data['meta_description'] ?? null,
    'category_id' => $request->category_id,
    'status' => $request->status,
    'published_at' => $request->status ==='published' ? now() : null,
    'ai_model' => 'gemini-1.5-pro',
    'temperature' => 0.7,
    'is_ai_generated' => true,
    'user_id' => auth()->id()
]);

return redirect()
    ->route('admin.blogs.create', $blog->id)
    ->with('success', 'AI Blog generated successfully!');
    } catch (\Exception $e) {
        Log::critical('Blog Generation Failure', ['msg' => $e->getMessage()]);
        return back()->withErrors("System Error: " . $e->getMessage());
    }
}
public function getBlogData($id)
{
    $blog = Blog::with('category')->findOrFail($id);

    // ✅ Increment views
    $blog->increment('views');

    return response()->json([
        'title' => $blog->title,
        'content' => $blog->content,
        'image' => $blog->featured_image 
            ? asset('storage/' . $blog->featured_image) 
            : null,
        'date' => optional($blog->published_at)->format('d M Y'),
        'views' => number_format($blog->views)
    ]);
}
}
