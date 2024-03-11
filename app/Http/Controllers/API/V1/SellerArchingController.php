<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ArchingRequest;
use App\Http\Resources\ArchingResource;
use App\Models\Arching;
use App\Repositories\ArchingRepository;
use App\Repositories\TransactionRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

        $cashbox->revenue = ($cashbox->income - $cashbox->expenditure) + $resume->deposit - $resume->withdrawal;

        $message = $request->has('date')
            ? 'Caja del DIA '.Carbon::parse($request->get('date'))->format('d/m/Y')
            : 'Caja de la SEMANA en curso';

        return ArchingResource::collection($this->archingRepository->getArchingsBySeller($seller, $request->all(), $ownerId))
            ->additional([
                'income' => 'C$ '.number_format($cashbox->income),
                'expenditure' => 'C$ '.number_format($cashbox->expenditure),
                'balance' => 'C$ '.number_format($cashbox->revenue),
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

    public function destroy($seller, Arching $arching)
    {
        $arching->delete();

        return self::index(Request::create('', 'GET', []), $seller); // TODO: RETORNAR NADA
    }
}
