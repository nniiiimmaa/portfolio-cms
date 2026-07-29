<?php

namespace App\Http\Controllers;

use App\Http\Requests\EducationRequest;
use App\Models\Education;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Throwable;

class EducationController extends Controller
{
    public function index(){
        $educations = Education::with([ 'translations' ])
            ->orderBy('order', 'desc')
            ->get();

        return Inertia::render('Education/EducationIndex', ['educations' => $educations]);
    }

    public function store(EducationRequest $request)
    {
        try {

            DB::transaction(function () use ($request) {

                $logoPath = null;

                // -------------------------------------------------
                // Upload logo
                // -------------------------------------------------

                if ($request->hasFile('logo')) {

                    $file = $request->file('logo');

                    $destination = public_path('images/education');

                    if (! file_exists($destination)) {
                        mkdir($destination, 0755, true);
                    }

                    $extension = $file->getClientOriginalExtension();

                    $fileName = Str::uuid() . '.' . $extension;

                    $file->move($destination, $fileName);

                    $logoPath = 'images/education/' . $fileName;
                }


                // -------------------------------------------------
                // Create education
                // -------------------------------------------------

                $education = Education::create([
                    'start_date' => $request->input('start_date'),
                    'end_date' => $request->input('end_date'),
                    'score' => $request->input('score'),
                    'logo' => $logoPath,
                    'verification_url' => $request->input('verification_url'),
                    'verification_id' => $request->input('verification_id'),
                    'current' => $request->boolean('current'),
                    'order' => $request->integer('order'),
                ]);


                // -------------------------------------------------
                // Create translations
                // -------------------------------------------------

                foreach ($request->input('translations', []) as $languageId => $translation) {

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

                $logoPath = $education->logo;


                // -------------------------------------------------
                // Remove logo
                // -------------------------------------------------

                if ($request->boolean('remove_logo')) {

                    if (
                        $education->logo &&
                        file_exists(public_path($education->logo))
                    ) {
                        unlink(public_path($education->logo));
                    }

                    $logoPath = null;
                }


                // -------------------------------------------------
                // Upload new logo
                // -------------------------------------------------

                if ($request->hasFile('logo')) {

                    if (
                        $education->logo &&
                        file_exists(public_path($education->logo))
                    ) {
                        unlink(public_path($education->logo));
                    }


                    $file = $request->file('logo');

                    $destination = public_path('images/education');

                    if (! file_exists($destination)) {
                        mkdir($destination, 0755, true);
                    }


                    $extension = $file->getClientOriginalExtension();

                    $fileName = Str::uuid() . '.' . $extension;

                    $file->move($destination, $fileName);

                    $logoPath = 'images/education/' . $fileName;
                }


                // -------------------------------------------------
                // Update education
                // -------------------------------------------------

                $education->update([
                    'start_date' => $request->input('start_date'),
                    'end_date' => $request->input('end_date'),
                    'score' => $request->input('score'),
                    'logo' => $logoPath,
                    'verification_url' => $request->input('verification_url'),
                    'verification_id' => $request->input('verification_id'),
                    'current' => $request->boolean('current'),
                    'order' => $request->integer('order'),
                ]);


                // -------------------------------------------------
                // Update translations
                // -------------------------------------------------

                foreach ($request->input('translations', []) as $languageId => $translation) {

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


                // -------------------------------------------------
                // Delete logo
                // -------------------------------------------------

                if (
                    $education->logo &&
                    file_exists(public_path($education->logo))
                ) {
                    unlink(public_path($education->logo));
                }


                // -------------------------------------------------
                // Delete education
                // -------------------------------------------------

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
