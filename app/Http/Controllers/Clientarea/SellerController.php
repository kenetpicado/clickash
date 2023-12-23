<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clientarea\SellerRequest;
use App\Models\User;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly TransactionRepository $transactionRepository
    ) {
    }

    public function index()
    {
        return inertia('Clientarea/Seller/Index', [
            'sellers' => $this->userRepository->getSellers(),
        ]);
    }

    public function store(SellerRequest $request)
    {
        if ($this->userRepository->hasReachedSellerLimit()) {
            return back()->withErrors(['message' => 'Ha alcanzado el límite de vendedores permitidos']);
        }

        $this->userRepository->createSeller($request->validated());

        return back();
    }

    public function show(Request $request, User $seller)
    {
        return inertia('Clientarea/Seller/Show', [
            'seller' => $seller,
            'transactions' => $this->transactionRepository->getByUserOfTheDay($seller, $request->all()),
            'daily_transactions' => $this->transactionRepository->getTotalByUserOfTheDay($seller, $request->all()),
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
