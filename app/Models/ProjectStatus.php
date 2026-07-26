<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'color',
    ];


    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function translations(): HasMany
    {
        return $this->hasMany(ProjectStatusTranslation::class);
    }
}
