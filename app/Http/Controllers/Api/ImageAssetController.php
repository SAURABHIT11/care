<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ImageAsset;
use Illuminate\Http\Request;

class ImageAssetController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string',
            'description' => 'nullable|string',
            'ai_prompt'   => 'nullable|string',
            'keywords'    => 'required|array',
            'image_url'   => 'required|string',
        ]);

        $asset = ImageAsset::create($validated);

        return response()->json($asset, 201);
    }
}