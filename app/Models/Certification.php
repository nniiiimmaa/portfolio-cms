<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Certification extends Model
{
    /** @use HasFactory<\Database\Factories\CertificationFactory> */
    use HasFactory;

    protected $fillable = [
        'issue_date',
        'expiration_date',
        'credential_id',
        'credential_url',
        'image',
        'order',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'expiration_date' => 'date',
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(CertificationTranslation::class);
    }
}
