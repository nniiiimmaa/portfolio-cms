<?php

namespace App\Models;

use Database\Factories\ExperienceTranslationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExperienceTranslation extends Model
{
    /** @use HasFactory<ExperienceTranslationFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'experience_id',
        'locale',
        'position',
        'description',
    ];

    /**
     * Experience that owns this translation.
     */
    public function experience(): BelongsTo
    {
        return $this->belongsTo(Experience::class);
    }
}
