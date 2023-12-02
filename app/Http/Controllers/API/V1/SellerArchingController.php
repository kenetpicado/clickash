<?php

namespace App\Http\Controllers\API\V1;

use Carbon\Carbon;
use App\Models\Arching;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArchingResource;
use App\Repositories\ArchingRepository;
use App\Http\Requests\API\ArchingRequest;
use App\Repositories\TransactionRepository;

class SellerArchingController extends Controller
{
    public function __construct(
        private readonly ArchingRepository $archingRepository,
        private readonly TransactionRepository $transactionRepository,
    ) {
    }

    public function index(Request $request, $seller)
    {
        $ownerId = null;

        if (auth()->user()->isSeller()) {
            $seller = auth()->id();
            $ownerId = auth()->user()->user_id;
        }

        $cashbox = $this->transactionRepository->getCashboxByUser($seller, $request->all());

        $resume = $this->archingRepository->getTotalArchingsBySeller($seller, $request->all(), $ownerId);

        $cashbox->renevue = ($cashbox->income - $cashbox->expenditure) + $resume->deposit - $resume->withdrawal;

        $message = $request->has('date')
            ? 'Caja del DIA ' . Carbon::parse($request->get('date'))->format('d/m/Y')
            : 'Caja de la SEMANA en curso';

        return ArchingResource::collection($this->archingRepository->getArchingsBySeller($seller, $request->all(), $ownerId))
            ->additional([
                'income' => "C$ " . number_format($cashbox->income),
                'expenditure' => "C$ " . number_format($cashbox->expenditure),
                'balance' => "C$ " . number_format($cashbox->renevue),
                'type' => $cashbox->revenue >= 0 ? 'Ganancia' : 'Pérdida',
                'message' => $message,
            ]);
    }

    public function store(ArchingRequest $request, $seller)
    {
        Arching::create($request->validated() + [
            'user_id' => auth()->id(),
            'current_balance' => 0,
            'seller_id' => $seller,
        ]);

        return self::index(Request::create('', 'GET', []), $seller);
    }

    public function destroy($seller, $arching)
    {
        Arching::where('id', $arching)->delete();

        return self::index(Request::create('', 'GET', []), $seller);
    }
}
