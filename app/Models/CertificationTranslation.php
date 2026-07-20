<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CertificationTranslation extends Model
{
    protected $fillable = [
        'certification_id',
        'language_id',
        'title',
        'issuer_name',
        'issuer_country',
        'description',
    ];


    /**
     * Certification relationship.
     */
    public function certification(): BelongsTo
    {
        return $this->belongsTo(Certification::class);
    }


    /**
     * Language relationship.
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
