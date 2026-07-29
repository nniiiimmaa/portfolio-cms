<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExperienceRequest;
use App\Models\Experience;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Throwable;
use Illuminate\Support\Str;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::with('translations')
            ->orderBy('order', 'desc')
            ->get();

        return Inertia::render('Experience/ExperienceIndex', [
            'experiences' => $experiences,
        ]);
    }

    public function store(ExperienceRequest $request)
    {
        try {

            DB::transaction(function () use ($request) {

                $logoPath = null;

                // -------------------------------------------------
                // Upload logo
                // -------------------------------------------------

                if ($request->hasFile('logo')) {

                    $file = $request->file('logo');

                    $destination = public_path('images/experiences');

                    if (! file_exists($destination)) {
                        mkdir($destination, 0755, true);
                    }

                    $fileName = Str::uuid() . '.svg';

                    $file->move($destination, $fileName);

                    $logoPath = 'images/experiences/' . $fileName;
                }


                // -------------------------------------------------
                // Create experience
                // -------------------------------------------------

                $experience = Experience::create([
                    'company' => $request->input('company'),
                    'location' => $request->input('location'),
                    'logo' => $logoPath,
                    'start_date' => $request->input('start_date'),
                    'end_date' => $request->input('end_date'),
                    'current' => $request->boolean('current'),
                    'technologies' => $request->input('technologies'),
                    'order' => $request->integer('order'),
                ]);


                // -------------------------------------------------
                // Create translations
                // -------------------------------------------------

                foreach ($request->input('translations', []) as $languageId => $translation) {

                    $experience->translations()->create([
                        'language_id' => $languageId,
                        'position' => $translation['position'],
                        'description' => $translation['description'],
                    ]);

                }

            });

            return redirect()
                ->back()
                ->with('success', 'Experience created successfully.');

        } catch (Throwable $e) {

            report($e);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'experience' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to create the experience.',
                ]);
        }
    }

    public function update(ExperienceRequest $request, Experience $experience)
    {
        try {

            DB::transaction(function () use ($request, $experience) {

                $logoPath = $experience->logo;

                // -------------------------------------------------
                // Remove logo command
                // -------------------------------------------------

                if ($request->boolean('remove_logo')) {

                    if (
                        $experience->logo &&
                        file_exists(public_path($experience->logo))
                    ) {
                        unlink(public_path($experience->logo));
                    }

                    $logoPath = null;
                }


                // -------------------------------------------------
                // New logo uploaded
                // -------------------------------------------------

                if ($request->hasFile('logo')) {

                    // Delete old logo only when replacing it
                    if (
                        $experience->logo &&
                        file_exists(public_path($experience->logo))
                    ) {
                        unlink(public_path($experience->logo));
                    }

                    $file = $request->file('logo');

                    $destination = public_path('images/experiences');

                    if (! file_exists($destination)) {
                        mkdir($destination, 0755, true);
                    }

                    $extension = $file->getClientOriginalExtension();

                    $fileName = Str::uuid() . '.' . $extension;

                    $file->move($destination, $fileName);

                    $logoPath = 'images/experiences/' . $fileName;
                }


                // -------------------------------------------------
                // Update experience
                // -------------------------------------------------

                $experience->update([
                    'company' => $request->input('company'),
                    'location' => $request->input('location'),
                    'logo' => $logoPath,
                    'start_date' => $request->input('start_date'),
                    'end_date' => $request->input('end_date'),
                    'current' => $request->boolean('current'),
                    'technologies' => $request->input('technologies'),
                    'order' => $request->integer('order'),
                ]);


                // -------------------------------------------------
                // Update translations
                // -------------------------------------------------

                $experience->translations()->delete();

                foreach ($request->input('translations', []) as $languageId => $translation) {

                    $experience->translations()->create([
                        'language_id' => $languageId,
                        'position' => $translation['position'],
                        'description' => $translation['description'],
                    ]);

                }

            });

            return redirect()
                ->back()
                ->with('success', 'Experience updated successfully.');

        } catch (Throwable $e) {

            report($e);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'experience' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to update the experience.',
                ]);
        }
    }

    public function destroy(Experience $experience)
    {
        try {

            DB::transaction(function () use ($experience) {

                // -------------------------------------------------
                // Delete logo
                // -------------------------------------------------

                if (
                    $experience->logo &&
                    file_exists(public_path($experience->logo))
                ) {
                    unlink(public_path($experience->logo));
                }


                // -------------------------------------------------
                // Delete experience
                // -------------------------------------------------

                $experience->delete();

            });

            return redirect()
                ->back()
                ->with('success', 'Experience deleted successfully.');

        } catch (Throwable $e) {

            report($e);

            return redirect()
                ->back()
                ->withErrors([
                    'experience' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to delete the experience.',
                ]);
        }
    }
}
