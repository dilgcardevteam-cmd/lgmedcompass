<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    public function checkStatus()
    {
        $user = Auth::user();

        return response()->json([
            'approved' => $user->is_approved, // make sure your users table has this column
        ]);
    }
}
