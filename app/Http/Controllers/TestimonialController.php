<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestimonialRequest;
use App\Models\Testimonial;
use Illuminate\Http\Request;
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

                $testimonial = Testimonial::create([
                    'photo' => $request->photo,
                    'company_logo' => $request->company_logo,
                    'rating' => $request->rating,
                    'approved' => $request->boolean('approved'),
                    'featured' => $request->boolean('featured'),
                    'order' => $request->order,
                ]);

                foreach ($request->translations as $languageId => $translation) {

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

                $testimonial->update([
                    'photo' => $request->boolean('remove_photo')
                        ? null
                        : $request->photo,

                    'company_logo' => $request->boolean('remove_company_logo')
                        ? null
                        : $request->company_logo,

                    'rating' => $request->rating,
                    'approved' => $request->boolean('approved'),
                    'featured' => $request->boolean('featured'),
                    'order' => $request->order,
                ]);

                foreach ($request->translations as $languageId => $translation) {

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

            DB::transaction(function () use ($testimonial) {

                $testimonial->delete();

            });

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
