<?php

namespace App\Models;

use Database\Factories\EducationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    /** @use HasFactory<EducationFactory> */
    use HasFactory;

    protected $fillable = [
        'institution',
        'degree',
        'field',
        'location',
        'start_date',
        'end_date',
        'score',
        'description',
        'logo',
        'current',
        'order',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'score' => 'decimal:2',
        'current' => 'boolean',
    ];
}
