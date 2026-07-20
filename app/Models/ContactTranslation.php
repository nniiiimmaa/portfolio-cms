<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactTranslation extends Model
{
    protected $fillable = [
        'contact_id',
        'language_id',
        'description',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'working_hours',
    ];


    public function contact(): BelongsTo
    {
        return $this->belongsTo(
            Contact::class
        );
    }


    public function language(): BelongsTo
    {
        return $this->belongsTo(
            Language::class
        );
    }
}
