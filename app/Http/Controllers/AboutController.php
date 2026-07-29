<?php

namespace App\Http\Controllers;

use App\Http\Requests\AboutRequest;
use App\Models\About;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Throwable;

class AboutController extends Controller
{
    public function edit()
    {
        $about = About::with('translations')->first();

        return Inertia::render('About/AboutEdit', [
            'about' => $about,
        ]);
    }

    public function update(AboutRequest $request)
    {
        try {

            DB::transaction(function () use ($request) {

                $about = About::firstOrFail();

                $imagePath = $about->image;

                // -------------------------------------------------
                // Remove current image
                // -------------------------------------------------

                if ($request->boolean('remove_image')) {

                    if (
                        $about->image &&
                        file_exists(public_path($about->image))
                    ) {
                        unlink(public_path($about->image));
                    }

                    $imagePath = null;
                }

                // -------------------------------------------------
                // Upload new image
                // -------------------------------------------------

                if ($request->hasFile('image')) {

                    // Delete previous image
                    if (
                        $about->image &&
                        file_exists(public_path($about->image))
                    ) {
                        unlink(public_path($about->image));
                    }

                    $file = $request->file('image');

                    $destination = public_path('images/about');

                    if (! file_exists($destination)) {
                        mkdir($destination, 0755, true);
                    }

                    $extension = $file->getClientOriginalExtension();

                    $fileName = Str::uuid() . '.' . $extension;

                    $file->move($destination, $fileName);

                    $imagePath = 'images/about/' . $fileName;
                }

                // -------------------------------------------------
                // Update About
                // -------------------------------------------------

                $about->update([
                    'available' => $request->boolean('available'),
                    'image' => $imagePath,
                ]);

                // -------------------------------------------------
                // Update translations
                // -------------------------------------------------

                foreach ($request->input('translations') as $translation) {

                    $about->translations()->updateOrCreate(
                        [
                            'language_id' => $translation['language_id'],
                        ],
                        [
                            'name' => $translation['name'],
                            'title' => $translation['title'],
                            'description' => $translation['description'],
                            'availability_text' => $translation['availability_text'] ?? null,
                        ]
                    );

                }

            });

            return redirect()
                ->back()
                ->with('success', 'About updated successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to update about section.', [
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
                    'about' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to update the about section.',
                ]);
        }
    }
}
