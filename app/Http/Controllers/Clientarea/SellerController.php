<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clientarea\SellerRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\User;
use App\Services\TransactionService;
use App\Services\UserService;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function __construct(
        private readonly TransactionService $transactionService,
        private readonly UserService $userService
    ) {
    }

    public function index()
    {
        return inertia('Clientarea/Seller/Index', [
            'sellers' => $this->userService->getSellers(),
        ]);
    }

    public function store(SellerRequest $request)
    {
        try {
            $this->userService->createSeller($request->validated());
        } catch (\Exception $e) {
            return back()->withErrors(['message' => $e->getMessage()]);
        }

        return back();
    }

    public function show(Request $request, User $seller)
    {
        $data = $this->transactionService->getInvoices($request->all(), $seller->id);

        return inertia('Clientarea/Seller/Show', [
            'seller' => $seller,
            'invoices' => InvoiceResource::collection($data['invoices']),
            'total' => $data['total'],
        ]);
    }

    public function update(SellerRequest $request, User $seller)
    {
        $seller->update($request->validated());

        return back();
    }

    public function destroy(User $seller)
    {
        $seller->delete();

        return back();
    }
}
