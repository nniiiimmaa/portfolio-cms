<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStatusRequest;
use App\Models\ProjectStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProjectStatusController extends Controller
{
    public function store(ProjectStatusRequest $request)
    {
        try {

            DB::transaction(function () use ($request) {

                $projectStatus = ProjectStatus::create([
                    'slug' => $request->slug,
                    'color' => $request->color,
                ]);

                foreach ($request->translations as $languageId => $translation) {

                    $projectStatus->translations()->create([
                        'language_id' => $languageId,
                        'name' => $translation['name'],
                    ]);
                }

            });

            return redirect()
                ->back()
                ->with('success', 'Project status created successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to create project status.', [
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
                    'project_status' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to create the project status.',
                ]);
        }
    }

    public function update(ProjectStatusRequest $request, ProjectStatus $projectStatus)
    {
        try {

            DB::transaction(function () use ($request, $projectStatus) {

                $projectStatus->update([
                    'slug' => $request->slug,
                    'color' => $request->color,
                ]);

                foreach ($request->translations as $translation) {

                    $projectStatus->translations()->updateOrCreate(
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
                ->with('success', 'Project status updated successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to update project status.', [
                'user_id' => $request->user()?->id,
                'project_status_id' => $projectStatus->id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'project_status' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to update the project status.',
                ]);
        }
    }

    public function destroy(ProjectStatus $projectStatus)
    {
        try {

            DB::transaction(function () use ($projectStatus) {

                $projectStatus->delete();

            });

            return redirect()
                ->back()
                ->with('success', 'Project status deleted successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to delete project status.', [
                'user_id' => auth()->id(),
                'project_status_id' => $projectStatus->id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withErrors([
                    'project_status' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to delete the project status.',
                ]);
        }
    }
}
