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
        abort(403, 'Unauthorized');
    }

    if ($role === 'admin' && $user->role_id != 1) {
        abort(403, 'Unauthorized Action');
    }

    if ($role === 'member' && $user->role_id != 2) {
        abort(403, 'Unauthorized Action');
    }

    return $next($request);
}
}
