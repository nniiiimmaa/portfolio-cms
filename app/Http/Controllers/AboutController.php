<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
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

            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }
}
