<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthenticatedSessionController extends Controller
{
    public function store(LoginRequest $request)
    {
        $request->ensureIsNotRateLimited();

        $user = (new AuthService)->setRequest($request)->login();

        $firstName = explode(' ', $user->name)[0];

        return response()->json([
            'message' => "Bienvenido {$firstName}",
            'auth_token' => $user->createToken('authToken')->plainTextToken,
            "name" => $user->name,
            "email" => $user->email,
            "company_name" => $user->company_name,
            "sellers_limit" => $user->sellers_limit,
            "role" => $user->role,
            "status" => $user->status,
        ]);
    }

    public function destroy(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión cerrada',
        ]);
    }
}
