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

    public function projectTypeTranslations(): HasMany
    {
        return $this->hasMany(ProjectTypeTranslation::class);
    }

    public function projectStatusTranslations(): HasMany
    {
        return $this->hasMany(ProjectStatusTranslation::class);
    }

    public function projectTranslations(): HasMany
    {
        return $this->hasMany(ProjectTranslation::class);
    }

    public function educationTranslations(): HasMany
    {
        return $this->hasMany(EducationTranslation::class);
    }

    public function certificationTranslations(): HasMany
    {
        return $this->hasMany(CertificationTranslation::class);
    }
}
