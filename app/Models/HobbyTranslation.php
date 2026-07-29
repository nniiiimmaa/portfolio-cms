<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HobbyTranslation extends Model
{
    protected $fillable = [
        'hobby_id',
        'language_id',
        'name',
        'description',
    ];


    public function hobby(): BelongsTo
    {
        return $this->belongsTo(
            Hobby::class
        );
    }


    public function language(): BelongsTo
    {
        return $this->belongsTo(
            Language::class
        );
    }
}
