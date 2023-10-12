<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;

class ToggleStatusController extends Controller
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {
    }

    public function __invoke(User $seller)
    {
        $this->userRepository->toggleStatus($seller);

        return response()->noContent();
    }
}
