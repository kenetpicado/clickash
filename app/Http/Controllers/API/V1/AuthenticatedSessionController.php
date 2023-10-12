<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\AuthenticatedUserResource;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthenticatedSessionController extends Controller
{
    public function store(LoginRequest $request)
    {
        $request->ensureIsNotRateLimited();

        $user = (new AuthService)->setRequest($request)->login();

        return AuthenticatedUserResource::make($user);
    }

    public function destroy(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión cerrada',
        ]);
    }
}
