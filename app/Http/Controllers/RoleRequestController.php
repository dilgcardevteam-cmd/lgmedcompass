<?php

namespace App\Http\Controllers;

use App\Models\RoleRequest;

class RoleRequestController extends Controller
{
    public function store()
    {
        // prevent duplicate pending request
        $existing = RoleRequest::where('user_id', auth()->id())
            ->where('status', 'Pending')
            ->exists();

        if (! $existing) {
            RoleRequest::create([
                'user_id' => auth()->id(),
                'status' => 'Pending',
            ]);
        }

        return back()->with('status', 'Request sent to Admin.');
    }

    public function approve(RoleRequest $roleRequest)
    {
        $roleRequest->user->update([
            'role' => 'Employee',
        ]);

        $roleRequest->update([
            'status' => 'Approved',
        ]);

        return back()->with('status', 'User promoted to Employee.');
    }

    public function decline(RoleRequest $roleRequest)
    {
        $roleRequest->update([
            'status' => 'Declined',
        ]);

        return back()->with('status', 'Request declined.');
    }
}
