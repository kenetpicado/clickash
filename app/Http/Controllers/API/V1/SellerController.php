<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\SellerRequest;
use App\Http\Resources\SellerResource;
use App\Http\Resources\TransactionResource;
use App\Models\User;
use App\Repositories\TransactionRepository;
use App\Services\UserService;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
        private readonly TransactionRepository $transactionRepository
    ) {
    }

    public function index()
    {
        return SellerResource::collection($this->userService->getSellers());
    }

    public function store(SellerRequest $request)
    {
        $this->userService->createSeller($request->validated());

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
