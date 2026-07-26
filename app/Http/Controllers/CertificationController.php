<?php

namespace App\Http\Controllers;

use App\Http\Requests\CertificationRequest;
use App\Models\Certification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Throwable;

class CertificationController extends Controller
{
    public function index(){
        $certifications = Certification::with([ 'translations' ])
            ->orderBy('order')
            ->get();

        return Inertia::render('Certification/CertificationIndex', ['certifications' => $certifications]);
    }

    public function store(CertificationRequest $request)
    {
        try {

            DB::transaction(function () use ($request) {

                $certification = Certification::create([
                    'issue_date' => $request->issue_date,
                    'expiration_date' => $request->boolean('no_expiration')
                        ? null
                        : $request->expiration_date,
                    'credential_id' => $request->credential_id,
                    'credential_url' => $request->credential_url,
                    'image' => $request->image,
                    'order' => $request->order,
                ]);

                foreach ($request->translations as $languageId => $translation) {

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

                $certification->update([
                    'issue_date' => $request->issue_date,
                    'expiration_date' => $request->boolean('no_expiration')
                        ? null
                        : $request->expiration_date,
                    'credential_id' => $request->credential_id,
                    'credential_url' => $request->credential_url,
                    'image' => $request->image,
                    'order' => $request->order,
                ]);

                foreach ($request->translations as $languageId => $translation) {

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
