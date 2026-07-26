<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectTypeRequest;
use App\Models\ProjectType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProjectTypeController extends Controller
{
    public function store(ProjectTypeRequest $request)
    {
        try {

            DB::transaction(function () use ($request) {

                $projectType = ProjectType::create([
                    'slug' => $request->slug,
                    'color' => $request->color,
                ]);

                foreach ($request->translations as $languageId => $translation) {

                    $projectType->translations()->create([
                        'language_id' => $languageId,
                        'name' => $translation['name'],
                    ]);
                }
            });

            return redirect()
                ->back()
                ->with('success', 'Project type created successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to create project type.', [
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
                    'project_type' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to create the project type.',
                ]);
        }
    }

    public function update(ProjectTypeRequest $request, ProjectType $projectType)
    {
        try {

            DB::transaction(function () use ($request, $projectType) {

                $projectType->update([
                    'slug' => $request->slug,
                    'color' => $request->color,
                ]);

                foreach ($request->translations as $translation) {

                    $projectType->translations()->updateOrCreate(
                        [
                            'language_id' => $translation['language_id'],
                        ],
                        [
                            'name' => $translation['name'],
                        ]
                    );

                }

            });

            return redirect()
                ->back()
                ->with('success', 'Project type updated successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to update project type.', [
                'user_id' => $request->user()?->id,
                'project_type_id' => $projectType->id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'project_type' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to update the project type.',
                ]);
        }
    }

    public function destroy(ProjectType $projectType)
    {
        try {

            DB::transaction(function () use ($projectType) {
                $projectType->delete();
            });

            return redirect()
                ->back()
                ->with('success', 'Project type deleted successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to delete project type.', [
                'user_id' => auth()->id(),
                'project_type_id' => $projectType->id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withErrors([
                    'project_type' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to delete the project type.',
                ]);
        }
    }
}
