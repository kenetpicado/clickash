<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\RegisterRequest;
use App\Http\Resources\AuthenticatedUserResource;
use App\Services\UserService;

class RegisterController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    ) {
    }

    public function __invoke(RegisterRequest $request)
    {
        $user = $this->userService->registerFreeAccount($request->validated());

        return AuthenticatedUserResource::make($user);
    }
}
