<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SkillCategoryTranslation extends Model
{
    protected $fillable = [
        'skill_category_id',
        'language_id',
        'name',
    ];


    /**
     * Skill category relationship.
     */
    public function skillCategory(): BelongsTo
    {
        return $this->belongsTo(
            SkillCategory::class
        );
    }


    /**
     * Language relationship.
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(
            Language::class
        );
    }
}
