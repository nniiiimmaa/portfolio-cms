<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SkillCategory extends Model
{
    protected $fillable = [
        'slug',
        'icon',
        'order',
    ];

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    /**
     * Category translations.
     */
    public function translations(): HasMany
    {
        return $this->hasMany(
            SkillCategoryTranslation::class
        );
    }
}
