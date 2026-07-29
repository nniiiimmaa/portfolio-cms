<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hobby extends Model
{
    /** @use HasFactory<\Database\Factories\HobbyFactory> */
    use HasFactory;

    protected $fillable = [
        'slug',
        'icon',
        'featured',
        'order',
    ];

    protected $casts = [
        'featured' => 'boolean',
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(
            HobbyTranslation::class
        );
    }

    public function images(): HasMany
    {
        return $this->hasMany(
            HobbyImage::class
        );
    }
}
