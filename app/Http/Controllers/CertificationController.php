<?php

namespace App\Http\Controllers;

use App\Http\Requests\CertificationRequest;
use App\Models\Certification;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Throwable;

class CertificationController extends Controller
{
    public function index(){
        $certifications = Certification::with([ 'translations' ])
            ->orderBy('order', 'desc')
            ->get();

        return Inertia::render('Certification/CertificationIndex', ['certifications' => $certifications]);
    }

    public function store(CertificationRequest $request)
    {
        try {

            DB::transaction(function () use ($request) {

                $imagePath = null;


                // -------------------------------------------------
                // Upload certification image
                // -------------------------------------------------

                if ($request->hasFile('image')) {

                    $file = $request->file('image');

                    $destination = public_path('images/certifications');

                    if (! file_exists($destination)) {
                        mkdir($destination, 0755, true);
                    }


                    $extension = $file->getClientOriginalExtension();

                    $fileName = Str::uuid() . '.' . $extension;

                    $file->move($destination, $fileName);

                    $imagePath = 'images/certifications/' . $fileName;
                }


                // -------------------------------------------------
                // Create certification
                // -------------------------------------------------

                $certification = Certification::create([
                    'issue_date' => $request->input('issue_date'),

                    'expiration_date' => $request->boolean('no_expiration')
                        ? null
                        : $request->input('expiration_date'),

                    'credential_id' => $request->input('credential_id'),
                    'credential_url' => $request->input('credential_url'),

                    // database column is "image"
                    'image' => $imagePath,

                    'order' => $request->integer('order'),
                ]);


                // -------------------------------------------------
                // Create translations
                // -------------------------------------------------

                foreach ($request->input('translations', []) as $languageId => $translation) {

                    $certification->translations()->create([
                        'language_id' => $languageId,
                        'title' => $translation['title'] ?? null,
                        'issuer_name' => $translation['issuer_name'] ?? null,
                        'issuer_country' => $translation['issuer_country'] ?? null,
                        'description' => $translation['description'] ?? null,
                    ]);

                }

            });

            return redirect()
                ->back()
                ->with('success', 'Certification created successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to create certification.', [
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
                    'certification' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to create the certification.',
                ]);
        }
    }

    public function update(CertificationRequest $request, Certification $certification)
    {
        try {

            DB::transaction(function () use ($request, $certification) {

                $imagePath = $certification->image;


                // -------------------------------------------------
                // Remove image
                // -------------------------------------------------

                if ($request->boolean('remove_image')) {

                    if (
                        $certification->image &&
                        file_exists(public_path($certification->image))
                    ) {
                        unlink(public_path($certification->image));
                    }

                    $imagePath = null;
                }


                // -------------------------------------------------
                // Upload new image
                // -------------------------------------------------

                if ($request->hasFile('image')) {

                    if (
                        $certification->image &&
                        file_exists(public_path($certification->image))
                    ) {
                        unlink(public_path($certification->image));
                    }


                    $file = $request->file('image');

                    $destination = public_path('images/certifications');

                    if (! file_exists($destination)) {
                        mkdir($destination, 0755, true);
                    }


                    $extension = $file->getClientOriginalExtension();

                    $fileName = Str::uuid() . '.' . $extension;

                    $file->move($destination, $fileName);

                    $imagePath = 'images/certifications/' . $fileName;
                }


                // -------------------------------------------------
                // Update certification
                // -------------------------------------------------

                $certification->update([
                    'issue_date' => $request->input('issue_date'),

                    'expiration_date' => $request->boolean('no_expiration')
                        ? null
                        : $request->input('expiration_date'),

                    'credential_id' => $request->input('credential_id'),
                    'credential_url' => $request->input('credential_url'),

                    'image' => $imagePath,

                    'order' => $request->integer('order'),
                ]);


                // -------------------------------------------------
                // Update translations
                // -------------------------------------------------

                foreach ($request->input('translations', []) as $languageId => $translation) {

                    $certification->translations()->updateOrCreate(
                        [
                            'language_id' => $languageId,
                        ],
                        [
                            'title' => $translation['title'] ?? null,
                            'issuer_name' => $translation['issuer_name'] ?? null,
                            'issuer_country' => $translation['issuer_country'] ?? null,
                            'description' => $translation['description'] ?? null,
                        ]
                    );

                }

            });

            return redirect()
                ->back()
                ->with('success', 'Certification updated successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to update certification.', [
                'user_id' => $request->user()?->id,
                'certification_id' => $certification->id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'certification' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to update the certification.',
                ]);
        }
    }

    public function destroy(Certification $certification)
    {
        try {

            DB::transaction(function () use ($certification) {


                // -------------------------------------------------
                // Delete certification image
                // -------------------------------------------------

                if (
                    $certification->image &&
                    file_exists(public_path($certification->image))
                ) {
                    unlink(public_path($certification->image));
                }


                // -------------------------------------------------
                // Delete certification
                // -------------------------------------------------

                $certification->delete();

            });

            return redirect()
                ->back()
                ->with('success', 'Certification deleted successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to delete certification.', [
                'user_id' => auth()->id(),
                'certification_id' => $certification->id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withErrors([
                    'certification' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to delete the certification.',
                ]);
        }
    }
}
