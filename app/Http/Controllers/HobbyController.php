<?php

namespace App\Http\Controllers;

use App\Http\Requests\HobbyRequest;
use App\Models\Hobby;
use Illuminate\Support\Str;
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

                // -------------------------------------------------
                // Create hobby
                // -------------------------------------------------

                $hobby = Hobby::create([
                    'slug' => $request->slug,
                    'icon' => $request->icon,
                    'featured' => $request->boolean('featured'),
                    'order' => $request->integer('order'),
                ]);


                // -------------------------------------------------
                // Upload hobby images
                // -------------------------------------------------

                if ($request->hasFile('images')) {

                    $destination = public_path('images/hobbies');

                    if (! file_exists($destination)) {
                        mkdir($destination, 0755, true);
                    }


                    foreach ($request->file('images') as $index => $image) {

                        $extension = $image->getClientOriginalExtension();

                        $fileName = Str::uuid() . '.' . $extension;

                        $image->move($destination, $fileName);


                        $hobby->images()->create([
                            'image' => 'images/hobbies/' . $fileName,
                            'alt' => null,
                            'featured' => $index === 0,
                            'order' => $index,
                        ]);
                    }

                }


                // -------------------------------------------------
                // Create translations
                // -------------------------------------------------

                foreach ($request->input('translations', []) as $languageId => $translation) {

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

                // -------------------------------------------------
                // Update hobby
                // -------------------------------------------------

                $hobby->update([
                    'slug' => $request->slug,
                    'icon' => $request->icon,
                    'featured' => $request->boolean('featured'),
                    'order' => $request->integer('order'),
                ]);


                // -------------------------------------------------
                // Delete selected images
                // -------------------------------------------------

                foreach ($request->input('deleted_image_ids', []) as $imageId) {

                    $image = $hobby->images()
                        ->where('id', $imageId)
                        ->first();

                    if ($image) {

                        if (
                            $image->image &&
                            file_exists(public_path($image->image))
                        ) {
                            unlink(public_path($image->image));
                        }

                        $image->delete();
                    }

                }


                // -------------------------------------------------
                // Upload new images
                // -------------------------------------------------

                if ($request->hasFile('images')) {

                    $destination = public_path('images/hobbies');

                    if (! file_exists($destination)) {
                        mkdir($destination, 0755, true);
                    }


                    $lastOrder = $hobby->images()
                        ->max('order') ?? -1;


                    foreach ($request->file('images') as $index => $image) {

                        $extension = $image->extension();

                        $fileName = Str::uuid() . '.' . $extension;

                        $image->move($destination, $fileName);


                        $hobby->images()->create([
                            'image' => 'images/hobbies/' . $fileName,
                            'alt' => null,
                            'featured' => false,
                            'order' => $lastOrder + $index + 1,
                        ]);

                    }

                }


                // -------------------------------------------------
                // Update translations
                // -------------------------------------------------

                foreach ($request->input('translations', []) as $languageId => $translation) {

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

                // -------------------------------------------------
                // Delete hobby images
                // -------------------------------------------------

                foreach ($hobby->images as $image) {

                    if (
                        $image->image &&
                        file_exists(public_path($image->image))
                    ) {
                        unlink(public_path($image->image));
                    }

                }


                // -------------------------------------------------
                // Delete hobby
                // -------------------------------------------------

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
