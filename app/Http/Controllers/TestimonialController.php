<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestimonialRequest;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Throwable;

class TestimonialController extends Controller
{
    public function index(){
        $testimonials = Testimonial::with(['translations'])
            ->orderby('order')
            ->get();
        return Inertia::render('Testimonial/TestimonialIndex', ['testimonials' => $testimonials]);
    }

    public function store(TestimonialRequest $request)
    {
        try {

            DB::transaction(function () use ($request) {

                $photoPath = null;
                $companyLogoPath = null;


                // -------------------------------------------------
                // Upload testimonial photo
                // -------------------------------------------------

                if ($request->hasFile('photo')) {

                    $file = $request->file('photo');

                    $destination = public_path('images/testimonials/photos');

                    if (! file_exists($destination)) {
                        mkdir($destination, 0755, true);
                    }


                    $extension = $file->extension();

                    $fileName = Str::uuid() . '.' . $extension;

                    $file->move($destination, $fileName);

                    $photoPath = 'images/testimonials/photos/' . $fileName;
                }


                // -------------------------------------------------
                // Upload company logo
                // -------------------------------------------------

                if ($request->hasFile('company_logo')) {

                    $file = $request->file('company_logo');

                    $destination = public_path('images/testimonials/logos');

                    if (! file_exists($destination)) {
                        mkdir($destination, 0755, true);
                    }


                    $extension = $file->extension();

                    $fileName = Str::uuid() . '.' . $extension;

                    $file->move($destination, $fileName);

                    $companyLogoPath = 'images/testimonials/logos/' . $fileName;
                }


                // -------------------------------------------------
                // Create testimonial
                // -------------------------------------------------

                $testimonial = Testimonial::create([
                    'photo' => $photoPath,
                    'company_logo' => $companyLogoPath,
                    'rating' => $request->integer('rating'),
                    'approved' => $request->boolean('approved'),
                    'featured' => $request->boolean('featured'),
                    'order' => $request->integer('order'),
                ]);


                // -------------------------------------------------
                // Create translations
                // -------------------------------------------------

                foreach ($request->input('translations', []) as $languageId => $translation) {

                    $testimonial->translations()->create([
                        'language_id' => $languageId,
                        'name' => $translation['name'],
                        'position' => $translation['position'] ?? null,
                        'company' => $translation['company'] ?? null,
                        'message' => $translation['message'],
                    ]);

                }

            });


            return redirect()
                ->back()
                ->with('success', 'Testimonial created successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to create testimonial.', [
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
                    'testimonial' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to create the testimonial.',
                ]);
        }
    }

    public function update(TestimonialRequest $request, Testimonial $testimonial)
    {
        try {

            DB::transaction(function () use ($request, $testimonial) {

                $photoPath = $testimonial->photo;
                $companyLogoPath = $testimonial->company_logo;


                // -------------------------------------------------
                // Remove photo
                // -------------------------------------------------

                if ($request->boolean('remove_photo')) {

                    if (
                        $testimonial->photo &&
                        file_exists(public_path($testimonial->photo))
                    ) {
                        unlink(public_path($testimonial->photo));
                    }

                    $photoPath = null;
                }


                // -------------------------------------------------
                // Upload new photo
                // -------------------------------------------------

                if ($request->hasFile('photo')) {

                    if (
                        $testimonial->photo &&
                        file_exists(public_path($testimonial->photo))
                    ) {
                        unlink(public_path($testimonial->photo));
                    }


                    $file = $request->file('photo');

                    $destination = public_path('images/testimonials/photos');

                    if (! file_exists($destination)) {
                        mkdir($destination, 0755, true);
                    }


                    $extension = $file->extension();

                    $fileName = Str::uuid() . '.' . $extension;

                    $file->move($destination, $fileName);

                    $photoPath = 'images/testimonials/photos/' . $fileName;
                }


                // -------------------------------------------------
                // Remove company logo
                // -------------------------------------------------

                if ($request->boolean('remove_company_logo')) {

                    if (
                        $testimonial->company_logo &&
                        file_exists(public_path($testimonial->company_logo))
                    ) {
                        unlink(public_path($testimonial->company_logo));
                    }

                    $companyLogoPath = null;
                }


                // -------------------------------------------------
                // Upload new company logo
                // -------------------------------------------------

                if ($request->hasFile('company_logo')) {

                    if (
                        $testimonial->company_logo &&
                        file_exists(public_path($testimonial->company_logo))
                    ) {
                        unlink(public_path($testimonial->company_logo));
                    }


                    $file = $request->file('company_logo');

                    $destination = public_path('images/testimonials/logos');

                    if (! file_exists($destination)) {
                        mkdir($destination, 0755, true);
                    }


                    $extension = $file->extension();

                    $fileName = Str::uuid() . '.' . $extension;

                    $file->move($destination, $fileName);

                    $companyLogoPath = 'images/testimonials/logos/' . $fileName;
                }


                // -------------------------------------------------
                // Update testimonial
                // -------------------------------------------------

                $testimonial->update([
                    'photo' => $photoPath,
                    'company_logo' => $companyLogoPath,
                    'rating' => $request->integer('rating'),
                    'approved' => $request->boolean('approved'),
                    'featured' => $request->boolean('featured'),
                    'order' => $request->integer('order'),
                ]);


                // -------------------------------------------------
                // Update translations
                // -------------------------------------------------

                foreach ($request->input('translations', []) as $languageId => $translation) {

                    $testimonial->translations()->updateOrCreate(
                        [
                            'language_id' => $languageId,
                        ],
                        [
                            'name' => $translation['name'],
                            'position' => $translation['position'] ?? null,
                            'company' => $translation['company'] ?? null,
                            'message' => $translation['message'],
                        ]
                    );

                }

            });


            return redirect()
                ->back()
                ->with('success', 'Testimonial updated successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to update testimonial.', [
                'user_id' => $request->user()?->id,
                'testimonial_id' => $testimonial->id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'testimonial' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to update the testimonial.',
                ]);
        }
    }

    public function destroy(Testimonial $testimonial)
    {
        try {

            $files = [
                $testimonial->photo,
                $testimonial->company_logo,
            ];


            DB::transaction(function () use ($testimonial) {

                $testimonial->delete();

            });


            // -------------------------------------------------
            // Delete testimonial files
            // -------------------------------------------------

            foreach ($files as $file) {

                if (
                    $file &&
                    file_exists(public_path($file))
                ) {
                    unlink(public_path($file));
                }

            }


            return redirect()
                ->back()
                ->with('success', 'Testimonial deleted successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to delete testimonial.', [
                'user_id' => auth()->id(),
                'testimonial_id' => $testimonial->id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withErrors([
                    'testimonial' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to delete the testimonial.',
                ]);
        }
    }
}
