<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class IsMySeller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->seller && auth()->user()->isOwner()) {
            if (DB::table('users')->where('id', $request->seller)->where('user_id', auth()->id())->doesntExist()) {
                abort(403, 'Unauthorized');
            }
        }

        return $next($request);
    }
}
