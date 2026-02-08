<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        if ($user->role) {
            foreach ($roles as $role) {
                if (strtolower($user->role->name) === strtolower(trim($role))) {
                    return $next($request);
                }
            }
        }

        // Redirect based on actual role if they try to access wrong area?
        // Or just 403. 403 is standard.
        abort(403, 'Unauthorized access.');
    }
}
