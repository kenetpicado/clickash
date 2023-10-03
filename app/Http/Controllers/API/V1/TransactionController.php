<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\TransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Availability;
use App\Models\BlockedNumber;
use App\Models\RaffleUser;
use App\Models\Transaction;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return TransactionResource::collection(
            Transaction::query()
                ->where('user_id', auth()->id())
                ->latest('id')
                ->with('raffle:id,name')
                ->where('created_at', '>=', now()->format('Y-m-d').' 00:00:00')
                ->get()
        );
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
                abort(422, 'No puedes realizar transacciones entre las '.$lessFive->format('g:i A').' y las '.$plusFive->format('g:i A'));
            }
        }

        $isBlocked = BlockedNumber::query()
            ->where('raffle_id', $request->raffle_id)
            ->where('user_id', $user_id)
            ->where('number', $request->digit)
            ->exists();

        if ($isBlocked) {
            abort(422, 'El digito '.$request->digit.' está bloqueado');
        }

        $settings = RaffleUser::query()
            ->where('user_id', $user_id)
            ->where('raffle_id', $request->raffle_id)
            ->value('settings');

        $team_ids = $userService->getTeamIds($user_id);

        if ($settings['general_limit']) {
            $transactionsTotalAmount = Transaction::query()
                ->whereIn('user_id', $team_ids)
                ->where('raffle_id', $request->raffle_id)
                ->where('created_at', '>=', now()->format('Y-m-d').' 00:00:00')
                ->where('hour', $request->hour)
                ->where('digit', $request->digit)
                ->sum('amount');

            if ($transactionsTotalAmount + $request->amount > $settings['general_limit']) {
                $availableAmount = $settings['general_limit'] - $transactionsTotalAmount;
                abort(422, 'El monto disponible es C$'.$availableAmount);
            }
        }

        $transaction = Transaction::create($request->validated() + ['user_id' => auth()->id()]);

        $transaction->load('raffle:id,name');

        return TransactionResource::make($transaction);
    }
}
