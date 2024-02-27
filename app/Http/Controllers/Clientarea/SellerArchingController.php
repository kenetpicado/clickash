<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clientarea\SellerArchingRequest;
use App\Http\Resources\ArchingResource;
use App\Http\Resources\WeeklyTransactionResource;
use App\Models\Arching;
use App\Models\User;
use App\Services\ArchingService;
use App\Services\TransactionService;

class SellerArchingController extends Controller
{
    public function __construct(
        private readonly TransactionService $transactionService,
        private readonly ArchingService $archingService
    ) {
    }

    public function index(User $seller)
    {
        return inertia('Clientarea/Seller/Arching/Index', [
            'seller' => $seller,
            'weeks_resume' => WeeklyTransactionResource::collection($this->transactionService->getTransactionResumePerWeek($seller->id)),
        ]);
    }

    public function show(User $seller, $week)
    {
        return inertia('Clientarea/Seller/Arching/Show', [
            'seller' => $seller,
            'week' => $week,
            'movements' => ArchingResource::collection($this->archingService->getArchingsOfWeek($week, $seller->id)),
            'week_resume' => WeeklyTransactionResource::make($this->transactionService->getWeekTransactionResume($seller->id, $week))
        ]);
    }

    public function store(SellerArchingRequest $request, $seller)
    {
        $this->archingService->store($request->validated());

        return back();
    }

    public function destroy($seller, Arching $arching)
    {
        $arching->delete();

        return back();
    }
}
