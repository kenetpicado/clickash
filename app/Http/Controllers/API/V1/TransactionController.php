<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\TransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Availability;
use App\Models\BlockedNumber;
use App\Models\RaffleUser;
use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use App\Services\TransactionService;
use App\Services\UserService;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function __construct(
        private readonly TransactionRepository $transactionRepository
    ) {
    }

    public function index()
    {
        return TransactionResource::collection($this->transactionRepository->getToday());
    }

    public function store(TransactionRequest $request)
    {
        $userService = new UserService();

        $user_id = $userService->getUserId();

        $blockedHours = Availability::query()
            ->where('raffle_id', $request->raffle_id)
            ->where('user_id', $user_id)
            ->where('order', now()->dayOfWeek)
            ->value('blocked_hours');

        $currentTime = Carbon::now();

        foreach ($blockedHours as $blockedHour) {
            $lessFive = Carbon::createFromFormat('H:i:s', $blockedHour)
                ->subMinutes(5);

            $plusFive = Carbon::createFromFormat('H:i:s', $blockedHour)
                ->addMinutes(5);

            if ($currentTime->between($lessFive, $plusFive)) {
                abort(422, 'No puedes realizar transacciones entre las ' . $lessFive->format('g:i A') . ' y las ' . $plusFive->format('g:i A'));
            }
        }

        $blockedNumber = BlockedNumber::query()
            ->where('raffle_id', $request->raffle_id)
            ->where('user_id', $user_id)
            ->where('number', $request->digit)
            ->first();

        $transactionService = new TransactionService();

        if ($blockedNumber) {
            if ($blockedNumber['settings']['individual_limit']) {
                if ($request->amount > $blockedNumber['settings']['individual_limit']) {
                    abort(422, 'El monto máximo es C$' . $blockedNumber['settings']['individual_limit']);
                }
            }

            if ($blockedNumber['settings']['general_limit']) {
                $transactionsTotalAmount = $transactionService->getCurrentTotal($request->validated());

                if ($transactionsTotalAmount + $request->amount > $blockedNumber['settings']['general_limit']) {
                    $availableAmount = $blockedNumber['settings']['general_limit'] - $transactionsTotalAmount;
                    abort(422, 'El monto disponible es C$' . $availableAmount);
                }
            }
        }

        $settings = RaffleUser::query()
            ->where('user_id', $user_id)
            ->where('raffle_id', $request->raffle_id)
            ->value('settings');

        if ($settings['general_limit']) {
            $transactionsTotalAmount = $transactionService->getCurrentTotal($request->validated());

            if ($transactionsTotalAmount + $request->amount > $settings['general_limit']) {
                $availableAmount = $settings['general_limit'] - $transactionsTotalAmount;
                abort(422, 'El monto disponible es C$' . $availableAmount);
            }
        }

        $total = $settings['super_x']
            ? ($request->amount * $settings['multiplier']) * 2
            : $request->amount * $settings['multiplier'];

        $transaction = Transaction::create(
            $request->validated() + [
                'user_id' => auth()->id(),
                'prize' => $total,
                'status' => 'PURCHASED'
            ]
        );

        $transaction->load('raffle:id,name');

        return TransactionResource::make($transaction);
    }
}
