<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\RegisterRequest;
use App\Http\Resources\AuthenticatedUserResource;
use App\Repositories\UserRepository;

class RegisterController extends Controller
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {
    }

    public function __invoke(RegisterRequest $request)
    {
        $user = $this->userRepository->registerFreeAccount($request->validated());

        return AuthenticatedUserResource::make($user);
    }
}
