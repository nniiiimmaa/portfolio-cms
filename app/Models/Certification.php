<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    /** @use HasFactory<\Database\Factories\CertificationFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'issuer_name',
        'issuer_country',
        'issue_date',
        'expiration_date',
        'credential_id',
        'credential_url',
        'image',
        'description',
        'order',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'expiration_date' => 'date',
    ];
}
