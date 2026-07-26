<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Throwable;

class ContactController extends Controller
{
    public function edit(){
        $contact = Contact::with('translations')
            ->first();

        return Inertia::render('Contact/ContactEdit', ['contact' => $contact]);
    }

    public function update(ContactRequest $request)
    {
        try {

            DB::transaction(function () use ($request) {

                $contact = Contact::firstOrFail();

                $contact->update([
                    'email' => $request->email,
                    'whatsapp' => $request->whatsapp,
                    'google_maps_url' => $request->google_maps_url,
                    'available' => $request->boolean('available'),
                ]);

                foreach ($request->translations as $translation) {

                    $contact->translations()->updateOrCreate(
                        [
                            'language_id' => $translation['language_id'],
                        ],
                        [
                            'description' => $translation['description'] ?? null,
                            'address' => $translation['address'] ?? null,
                            'city' => $translation['city'] ?? null,
                            'state' => $translation['state'] ?? null,
                            'country' => $translation['country'] ?? null,
                            'postal_code' => $translation['postal_code'] ?? null,
                            'working_hours' => $translation['working_hours'] ?? null,
                        ]
                    );

                }

            });

            return redirect()
                ->back()
                ->with('success', 'Contact updated successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to update contact.', [
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
                    'contact' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to update the contact.',
                ]);
        }
    }
}
