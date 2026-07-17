<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = [
        'project_type_id',
        'project_status_id',
        'title',
        'slug',
        'description',
        'logo',
        'github_url',
        'live_url',
        'featured',
        'order',
        'technologies',
    ];


    protected $casts = [
        'featured' => 'boolean',
        'technologies' => 'array',
    ];


    public function type()
    {
        return $this->belongsTo(ProjectType::class);
    }


    public function status()
    {
        return $this->belongsTo(ProjectStatus::class);
    }


    public function images()
    {
        return $this->hasMany(ProjectImage::class);
    }
}
