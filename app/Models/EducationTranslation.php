<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EducationTranslation extends Model
{
    protected $fillable = [
        'education_id',
        'language_id',
        'institution',
        'degree',
        'field',
        'location',
        'description',
    ];


    /**
     * Education relationship.
     */
    public function education(): BelongsTo
    {
        return $this->belongsTo(Education::class);
    }


    /**
     * Language relationship.
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
