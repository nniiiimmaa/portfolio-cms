<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectStatus extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectStatusFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];


    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
