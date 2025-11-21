<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Check role_id: admin = 1, member = 2
        if ($role === 'admin' && $user->role_id != 1) {
            abort(403, 'Unauthorized Action - Admin access only');
        }

        if ($role === 'member' && $user->role_id != 2) {
            abort(403, 'Unauthorized Action - Member access only');
        }

        return $next($request);
    }
}
