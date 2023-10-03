<?php

namespace App\Http\Controllers\API\V1;

use App\Enums\UserStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\User;

class ToggleStatusController extends Controller
{
    public function __invoke(User $seller)
    {
        $seller->update([
            'status' => $seller->status === UserStatusEnum::ENABLED->value ? UserStatusEnum::DISABLED->value : UserStatusEnum::ENABLED->value,
        ]);

        return response()->noContent();
    }
}
