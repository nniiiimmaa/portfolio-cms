<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestimonialTranslation extends Model
{
    protected $fillable = [
        'testimonial_id',
        'language_id',
        'name',
        'position',
        'company',
        'message',
    ];

    public function testimonial(): BelongsTo
    {
        return $this->belongsTo(
            Testimonial::class
        );
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(
            Language::class
        );
    }
}
