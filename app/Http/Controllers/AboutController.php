<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class AboutController extends Controller
{
    public function edit()
    {
        $about = About::with('translations')->first();

        return Inertia::render('About/AboutEdit', [
            'about' => $about,
        ]);
    }

    public function update(Request $request)
    {
        try {

            $about = About::firstOrFail();

            $about->update([
                'available' => $request->boolean('available'),
                'image' => $request->image,
            ]);

            foreach ($request->translations as $translation) {
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

            return redirect()
                ->back()
                ->with('success', 'About updated successfully.');

        } catch (\Exception $e) {

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
