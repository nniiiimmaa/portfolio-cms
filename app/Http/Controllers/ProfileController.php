<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/ProfileEdit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        try {

            $user = $request->user();

            $photoPath = $user->photo;

            // -------------------------------------------------
            // Remove current photo
            // -------------------------------------------------

            if ($request->boolean('remove_photo')) {

                if (
                    $user->photo &&
                    file_exists(public_path($user->photo))
                ) {
                    unlink(public_path($user->photo));
                }

                $photoPath = null;
            }


            // -------------------------------------------------
            // Upload new photo
            // -------------------------------------------------

            if ($request->hasFile('photo')) {

                // Delete old photo only when replacing it
                if (
                    $user->photo &&
                    file_exists(public_path($user->photo))
                ) {
                    unlink(public_path($user->photo));
                }

                $file = $request->file('photo');

                $destination = public_path('images/profile');

                if (! file_exists($destination)) {
                    mkdir($destination, 0755, true);
                }

                $extension = $file->getClientOriginalExtension();

                $fileName = Str::uuid() . '.' . $extension;

                $file->move($destination, $fileName);

                $photoPath = 'images/profile/' . $fileName;
            }


            // -------------------------------------------------
            // Update user
            // -------------------------------------------------

            $user->fill([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'photo' => $photoPath,
            ]);

            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }

            $user->save();


            return Redirect::route('profile.edit')
                ->with('success', 'Profile updated successfully.');

        } catch (Throwable $e) {

            report($e);

            Log::error('Failed to update profile.', [
                'user_id' => $request->user()?->id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return Redirect::back()
                ->withInput()
                ->withErrors([
                    'profile' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to update the profile.',
                ]);
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        try {

            $user = $request->user();

            // -------------------------------------------------
            // Delete profile photo
            // -------------------------------------------------

            if (
                $user->photo &&
                file_exists(public_path($user->photo))
            ) {
                unlink(public_path($user->photo));
            }


            Auth::logout();

            $user->delete();

            $request->session()->invalidate();
            $request->session()->regenerateToken();


            return Redirect::to('/welcome')
                ->with('success', 'Account deleted successfully.');

        } catch (Throwable $e) {

            Log::error('Failed to delete account.', [
                'user_id' => $request->user()?->id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return Redirect::back()
                ->withErrors([
                    'account' => config('app.debug')
                        ? $e->getMessage()
                        : 'Failed to delete the account.',
                ]);
        }
    }
}
