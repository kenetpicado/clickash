<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\SellerRequest;
use App\Http\Resources\SellerResource;
use App\Models\User;
use App\Services\UserService;

class SellerController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
    ) {
    }

    public function index()
    {
        return SellerResource::collection($this->userService->getSellers());
    }

    public function store(SellerRequest $request)
    {
        try {
            $this->userService->createSeller($request->validated());
        } catch (\Exception $e) {
            abort($e->getCode(), $e->getMessage());
        }

        return self::index();
    }

    public function update(SellerRequest $request, User $seller)
    {
        $seller->update($request->validated());

        return self::index();
    }

    public function destroy(User $seller)
    {
        $seller->delete();

        return self::index();
    }
}
