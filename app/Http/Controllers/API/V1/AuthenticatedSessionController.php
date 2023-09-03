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

        return response()->json([
            'message' => 'Login success',
            'auth_token' => $user->createToken('authToken')->plainTextToken,
        ]);
    }

    public function destroy(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => "Logout success",
        ]);
    }
}
