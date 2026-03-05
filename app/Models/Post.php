<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Add this line to allow these fields to be saved
    protected $fillable = [
        'title', 
        'description', 
        'keywords', 
        'original_filename', 
        'upscaled_filename'
    ];
}