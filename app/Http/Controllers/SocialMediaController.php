<?php

namespace App\Http\Controllers;

use App\Http\Requests\SocialLinkRequest;
use App\Models\SocialLink;
use Illuminate\Http\Request;
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

                SocialLink::create([
                    'name' => $request->name,
                    'icon' => $request->icon,
                    'url' => $request->url,
                    'username' => $request->username,
                    'color' => $request->color,
                    'active' => $request->boolean('active'),
                    'order' => $request->order,
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

                $socialLink->update([
                    'name' => $request->name,
                    'icon' => $request->icon,
                    'url' => $request->url,
                    'username' => $request->username,
                    'color' => $request->color,
                    'active' => $request->boolean('active'),
                    'order' => $request->order,
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
