<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageAsset extends Model
{
    protected $fillable = ['title', 'description', 'ai_prompt', 'keywords', 'image_url'];
    
    protected $casts = [
        'keywords' => 'array', // Automatically handles JSON conversion
    ];
}