<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\ProjectStatus;
use App\Models\ProjectType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Throwable;

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

    public function store(ProjectRequest $request)
    {
        try {

            DB::transaction(function () use ($request) {

                $project = Project::create([
                    'project_type_id' => $request->project_type_id,
                    'project_status_id' => $request->project_status_id,
                    'slug' => $request->slug,
                    'logo' => $request->logo,
                    'github_url' => $request->github_url,
                    'live_url' => $request->live_url,
                    'featured' => $request->boolean('featured'),
                    'order' => $request->order,
                    'technologies' => $request->technologies,
                ]);

                foreach ($request->translations as $languageId => $translation) {

                    $project->translations()->create([
                        'language_id' => $languageId,
                        'title' => $translation['title'],
                        'description' => $translation['description'],
                    ]);
                }

            });

            return redirect()
                ->back()
                ->with('success', 'Project created successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to create project.', [
                'user_id' => $request->user()?->id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'project' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to create the project.',
                ]);
        }
    }

    public function update(ProjectRequest $request, Project $project)
    {
        try {

            DB::transaction(function () use ($request, $project) {

                $project->update([
                    'project_type_id' => $request->project_type_id,
                    'project_status_id' => $request->project_status_id,
                    'slug' => $request->slug,
                    'logo' => $request->logo,
                    'github_url' => $request->github_url,
                    'live_url' => $request->live_url,
                    'featured' => $request->boolean('featured'),
                    'order' => $request->order,
                    'technologies' => $request->technologies,
                ]);

                $project->translations()->delete();

                foreach ($request->translations as $languageId => $translation) {
                    $project->translations()->create([
                        'language_id' => $languageId,
                        'title' => $translation['title'],
                        'description' => $translation['description'],
                    ]);
                }

            });

            return redirect()
                ->back()
                ->with('success', 'Project updated successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to update project.', [
                'user_id' => $request->user()?->id,
                'project_id' => $project->id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'project' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to update the project.',
                ]);
        }
    }

    public function destroy(Project $project)
    {
        try {

            DB::transaction(function () use ($project) {
                $project->delete();
            });

            return redirect()
                ->back()
                ->with('success', 'Project deleted successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to delete project.', [
                'user_id' => auth()->id(),
                'project_id' => $project->id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withErrors([
                    'project' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to delete the project.',
                ]);
        }
    }
}
