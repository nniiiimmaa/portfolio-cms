<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    /**
     * Mass assignable attributes.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company',
        'logo',
        'position',
        'location',
        'description',
        'start_date',
        'end_date',
        'is_current',
        'technologies',
    ];

    /**
     * Attribute casting.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
        'technologies' => 'array',
    ];
}
