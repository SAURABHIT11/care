<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'prompt',
        'tone',
        'word_count',
        'keywords',
        'ai_model',
        'temperature',
        'featured_image',
        'featured_image_alt',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'published_at',
        'scheduled_at',
        'views',
        'likes',
        'is_featured',
        'is_ai_generated'
    ];

    protected $casts = [
        'keywords' => 'array',
        'meta_keywords' => 'array',
        'published_at' => 'datetime',
        'scheduled_at' => 'datetime',
        'temperature' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_ai_generated' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Boot Method (Auto Slug Generator)
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title) . '-' . uniqid();
            }
        });

        static::updating(function ($blog) {
            if ($blog->isDirty('title')) {
                $blog->slug = Str::slug($blog->title) . '-' . uniqid();
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes (Very Useful for Production)
    |--------------------------------------------------------------------------
    */

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->whereNotNull('published_at');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    public function incrementViews()
    {
        $this->increment('views');
    }
}