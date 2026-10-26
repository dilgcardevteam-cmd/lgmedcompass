<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DenyWriteAccessForTechInspector
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if ($user && $user->role === 'Technical Inspector') {
            // Block write methods
            if (in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'])) {
                $message = 'Technical Inspector has read‑only access. You cannot perform this action.';

                // For AJAX / Fetch / Axios requests
                if ($request->expectsJson() || $request->ajax()) {
                    return response()->json(['error' => $message], 403);
                }

                // For normal form submissions or page reloads
                return redirect()->back()->with('error', $message);
            }
        }

        return $next($request);
    }
}
