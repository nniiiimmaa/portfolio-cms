<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HobbyImage extends Model
{
    protected $fillable = [
        'hobby_id',
        'image',
        'alt',
        'featured',
        'order',
    ];

    protected $casts = [
        'featured' => 'boolean',
    ];


    public function hobby(): BelongsTo
    {
        return $this->belongsTo(
            Hobby::class
        );
    }
}
