<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AboutTranslation extends Model
{
    protected $fillable = [
        'about_id',
        'language_id',
        'name',
        'title',
        'description',
        'availability_text',
    ];

    public function about(): BelongsTo
    {
        return $this->belongsTo(About::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
