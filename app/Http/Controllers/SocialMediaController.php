<?php

namespace App\Http\Controllers;

use App\Http\Requests\SocialLinkRequest;
use App\Models\SocialLink;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Throwable;

class SocialMediaController extends Controller
{
    public function index(){
        $links = SocialLink::orderBy('order')->get();

        return Inertia::render('SocialMedia/SocialMediaIndex', [
            'links' => $links,
        ]);
    }

    public function store(SocialLinkRequest $request)
    {
        try {

            DB::transaction(function () use ($request) {

                $iconPath = null;

                if ($request->hasFile('icon')) {

                    $file = $request->file('icon');

                    $destination = public_path('svg');

                    if (! file_exists($destination)) {
                        mkdir($destination, 0755, true);
                    }

                    $fileName = Str::uuid() . '.svg';

                    $file->move($destination, $fileName);

                    $iconPath = 'svg/' . $fileName;
                }

                SocialLink::create([
                    'name' => $request->input('name'),
                    'icon' => $iconPath,
                    'url' => $request->input('url'),
                    'username' => $request->input('username'),
                    'color' => $request->input('color'),
                    'active' => $request->boolean('active'),
                    'order' => $request->integer('order'),
                ]);

            });

            return redirect()
                ->back()
                ->with('success', 'Social link created successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to create social link.', [
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
                    'social_link' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to create the social link.',
                ]);
        }
    }

    public function update(SocialLinkRequest $request, SocialLink $socialLink)
    {
        try {

            DB::transaction(function () use ($request, $socialLink) {

                $iconPath = $socialLink->icon;

                // -------------------------------------------------
                // Remove current icon
                // -------------------------------------------------

                if ($request->boolean('remove_icon')) {

                    if (
                        $socialLink->icon &&
                        file_exists(public_path($socialLink->icon))
                    ) {
                        unlink(public_path($socialLink->icon));
                    }

                    $iconPath = null;
                }

                // -------------------------------------------------
                // Upload new icon
                // -------------------------------------------------

                if ($request->hasFile('icon')) {

                    // Delete old icon first
                    if (
                        $socialLink->icon &&
                        file_exists(public_path($socialLink->icon))
                    ) {
                        unlink(public_path($socialLink->icon));
                    }

                    $file = $request->file('icon');

                    $destination = public_path('svg');

                    if (! file_exists($destination)) {
                        mkdir($destination, 0755, true);
                    }

                    $fileName = Str::uuid() . '.svg';

                    $file->move($destination, $fileName);

                    $iconPath = 'svg/' . $fileName;
                }

                $socialLink->update([
                    'name' => $request->input('name'),
                    'icon' => $iconPath,
                    'url' => $request->input('url'),
                    'username' => $request->input('username'),
                    'color' => $request->input('color'),
                    'active' => $request->boolean('active'),
                    'order' => $request->integer('order'),
                ]);

            });

            return redirect()
                ->back()
                ->with('success', 'Social link updated successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to update social link.', [
                'user_id' => $request->user()?->id,
                'social_link_id' => $socialLink->id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'social_link' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to update the social link.',
                ]);
        }
    }

    public function destroy(SocialLink $socialLink)
    {
        try {

            DB::transaction(function () use ($socialLink) {

                // -------------------------------------------------
                // Delete icon
                // -------------------------------------------------

                if (
                    $socialLink->icon &&
                    file_exists(public_path($socialLink->icon))
                ) {
                    unlink(public_path($socialLink->icon));
                }

                // -------------------------------------------------
                // Delete social link
                // -------------------------------------------------

                $socialLink->delete();

            });

            return redirect()
                ->back()
                ->with('success', 'Social link deleted successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to delete social link.', [
                'user_id' => auth()->id(),
                'social_link_id' => $socialLink->id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withErrors([
                    'social_link' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to delete the social link.',
                ]);
        }
    }
}
