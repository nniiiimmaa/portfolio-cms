<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExperienceRequest;
use App\Models\Experience;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Throwable;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::with('translations')
            ->orderBy('order', 'asc')
            ->get();

        return Inertia::render('Experience/ExperienceIndex', [
            'experiences' => $experiences,
        ]);
    }

    public function store(ExperienceRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $experience = Experience::create([
                    'company' => $request->company,
                    'location' => $request->location,
                    'logo' => $request->logo,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'current' => $request->boolean('current'),
                    'technologies' => $request->technologies,
                    'order' => $request->order,
                ]);

                foreach ($request->translations as $languageId => $translation) {
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

                $experience->update([
                    'company' => $request->company,
                    'location' => $request->location,
                    'logo' => $request->logo,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'current' => $request->boolean('current'),
                    'technologies' => $request->technologies,
                    'order' => $request->order,
                ]);

                $experience->translations()->delete();

                foreach ($request->translations as $languageId => $translation) {
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
