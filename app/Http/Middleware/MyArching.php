<?php

namespace App\Http\Middleware;

use App\Models\Arching;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MyArching
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (isset($request->arching) && auth()->user()->isOwner()) {
            $id = $request->arching instanceof Arching ? $request->arching->id : $request->arching;
            if (Arching::where('id', $id)->value('user_id') !== auth()->id()) {
                abort(403, 'Unauthorized');
            }
        }

        return $next($request);
    }
}
