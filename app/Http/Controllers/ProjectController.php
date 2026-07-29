<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\ProjectStatus;
use App\Models\ProjectType;
use Illuminate\Support\Str;
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
            ->orderBy('order', 'desc')
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

                $logoPath = null;

                // -------------------------------------------------
                // Upload logo
                // -------------------------------------------------

                if ($request->hasFile('logo')) {

                    $file = $request->file('logo');

                    $destination = public_path('images/projects/logos');

                    if (! file_exists($destination)) {
                        mkdir($destination, 0755, true);
                    }

                    $fileName = Str::uuid() . '.svg';

                    $file->move($destination, $fileName);

                    $logoPath = 'images/projects/logos/' . $fileName;
                }


                // -------------------------------------------------
                // Create project
                // -------------------------------------------------

                $project = Project::create([
                    'project_type_id' => $request->input('project_type_id'),
                    'project_status_id' => $request->input('project_status_id'),
                    'slug' => $request->input('slug'),
                    'logo' => $logoPath,
                    'github_url' => $request->input('github_url'),
                    'live_url' => $request->input('live_url'),
                    'featured' => $request->boolean('featured'),
                    'order' => $request->integer('order'),
                    'technologies' => $request->input('technologies'),
                ]);


                // -------------------------------------------------
                // Upload screenshots
                // -------------------------------------------------

                if ($request->hasFile('images')) {

                    $destination = public_path('images/projects/screenshots');

                    if (! file_exists($destination)) {
                        mkdir($destination, 0755, true);
                    }

                    foreach ($request->file('images') as $index => $image) {

                        $extension = $image->getClientOriginalExtension();

                        $fileName = Str::uuid() . '.' . $extension;

                        $image->move($destination, $fileName);

                        $project->images()->create([
                            'path' => 'images/projects/screenshots/' . $fileName,
                            'type' => 'screenshot',
                            'order' => $index,
                        ]);
                    }
                }


                // -------------------------------------------------
                // Create translations
                // -------------------------------------------------

                foreach ($request->input('translations', []) as $languageId => $translation) {

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

                $logoPath = $project->logo;

                // -------------------------------------------------
                // Remove logo
                // -------------------------------------------------

                if ($request->boolean('remove_logo')) {

                    if (
                        $project->logo &&
                        file_exists(public_path($project->logo))
                    ) {
                        unlink(public_path($project->logo));
                    }

                    $logoPath = null;
                }


                // -------------------------------------------------
                // Upload new logo
                // -------------------------------------------------

                if ($request->hasFile('logo')) {

                    if (
                        $project->logo &&
                        file_exists(public_path($project->logo))
                    ) {
                        unlink(public_path($project->logo));
                    }

                    $file = $request->file('logo');

                    $destination = public_path('images/projects/logos');

                    if (! file_exists($destination)) {
                        mkdir($destination, 0755, true);
                    }

                    $fileName = Str::uuid() . '.svg';

                    $file->move($destination, $fileName);

                    $logoPath = 'images/projects/logos/' . $fileName;
                }


                // -------------------------------------------------
                // Update project
                // -------------------------------------------------

                $project->update([
                    'project_type_id' => $request->input('project_type_id'),
                    'project_status_id' => $request->input('project_status_id'),
                    'slug' => $request->input('slug'),
                    'logo' => $logoPath,
                    'github_url' => $request->input('github_url'),
                    'live_url' => $request->input('live_url'),
                    'featured' => $request->boolean('featured'),
                    'order' => $request->integer('order'),
                    'technologies' => $request->input('technologies'),
                ]);


                // -------------------------------------------------
                // Delete selected images
                // -------------------------------------------------

                foreach ($request->input('deleted_image_ids', []) as $imageId) {

                    $image = $project->images()
                        ->where('id', $imageId)
                        ->first();

                    if ($image) {

                        if (file_exists(public_path($image->path))) {
                            unlink(public_path($image->path));
                        }

                        $image->delete();
                    }

                }


                // -------------------------------------------------
                // Upload new images
                // -------------------------------------------------

                if ($request->hasFile('images')) {

                    $destination = public_path('images/projects/screenshots');

                    if (! file_exists($destination)) {
                        mkdir($destination, 0755, true);
                    }

                    $lastOrder = $project->images()
                        ->max('order') ?? -1;


                    foreach ($request->file('images') as $index => $image) {

                        $extension = $image->getClientOriginalExtension();

                        $fileName = Str::uuid() . '.' . $extension;

                        $image->move($destination, $fileName);

                        $project->images()->create([
                            'path' => 'images/projects/screenshots/' . $fileName,
                            'type' => 'screenshot',
                            'order' => $lastOrder + $index + 1,
                        ]);
                    }
                }


                // -------------------------------------------------
                // Update translations
                // -------------------------------------------------

                $project->translations()->delete();

                foreach ($request->input('translations', []) as $languageId => $translation) {

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

                // -------------------------------------------------
                // Delete project logo
                // -------------------------------------------------

                if (
                    $project->logo &&
                    file_exists(public_path($project->logo))
                ) {
                    unlink(public_path($project->logo));
                }


                // -------------------------------------------------
                // Delete project images
                // -------------------------------------------------

                foreach ($project->images as $image) {

                    if (
                        $image->path &&
                        file_exists(public_path($image->path))
                    ) {
                        unlink(public_path($image->path));
                    }

                }


                // -------------------------------------------------
                // Delete project
                // -------------------------------------------------

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
