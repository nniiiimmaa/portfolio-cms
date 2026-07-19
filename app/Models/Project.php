<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = [
        'project_type_id',
        'project_status_id',
        'slug',
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
        return $this->belongsTo(ProjectType::class, 'project_type_id');
    }

    public function status()
    {
        return $this->belongsTo(ProjectStatus::class, 'project_status_id');
    }


    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class);
    }

    public function translations(): HasMany
    {
        return $this->hasMany(ProjectTranslation::class);
    }
}
