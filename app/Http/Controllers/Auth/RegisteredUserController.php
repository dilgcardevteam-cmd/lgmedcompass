<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\User;
use App\Rules\StrongPassword;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // Get section IDs 1 and 2 that already have users assigned
        $takenRestrictedSectionIds = User::whereIn('section_id', [1, 2])
            ->pluck('section_id')
            ->toArray();

        // Get all sections, but filter out restricted sections (1 and 2) if they're taken
        $sections = Section::when(! empty($takenRestrictedSectionIds), function ($query) use ($takenRestrictedSectionIds) {
            return $query->whereNotIn('id', $takenRestrictedSectionIds);
        })
            ->get();

        return view('auth.register', compact('sections'));
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->merge([
            'email' => strtolower($request->email),
        ]);

        $request->validate([

            'first_name' => ['required', 'string', 'min:2', 'regex:/^[A-Za-z]+(?:\s[A-Za-z]+)*$/'],
            'last_name' => ['required', 'string', 'min:2', 'regex:/^[A-Za-z]+(?:\s[A-Za-z]+)*$/'],
            'nickname' => ['nullable', 'string', 'max:255'],
            'position' => ['required', 'string', 'min:2', 'regex:/^[A-Za-z0-9\s().#-]+$/'],
            'username' => ['required', 'string', 'max:255', 'alpha_dash', 'unique:users,username'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->whereNull('deleted_at'),
            ],
            'password' => ['required', 'confirmed', new StrongPassword],
            'section_id' => ['required', 'exists:sections,id'],
        ], [
            'first_name.required' => 'First name is required.',
            'first_name.regex' => 'First name may only contain letters.',
            'last_name.required' => 'Last name is required.',
            'last_name.regex' => 'Last name may only contain letters.',
            'position.required' => 'Position is required.',
            'position.regex' => 'Position may only contain letters and spaces.',
            'username.required' => 'Username is required.',
            'username.unique' => 'This username is already taken.',
            'email.required' => 'Email address is required.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'Password is required.',
            'section_id.required' => 'Please select a section.',
        ]);

        // Additional check: If section_id is 1 or 2, ensure it's not already taken
        if (in_array($request->section_id, [1, 2])) {
            $sectionExists = User::where('section_id', $request->section_id)->exists();
            if ($sectionExists) {
                return back()->withErrors([
                    'section_id' => 'This section has already been assigned to another user and cannot be selected.',
                ])->withInput();
            }
        }

        $isFirstUser = ! User::query()->exists();

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'nickname' => $request->nickname,
            'position' => $request->position,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'section_id' => $request->section_id,
            'role' => $isFirstUser ? 'Admin' : 'Pending',
            'email_verified_at' => $isFirstUser ? now() : null,
        ]);

        event(new Registered($user));

        // Set session flag to reset calendar toasts on next page load
        session()->flash('reset_calendar_toasts', true);

        Auth::login($user);

        return redirect()->route('verification.notice');
    }
}
