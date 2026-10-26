<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Section;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
            'sections' => Section::all(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validated = $request->validated();

        // Update only fields that were provided
        if (array_key_exists('username', $validated)) {
            $user->username = $validated['username'];
        }
        if (array_key_exists('first_name', $validated)) {
            $user->first_name = $validated['first_name'];
        }
        if (array_key_exists('last_name', $validated)) {
            $user->last_name = $validated['last_name'];
        }
        if (array_key_exists('birthdate', $validated)) {
            $user->birthdate = $validated['birthdate'] ?? $user->birthdate;
        }
        if (array_key_exists('position', $validated)) {
            $user->position = $validated['position'] ?? $user->position;
        }

        // Handle email separately (only if provided and changed)
        if (array_key_exists('email', $validated) && $user->email !== $validated['email']) {
            $user->email = $validated['email'];
            $user->email_verified_at = null;
            event(new Registered($user));
        }

        $user->save();

        return back()->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
