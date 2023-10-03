<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $rolesString): Response
    {
        $roles = explode('|', $rolesString);

        if (! in_array(auth()->user()->role, $roles)) {
            abort(403, "You don't have permission to access this page");
        }

        return $next($request);
    }
}
