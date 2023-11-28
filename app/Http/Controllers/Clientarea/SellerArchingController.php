<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clientarea\SellerArchingRequest;
use App\Models\Arching;
use Illuminate\Http\Request;

class SellerArchingController extends Controller
{
    public function store(SellerArchingRequest $request, $seller)
    {
        Arching::create($request->validated() + [
            'user_id' => auth()->id(),
            'seller_id' => $seller,
            'current_balance' => 0
        ]);

        return back();
    }

    public function destroy($seller, $arching)
    {
        Arching::where('id', $arching)->delete();

        return back();
    }
}
