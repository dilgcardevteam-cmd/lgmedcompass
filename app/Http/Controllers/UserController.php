<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('section')->get();

        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $sections = Section::all();

        return view('users.edit', compact('user', 'sections'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'section_id' => 'nullable|exists:sections,id',
        ]);

        $user->update([
            'username' => $request->name,
            'section_id' => $request->section_id,
        ]);

        return back()->with('status', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('status', 'User deleted successfully.');
    }
}
