<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SkillTranslation extends Model
{
    protected $fillable = [
        'skill_id',
        'language_id',
        'name',
        'description',
    ];

    /**
     * Skill relationship.
     */
    public function skill(): BelongsTo
    {
        return $this->belongsTo(
            Skill::class
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
