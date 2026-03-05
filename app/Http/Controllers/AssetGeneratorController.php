<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImageAsset;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
class AssetGeneratorController extends Controller
{
    // List all generated assets
    public function index()
    {
        $assets = ImageAsset::latest()->paginate(10);
        return view('assets.index', compact('assets'));
    }

    public function create() {
        return view('assets.create');
    }

// public function generate(Request $request)
// {
//     Log::info('=== Gemini Image Metadata Generation Started ===');
//     $request->validate(['user_query' => 'required|string|max:500']);

//     $apiKey = config('services.gemini.key'); 
//     $userQuery = $request->user_query;

//     $systemPrompt = "Act as an Image Prompt Engineer. For the query: '$userQuery', return a JSON array of 2 objects. 
//     Each object must have: 'title', 'description', 'ai_prompt', and 'keywords' (as an array of strings). 
//     Return ONLY the JSON code block.";

//     try {
//         Log::info('Sending request to Gemini API...');
        
//         // Note: Using gemini-1.5-flash as 2.5 does not exist yet
//         $model = "gemini-2.5-flash"; 
//         $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";

//         $response = Http::withHeaders(['Content-Type' => 'application/json'])
//             ->post($url, [
//                 'contents' => [['parts' => [['text' => $systemPrompt]]]]
//             ]);

//         if ($response->failed()) {
//             Log::error('Gemini API Connection Failed', ['body' => $response->body()]);
//             return back()->withErrors("Gemini API Error: Check logs.");
//         }

//         $rawText = $response->json('candidates.0.content.parts.0.text');
//         $jsonString = preg_replace('/```json|```/', '', $rawText);
//         $results = json_decode(trim($jsonString), true);

//         // Extract array if wrapped in a 'json' key
//         if (isset($results['json'])) {
//             $results = is_string($results['json']) ? json_decode($results['json'], true) : $results['json'];
//         }

//         if (!is_array($results)) {
//             Log::error('JSON Parsing failed to produce an array');
//             return back()->withErrors("Failed to parse AI response.");
//         }

//         Log::info('Saving variations to database...');

//         // Loop through the 3 variations and save them
//         foreach ($results as $item) {
//             // Replace 'ImageAsset' with your actual Model name
//             ImageAsset::create([
//                 'title'       => $item['title'] ?? 'Untitled',
//                 'description' => $item['description'] ?? '',
//                 'ai_prompt'   => $item['ai_prompt'] ?? '',
//                 'keywords'    => $item['keywords'] ?? [], // Ensure Model has $casts 'keywords' => 'array'
//             ]);
//         }

//         Log::info('Successfully saved 3 variations to DB.');

//         return redirect()->route('assets.index')->with('success', '3 AI variations generated and saved successfully!');

//     } catch (\Exception $e) {
//         Log::critical('Gemini Critical Failure', ['message' => $e->getMessage()]);
//         return back()->withErrors("System Error: " . $e->getMessage());
//     }
// }

public function generate(Request $request)
{
    Log::info('=== Gemini + Imagen Unified Generation Started ===');
    
    $request->validate([
        'user_query'   => 'required|string|max:500',
        'resolution'   => 'required|in:1K,2K',
        'aspect_ratio' => 'required|in:1:1,16:9,9:16,4:3'
    ]);

    $apiKey = config('services.gemini.key');
    $apiKeyp=config('services.gemini.paid');
    $userQuery = $request->user_query;
    $resInput = $request->resolution; // 1K or 2K
    $ratioInput = $request->aspect_ratio;

    $systemPrompt = "Act as an Image Prompt Engineer. For: '$userQuery', return a JSON object. Include: 'title', 'description', 'ai_prompt', and 'keywords' (array). Return ONLY the JSON.";

    try {
        // --- STEP 1: Generate Metadata via Gemini ---
        $geminiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}";
        
        $geminiResponse = Http::post($geminiUrl, [
            'contents' => [['parts' => [['text' => $systemPrompt]]]]
        ]);

        $rawText = $geminiResponse->json('candidates.0.content.parts.0.text');
        $jsonString = preg_replace('/```json|```/', '', $rawText);
        $meta = json_decode(trim($jsonString), true);

        if (!isset($meta['ai_prompt'])) {
            return back()->withErrors("AI failed to create a valid prompt.");
        }

        // --- STEP 2: Generate Image via Imagen ---
        // Switched to imagen-3.1 or 4.0 if your project has whitelist access
        $imagenModel = "imagen-4.0-generate-001"; 
        $imagenUrl = "https://generativelanguage.googleapis.com/v1beta/models/{$imagenModel}:predict?key={$apiKeyp}";

        // $imagenResponse = Http::timeout(100)->post($imagenUrl, [
        //     'instances' => [['prompt' => $meta['ai_prompt']]],
        //     'parameters' => [
        //         'sampleCount' => 1,
        //         'aspectRatio' => $ratioInput, // From Request
        //         'imageSize'   => $resInput,   // From Request (1K or 2K)
        //         'outputMimeType' => "image/jpeg",
        //         'personGeneration' => "ALLOW_ADULT"
        //     ]
        // ]);

        $imagenResponse = Http::timeout(120)->post($imagenUrl, [ // Increased timeout for 2K PNG
    'instances' => [['prompt' => $meta['ai_prompt']]],
    'parameters' => [
        'sampleCount' => 1,
        'aspectRatio' => $ratioInput,
        'imageSize'   => "2K",            // Force 2K
        'outputMimeType' => "image/png",  // Changed from image/jpeg
        'personGeneration' => "ALLOW_ADULT"
    ]
]);

        if ($imagenResponse->failed()) {
            Log::error('Imagen Generation Failed', ['body' => $imagenResponse->body()]);
            return back()->withErrors("Imagen failed to generate image.");
        }

        $base64Image = $imagenResponse->json('predictions.0.bytesBase64Encoded');
        $imagePath = null;

        // if ($base64Image) {
        //     $imageContent = base64_decode($base64Image);
        //     $imagePath = 'ai_images/' . Str::random(40) . '.jpg';
        //     Storage::disk('public')->put($imagePath, $imageContent);
        // }
if ($base64Image) {
    $imageContent = base64_decode($base64Image);
    // Change extension to .png
    $imagePath = 'ai_images/' . Str::random(40) . '.png'; 
    Storage::disk('public')->put($imagePath, $imageContent);
}
        // --- STEP 3: Save to DB ---
        ImageAsset::create([
            'title'       => $meta['title'] ?? 'Untitled',
            'description' => $meta['description'] ?? '',
            'ai_prompt'   => $meta['ai_prompt'],
            'keywords'    => $meta['keywords'] ?? [],
            'image_url'   => $imagePath,
        ]);

        return redirect()->route('assets.index')->with('success', 'Asset and Image generated successfully!');

    } catch (\Exception $e) {
        Log::critical('Unified Generation Failure', ['msg' => $e->getMessage()]);
        return back()->withErrors("System Error: " . $e->getMessage());
    }
}
    public function store(Request $request)
    {
        ImageAsset::create($request->all());
        return redirect()->route('assets.index')->with('success', 'Asset saved! Now upload the image.');
    }

    // Show edit form (where image upload happens)
    public function edit(ImageAsset $asset)
    {
        return view('assets.edit', compact('asset'));
    }

    // Update metadata and handle image upload
    public function update(Request $request, ImageAsset $asset)
    {
        $request->validate([
            'title' => 'required',
          'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:46080'
        ]);

        $data = $request->only(['title', 'description', 'ai_prompt', 'keywords']);

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($asset->image_url) {
                Storage::disk('public')->delete($asset->image_url);
            }
            $data['image_url'] = $request->file('image')->store('ai_images', 'public');
        }

        $asset->update($data);

        return redirect()->route('assets.index')->with('success', 'Asset updated successfully.');
    }

    // Delete asset and its image
    public function destroy(ImageAsset $asset)
    {
        if ($asset->image_url) {
            Storage::disk('public')->delete($asset->image_url);
        }
        $asset->delete();

        return back()->with('success', 'Asset deleted.');
    }
}