<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\SellerRequest;
use App\Http\Resources\SellerResource;
use App\Http\Resources\TransactionResource;
use App\Models\User;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;

class SellerController extends Controller
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly TransactionRepository $transactionRepository
    ) {
    }

    public function index()
    {
        return SellerResource::collection($this->userRepository->getSellers());
    }

    public function store(SellerRequest $request)
    {
        if ($this->userRepository->hasReachedSellerLimit()) {
            abort(403, 'Ha alcanzado el límite de vendedores permitidos');
        }

        $this->userRepository->createSeller($request->validated());

        return self::index();
    }

    public function show(User $seller)
    {
        return TransactionResource::collection($this->transactionRepository->getByUser($seller));
    }

    public function update(SellerRequest $request, $seller)
    {
        User::where('id', $seller)->update($request->validated());

        return self::index();
    }

    public function destroy($seller)
    {
        User::where('id', $seller)->delete();

        return self::index();
    }
}
