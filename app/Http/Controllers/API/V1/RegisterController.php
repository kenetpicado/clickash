<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\RegisterRequest;
use App\Services\UserService;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        $user = (new UserService)->registerFreeAccount($request->validated());

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User registered successfully',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
