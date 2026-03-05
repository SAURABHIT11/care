<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AgeGroup extends Model
{
    protected $fillable = [
        'label', 'min_age', 'max_age', 'sort_order', 'status'
    ];

    public function contents(): BelongsToMany
    {
        return $this->belongsToMany(Content::class, 'content_age_group');
    }
}
