<?php

namespace App\Models;

use Database\Factories\ProjectTypeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectType extends Model
{
    /** @use HasFactory<ProjectTypeFactory> */
    use HasFactory;

    protected $fillable = [
        'slug',
    ];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function translations(): HasMany
    {
        return $this->hasMany(ProjectTypeTranslation::class);
    }
}
