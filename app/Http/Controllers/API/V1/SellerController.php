<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SellerResource;
use App\Http\Requests\API\SellerRequest;
use App\Models\User;
use App\Services\UserService;

class SellerController extends Controller
{
    public function index()
    {
        return SellerResource::collection(auth()->user()->sellers);
    }

    public function store(SellerRequest $request)
    {
        (new UserService)->createSeller($request->validated());

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
