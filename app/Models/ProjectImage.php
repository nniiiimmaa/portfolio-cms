<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectImageFactory> */
    use HasFactory;

    protected $fillable = [
        'project_id',
        'path',
        'type',
        'order',
    ];


    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
