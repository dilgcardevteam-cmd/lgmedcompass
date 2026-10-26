<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRoleRequest;
use App\Models\Section;
use App\Models\User;
use App\Notifications\AccountApproved;
use App\Notifications\AccountDeclined;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AccountManagementController extends Controller
{
    /**
     * Display the account management page.
     */
    public function index(Request $request)
    {
        $this->authorizeAccess('view');

        $nameFilter = $request->input('name');
        $sectionFilter = $request->input('section', []);
        $roleFilter = $request->input('role', []);

        if (! is_array($sectionFilter)) {
            $sectionFilter = [$sectionFilter];
        }

        if (! is_array($roleFilter)) {
            $roleFilter = [$roleFilter];
        }

        $users = User::with('section')
            ->where('role', '!=', 'Pending')
            ->when($nameFilter, function ($query) use ($nameFilter) {
                $query->where(function ($q) use ($nameFilter) {
                    $q->where('first_name', 'like', "%{$nameFilter}%")
                        ->orWhere('last_name', 'like', "%{$nameFilter}%")
                        ->orWhere('username', 'like', "%{$nameFilter}%");
                });
            })
            ->when(! empty($sectionFilter), function ($query) use ($sectionFilter) {
                $query->whereIn('section_id', $sectionFilter);
            })
            ->when(! empty($roleFilter), function ($query) use ($roleFilter) {
                $query->whereIn('role', $roleFilter);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        $sections = Section::all();

        $roles = User::whereNotNull('role')
            ->where('role', '!=', 'Pending')
            ->distinct()
            ->pluck('role');

        $selectedSectionNames = Section::whereIn('id', $sectionFilter ?? [])
            ->pluck('name')
            ->toArray();

        $pendingUsers = User::with('section')
            ->where('role', 'Pending')
            ->whereNotNull('email_verified_at')
            ->latest()
            ->get();

        return view('account-management.index', compact(
            'users',
            'sections',
            'roles',
            'nameFilter',
            'sectionFilter',
            'roleFilter',
            'selectedSectionNames',
            'pendingUsers'
        ));
    }

    /**
     * Update a user's role.
     *
     * ✅ Toast ready: JSON returns 'message', redirect uses 'status' flash.
     */
    public function updateRole(UpdateUserRoleRequest $request, User $user): RedirectResponse|JsonResponse
    {
        $this->authorizeAccess('write');

        $validated = $request->validated();
        $newRole = $validated['role'];
        $confirmTransfer = $request->boolean('confirm_admin_transfer');

        // Prevent changing own role
        if (auth()->id() === $user->id) {
            $message = 'You cannot change your own role.';
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => $message], 403);
            }

            return back()->with('error', $message);
        }

        $currentAdminCount = User::where('role', 'Admin')->count();
        $isTargetCurrentlyAdmin = $user->role === 'Admin';
        $isNewRoleAdmin = $newRole === 'Admin';

        // Promoting a non‑admin to Admin while admins exist → transfer confirmation required
        if ($isNewRoleAdmin && ! $isTargetCurrentlyAdmin && $currentAdminCount >= 1) {
            if (! $confirmTransfer) {
                $message = 'Please confirm that you want to transfer the Administrative role to this user.';
                if ($request->expectsJson()) {
                    return response()->json(['success' => false, 'message' => $message], 409);
                }

                return back()->withErrors(['role' => $message]);
            }

            // Confirmed: demote all current admins to Employee
            User::where('role', 'Admin')->update(['role' => 'Employee']);
        }

        // Prevent demoting the last admin
        if (! $isNewRoleAdmin && $isTargetCurrentlyAdmin && $currentAdminCount <= 1) {
            $message = 'You cannot remove the only remaining admin.';
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => $message], 422);
            }

            return back()->withErrors(['role' => $message]);
        }

        $user->update(['role' => $newRole]);

        $message = 'User role updated successfully.';
        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => $message]);
        }

        return back()->with('status', $message);
    }

    /**
     * Approve a pending user.
     *
     * ✅ Toast ready: uses 'status' flash.
     */
    public function approve(User $user)
    {
        $this->authorizeAccess('write');

        if ($user->role !== 'Pending') {
            return back()->withErrors(['account' => 'User is not pending approval.']);
        }

        // Update role to Employee (or whatever your active role is)
        $user->update(['role' => 'Employee']);

        // ✅ Send approval notification (instead of Mailable)
        $user->notify(new AccountApproved);

        return back()->with('status', 'User approved successfully.');
    }

    /**
     * Decline and delete a pending user.
     *
     * ✅ Toast ready: uses 'status' flash.
     */
    public function decline(User $user)
    {
        $this->authorizeAccess('write');

        if ($user->role !== 'Pending') {
            return back()->withErrors(['account' => 'User is not pending approval.']);
        }

        // ✅ Send decline notification (instead of Mailable)
        $user->notify(new AccountDeclined);

        // 🧹 Permanently remove the user
        $user->forceDelete();

        return back()->with('status', 'User request declined and permanently removed.');
    }

    /**
     * Update a user's section.
     *
     * ✅ Toast ready: JSON returns 'message', redirect uses 'status' flash.
     */
    public function updateSection(Request $request, User $user)
    {
        $this->authorizeAccess('write');

        $request->validate([
            'section_id' => 'nullable|exists:sections,id',
        ]);

        $newSectionId = $request->section_id;

        // Sections 1 and 2 are exclusive – only one user allowed
        if (in_array($newSectionId, [1, 2])) {
            $existingUser = User::where('section_id', $newSectionId)
                ->where('id', '!=', $user->id)
                ->first();
            if ($existingUser) {
                $message = 'Section already has a user assigned. Only one user can be in this section.';
                if ($request->expectsJson()) {
                    return response()->json(['success' => false, 'message' => $message], 422);
                }

                return back()->withErrors(['section_id' => $message]);
            }
        }

        $user->update(['section_id' => $newSectionId]);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Section updated successfully.']);
        }

        return back()->with('status', 'Section updated successfully.');
    }

    /**
     * Restore a soft‑deleted user.
     *
     * ✅ Toast ready: uses 'status' flash.
     */
    public function restore($id): RedirectResponse
    {
        $this->authorizeAccess('write');

        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return back()->with('status', 'User restored successfully.');
    }

    /**
     * Soft delete a user.
     *
     * ✅ Toast ready: uses 'status' flash.
     */
    public function destroy(User $user): RedirectResponse
    {
        $this->authorizeAccess('write');

        if ((int) $user->id === (int) auth()->id()) {
            return back()->withErrors([
                'account' => 'You cannot delete your own account.',
            ]);
        }

        // Permanently remove the user
        $user->forceDelete();

        return back()->with('status', 'User permanently deleted.');
    }

    /**
     * Prevent removal of the last admin.
     */
    protected function cannotUpdateLastAdminRole(User $user, string $newRole): bool
    {
        if ($user->role !== 'Admin') {
            return false;
        }
        if ($newRole === 'Admin') {
            return false;
        }

        return User::where('role', 'Admin')->count() <= 1;
    }

    /**
     * Simple role‑based authorization.
     */
    protected function authorizeAccess(string $type): void
    {
        $user = auth()->user();

        if (! $user) {
            abort(403);
        }

        if ($type === 'view') {
            $allowed = in_array($user->role, ['Admin', 'Technical Inspector']);
        } else { // write
            $allowed = $user->role === 'Admin';
        }

        if (! $allowed) {
            abort(403, 'Unauthorized action.');
        }
    }
}
