<?php

namespace App\Models;

use Database\Factories\EducationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Education extends Model
{
    /** @use HasFactory<EducationFactory> */
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'score',
        'logo',
        'verification_url',
        'current',
        'order',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'score' => 'decimal:2',
        'current' => 'boolean',
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(EducationTranslation::class);
    }
}
