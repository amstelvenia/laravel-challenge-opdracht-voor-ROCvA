<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized: Not logged in.');
        }

        $user = Auth::user();

        // Check if user has the role using Spatie
        if (!$user->hasRole($role)) {
            abort(403, 'Unauthorized: You do not have the required role.');
        }

        return $next($request);
    }
}

/* namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            Log::warning('Unauthorized access attempt: user not authenticated.');
            abort(403, 'Unauthorized.');
        }

        $userRole = Auth::user()->role;
        Log::info('User Role:', ['role' => $userRole]);

        if ($userRole !== $role) {
            Log::warning('Unauthorized access attempt by user with role: ' . $userRole);
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
} */