<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\IntervalRequest;
use App\Http\Requests\API\SellerRequest;
use App\Http\Resources\SellerResource;
use App\Http\Resources\TransactionResource;
use App\Models\User;
use App\Services\UserService;

class SellerController extends Controller
{
    public function __construct(
        private readonly UserService $service
    ) {
    }

    public function index()
    {
        return SellerResource::collection(auth()->user()->sellers);
    }

    public function store(SellerRequest $request)
    {
        $this->service->createSeller($request->validated());

        return self::index();
    }

    public function show(IntervalRequest $request, $seller)
    {
        return TransactionResource::collection(
            $this->service->getTransactions($seller, $request->validated())
        );
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
