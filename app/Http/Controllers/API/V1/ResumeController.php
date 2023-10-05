<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\IntervalRequest;
use App\Http\Resources\TransactionResource;
use App\Services\TransactionService;

class ResumeController extends Controller
{
    public function __invoke(IntervalRequest $request)
    {
        return TransactionResource::collection(
            (new TransactionService)->getInterval($request->validated())
        );
    }
}
