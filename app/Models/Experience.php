<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Experience extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company',
        'logo',
        'location',
        'start_date',
        'end_date',
        'current',
        'technologies',
        'order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'current' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'technologies' => 'array',
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(ExperienceTranslation::class);
    }
}
