<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectStatus;
use App\Models\ProjectType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
public function index()
{
    $projects = Project::with([
        'translations',
        'images',
        'status.translations',
        'type.translations',
    ])
        ->orderBy('order')
        ->get();

    $projectTypes = ProjectType::with(['translations'])->orderBy('slug')->get();

    $projectStatuses = ProjectStatus::with(['translations'])->orderBy('slug')->get();

    return Inertia::render('Project/ProjectIndex', [
        'projects' => $projects,
        'projectTypes' => $projectTypes,
        'projectStatuses' => $projectStatuses,
    ]);
}
}
