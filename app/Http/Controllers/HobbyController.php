<?php

namespace App\Http\Controllers;

use App\Http\Requests\HobbyRequest;
use App\Models\Hobby;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Throwable;

class HobbyController extends Controller
{
    public function index(){
        $hobbies = Hobby::with(['translations', 'images'])
            ->orderby('order')
            ->get();

        return Inertia::render('Hobby/HobbyIndex', ['hobbies' => $hobbies]);
    }

    public function store(HobbyRequest $request)
    {
        try {

            DB::transaction(function () use ($request) {

                $hobby = Hobby::create([
                    'slug' => $request->slug,
                    'icon' => $request->icon,
                    'featured' => $request->boolean('featured'),
                    'order' => $request->order,
                ]);

                foreach ($request->translations as $languageId => $translation) {

                    $hobby->translations()->create([
                        'language_id' => $languageId,
                        'name' => $translation['name'],
                        'description' => $translation['description'] ?? null,
                    ]);

                }

            });

            return redirect()
                ->back()
                ->with('success', 'Hobby created successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to create hobby.', [
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
                    'hobby' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to create the hobby.',
                ]);
        }
    }

    public function update(HobbyRequest $request, Hobby $hobby)
    {
        try {

            DB::transaction(function () use ($request, $hobby) {

                $hobby->update([
                    'slug' => $request->slug,
                    'icon' => $request->icon,
                    'featured' => $request->boolean('featured'),
                    'order' => $request->order,
                ]);

                foreach ($request->translations as $languageId => $translation) {

                    $hobby->translations()->updateOrCreate(
                        [
                            'language_id' => $languageId,
                        ],
                        [
                            'name' => $translation['name'],
                            'description' => $translation['description'] ?? null,
                        ]
                    );

                }

            });

            return redirect()
                ->back()
                ->with('success', 'Hobby updated successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to update hobby.', [
                'user_id' => $request->user()?->id,
                'hobby_id' => $hobby->id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'hobby' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to update the hobby.',
                ]);
        }
    }

    public function destroy(Hobby $hobby)
    {
        try {

            DB::transaction(function () use ($hobby) {

                $hobby->delete();

            });

            return redirect()
                ->back()
                ->with('success', 'Hobby deleted successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to delete hobby.', [
                'user_id' => auth()->id(),
                'hobby_id' => $hobby->id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withErrors([
                    'hobby' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to delete the hobby.',
                ]);
        }
    }
}
