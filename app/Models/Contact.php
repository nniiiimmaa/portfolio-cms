<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory;

        protected $fillable = [
        'title',
        'description',
        'email',
        'whatsapp',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'google_maps_url',
        'working_hours',
        'available',
    ];

    protected $casts = [
        'available' => 'boolean',
    ];
}
