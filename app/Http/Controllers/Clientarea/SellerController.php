<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clientarea\SellerRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly TransactionService $transactionService
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
        $data = $this->transactionService->getInvoices($request->all(), $seller->id);

        return inertia('Clientarea/Seller/Show', [
            'seller' => $seller,
            'invoices' => $data['invoices'],
            'total' => $data['total'],
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
