<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Language extends Model
{
    protected $fillable = [
        'code',
        'name',
        'native_name',
        'direction',
        'active',
        'order',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function aboutTranslations(): HasMany
    {
        return $this->hasMany(AboutTranslation::class);
    }

    public function experienceTranslations(): HasMany
    {
        return $this->hasMany(ExperienceTranslation::class);
    }
}
