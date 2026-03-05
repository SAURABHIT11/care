<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContentFile extends Model
{
    protected $fillable = [
        'content_id',
        'file_type',
        'file_path',
        'preview_image',
        'sort_order',
        'status'
    ];

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }
}
