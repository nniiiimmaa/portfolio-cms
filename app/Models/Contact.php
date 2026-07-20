<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory;

    protected $fillable = [
        'email',
        'whatsapp',
        'google_maps_url',
        'available',
    ];

    protected $casts = [
        'available' => 'boolean',
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(
            ContactTranslation::class
        );
    }
}
