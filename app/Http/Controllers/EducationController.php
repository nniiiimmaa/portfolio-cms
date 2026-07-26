<?php

namespace App\Http\Controllers;

use App\Http\Requests\EducationRequest;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Throwable;

class EducationController extends Controller
{
    public function index(){
        $educations = Education::with([ 'translations' ])
            ->orderBy('order')
            ->get();

        return Inertia::render('Education/EducationIndex', ['educations' => $educations]);
    }

    public function store(EducationRequest $request)
    {
        try {

            DB::transaction(function () use ($request) {

                $education = Education::create([
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'score' => $request->score,
                    'logo' => $request->logo,
                    'verification_url' => $request->verification_url,
                    'current' => $request->boolean('current'),
                    'order' => $request->order,
                ]);

                foreach ($request->translations as $languageId => $translation) {

                    $education->translations()->create([
                        'language_id' => $languageId,
                        'institution' => $translation['institution'],
                        'degree' => $translation['degree'],
                        'field' => $translation['field'] ?? null,
                        'location' => $translation['location'] ?? null,
                        'description' => $translation['description'] ?? null,
                    ]);

                }

            });

            return redirect()
                ->back()
                ->with('success', 'Education created successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to create education.', [
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
                    'education' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to create the education.',
                ]);
        }
    }

    public function update(EducationRequest $request, Education $education)
    {
        try {

            DB::transaction(function () use ($request, $education) {

                $education->update([
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'score' => $request->score,
                    'logo' => $request->logo,
                    'verification_url' => $request->verification_url,
                    'current' => $request->boolean('current'),
                    'order' => $request->order,
                ]);

                foreach ($request->translations as $languageId => $translation) {

                    $education->translations()->updateOrCreate(
                        [
                            'language_id' => $languageId,
                        ],
                        [
                            'institution' => $translation['institution'],
                            'degree' => $translation['degree'],
                            'field' => $translation['field'] ?? null,
                            'location' => $translation['location'] ?? null,
                            'description' => $translation['description'] ?? null,
                        ]
                    );

                }

            });

            return redirect()
                ->back()
                ->with('success', 'Education updated successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to update education.', [
                'user_id' => $request->user()?->id,
                'education_id' => $education->id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'education' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to update the education.',
                ]);
        }
    }

    public function destroy(Education $education)
    {
        try {

            DB::transaction(function () use ($education) {

                $education->delete();

            });

            return redirect()
                ->back()
                ->with('success', 'Education deleted successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to delete education.', [
                'user_id' => auth()->id(),
                'education_id' => $education->id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withErrors([
                    'education' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to delete the education.',
                ]);
        }
    }
}
