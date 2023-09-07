<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SellerResource;
use App\Http\Requests\API\SellerRequest;
use App\Enums\RoleEnum;
use App\Models\User;

class SellerController extends Controller
{
    public function index()
    {
        return SellerResource::collection(auth()->user()->sellers);
    }

    public function store(SellerRequest $request)
    {
        if (auth()->user()->seller_limit >= auth()->user()->sellers()->count())
            abort(403, 'You have reached the maximum number of sellers');

        User::create($request->validated() + [
            'role' => RoleEnum::SELLER->value,
        ]);

        return response()->json([
            'message' => 'Seller created successfully',
        ]);
    }

    public function update(SellerRequest $request, User $seller)
    {
        $seller->update($request->validated());

        return response()->json([
            'message' => 'Seller updated successfully',
        ]);
    }

    public function destroy(User $seller)
    {
        $seller->delete();

        return response()->json([
            'message' => 'Seller deleted successfully',
        ]);
    }
}
