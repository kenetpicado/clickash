<?php

namespace App\Http\Controllers\Clientarea;

use App\Models\User;
use App\Http\Controllers\Controller;
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

        return back();
    }
}
