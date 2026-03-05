<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name', 'slug', 'icon', 'sort_order', 'status'
    ];

    public function subCategories(): HasMany
    {
        return $this->hasMany(SubCategory::class);
    }

    public function contents(): HasMany
    {
        return $this->hasMany(Content::class);
    }
}
