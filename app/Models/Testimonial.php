<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Testimonial extends Model
{
    /** @use HasFactory<\Database\Factories\TestimonialFactory> */
    use HasFactory;

        protected $fillable = [
        'name',
        'position',
        'company',
        'company_logo',
        'photo',
        'rating',
        'message',
        'approved',
        'featured',
        'order',
    ];

    protected $casts = [
        'approved' => 'boolean',
        'featured' => 'boolean',
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(
            TestimonialTranslation::class
        );
    }
}
