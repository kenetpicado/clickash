<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ArchingRequest;
use App\Http\Resources\ArchingResource;
use App\Models\Arching;
use App\Repositories\ArchingRepository;
use Illuminate\Http\Request;

class ArchingController extends Controller
{
    public function __construct(
        private readonly ArchingRepository $archingRepository
    ) {
    }

    public function index(Request $request)
    {
        return ArchingResource::collection($this->archingRepository->getAll($request->all()))
            ->additional([
                'total' => $this->archingRepository->getTotal($request->all()),
            ]);
    }

    public function store(ArchingRequest $request)
    {
        Arching::create($request->validated() + [
            'user_id' => auth()->id(),
            'current_balance' => 0,
        ]);

        return self::index(Request::create('', 'GET', [
            'seller_id' => $request->seller_id,
        ]));
    }

    public function destroy($arching)
    {
        Arching::where('id', $arching)->delete();

        return response()->noContent();
    }
}
