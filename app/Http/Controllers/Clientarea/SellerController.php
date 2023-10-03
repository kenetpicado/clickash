<?php

namespace App\Http\Controllers\Clientarea;

use App\Enums\UserStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Clientarea\SellerRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    public function index()
    {
        return inertia('Clientarea/Seller/Index', [
            "sellers" => User::query()
                ->where('user_id', auth()->id())
                ->get(['id', 'name', 'email', 'last_login', 'status']),
        ]);
    }

    public function store(SellerRequest $request)
    {
        if (auth()->user()->sellers()->count() >= auth()->user()->sellers_limit) {
            return back()->withErrors([
                'message' => 'Ha alcanzado el límite de vendedores permitidos'
            ]);
        }

        User::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            "company_name" => auth()->user()->company_name,
            "role" => "seller",
            "status" => "enabled"
        ]);

        return back();
    }

    public function show(User $seller)
    {
        $transactions = $seller->transactions()
            ->with('raffle:id,name')
            ->latest('id')
            ->paginate();

        return inertia('Clientarea/Seller/Show', [
            "seller" => $seller,
            'transactions' => $transactions,
        ]);
    }

    public function update(SellerRequest $request, $seller)
    {
        User::where('id', $seller)->update($request->validated());

        return back();
    }

    public function destroy($seller)
    {
        User::where('id', $seller)->delete();

        return back();
    }
}
