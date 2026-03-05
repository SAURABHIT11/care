<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContentDownload extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'content_id',
        'user_id',
        'ip_address',
        'user_agent',
        'downloaded_at'
    ];

    protected $casts = [
        'downloaded_at' => 'datetime',
    ];

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }
}
