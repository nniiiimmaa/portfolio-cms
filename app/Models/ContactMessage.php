<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    /** @use HasFactory<\Database\Factories\ContactMessageFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'whatsapp',
        'company',
        'subject',
        'message',
        'read_at',
    ];


    protected $casts = [
        'read_at' => 'datetime',
    ];
}
