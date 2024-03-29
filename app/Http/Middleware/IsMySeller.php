<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
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
        if (isset($request->seller) && auth()->user()->isOwner()) {
            $id = $request->seller instanceof User ? $request->seller->id : $request->seller;
            if (User::where('id', $id)->value('user_id') !== auth()->id()) {
                abort(403, 'Unauthorized');
            }
        }

        return $next($request);
    }
}
