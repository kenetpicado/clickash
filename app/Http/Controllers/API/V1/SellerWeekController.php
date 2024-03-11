<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clientarea\SellerArchingRequest;
use App\Http\Resources\ArchingResource;
use App\Http\Resources\WeeklyTransactionResource;
use App\Services\ArchingService;
use App\Services\TransactionService;

class SellerWeekController extends Controller
{
    public function __construct(
        private readonly TransactionService $transactionService,
        private readonly ArchingService     $archingService
    )
    {
    }

    public function index($seller)
    {
        return WeeklyTransactionResource::collection($this->transactionService->getTransactionResumePerWeek($seller));
    }

    public function show($seller, $week)
    {
        return WeeklyTransactionResource::make($this->transactionService->getWeekTransactionResume($seller, $week))
            ->additional([
                'movements' => ArchingResource::collection($this->archingService->getArchingsOfWeek($seller, $week))
            ]);
    }

    public function store(SellerArchingRequest $request, $seller)
    {
        $this->archingService->store($request->validated());

        return response()->noContent();
    }
}
