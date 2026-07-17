<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    /** @use HasFactory<\Database\Factories\SocialLinkFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'url',
        'username',
        'color',
        'active',
        'order',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];
}
