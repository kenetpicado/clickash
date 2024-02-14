<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\User;
use App\Repositories\AvailabilityRepository;
use App\Repositories\BlockedNumberRepository;
use App\Repositories\RaffleUserRepository;
use App\Repositories\TransactionRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransactionService
{
    private $currentTime;

    private $transactionRepository;

    public function __construct()
    {
        $this->currentTime = Carbon::now();
        $this->transactionRepository = new TransactionRepository();
    }

    public function validateBulkTransactions(array $request)
    {
        $availabilityRepository = new AvailabilityRepository();
        $blockedNumberRepository = new BlockedNumberRepository();
        $raffleUserRepository = new RaffleUserRepository();
        $dateTimeService = new DateTimeService();

        $ownerId = auth()->user()->getOwnerId();

        $raffleSettings = $raffleUserRepository->getSettings($ownerId, $request['raffle_id']);

        //CHECK IF THE TIME IS BLOCKED
        $blockedHours = $availabilityRepository->getTodayBlockedHours($request['raffle_id'], $ownerId);

        foreach ($blockedHours as $blockedHour) {
            $message = $dateTimeService->getBlockedHourMessage($this->currentTime, $blockedHour);

            if ($message) {
                abort(422, $message);
            }
        }

        foreach ($request['data'] as $transaction) {
            if (Carbon::parse($transaction['hour'])->isPast()) {
                abort(422, "El turno de las {$transaction['hour']} ya pasó");
            }

            if (isset($raffleSettings['max'])) {
                if (strlen($transaction['digit']) > strlen($raffleSettings['max'])) {
                    abort(422, "Los números solo pueden contener " . strlen($raffleSettings['max']) . " digitos");
                }

                if ($transaction['digit'] > $raffleSettings['max']) {
                    abort(422, "El número máximo es {$raffleSettings['max']}");
                }
            }

            // CHECK IF THE NUMBER IS BLOCKED
            // GENERAL CONFIG: $ownerId
            // SELLER CONFIG: auth()->id()
            foreach ([auth()->id(), $ownerId] as $current_user_id) {
                $blockedNumber = $blockedNumberRepository->findWhere($request['raffle_id'], $current_user_id, $transaction['digit']);

                if ($blockedNumber) {
                    if (isset($blockedNumber['settings']['individual_limit'])) {
                        self::checkIndividualLimit($transaction['amount'], $blockedNumber['settings']['individual_limit']);
                    }

                    if (isset($blockedNumber['settings']['general_limit'])) {

                        $amount = collect($request['data'])
                            ->where('hour', $transaction['hour'])
                            ->where('digit', $transaction['digit'])
                            ->sum('amount');

                        self::checkGeneralLimit($transaction + ['raffle_id' => $request['raffle_id']], $blockedNumber['settings']['general_limit'], $amount);
                    }
                }
            }

            // CHECK IS SETTINGS ARE BLOCKED
            if ($raffleSettings['individual_limit']) {
                self::checkIndividualLimit($transaction['amount'], $raffleSettings['individual_limit']);
            }

            if ($raffleSettings['general_limit']) {

                $amount = collect($request['data'])
                    ->where('hour', $transaction['hour'])
                    ->where('digit', $transaction['digit'])
                    ->sum('amount');

                self::checkGeneralLimit($transaction + ['raffle_id' => $request['raffle_id']], $raffleSettings['general_limit'], $amount);
            }
        }

        return $raffleSettings;
    }

    public function checkIndividualLimit($amount, $limit)
    {
        if ($amount > $limit) {
            abort(422, 'El monto máximo es C$' . $limit);
        }
    }

    public function checkGeneralLimit($request, $limit, $amount)
    {
        $transactionsTotalAmount = $this->transactionRepository->getTeamCurrentTotal($request);

        if ($transactionsTotalAmount + $amount > $limit) {
            $availableAmount = $limit - $transactionsTotalAmount;
            abort(422, "El monto disponible para {$request['digit']} es C$" . $availableAmount);
        }
    }

    public function destroy($transaction)
    {
        if (!$transaction->created_at->isToday()) {
            abort(403, 'No puedes eliminar una transacción de otro día');
        }

        if (Carbon::parse($transaction->hour)->isPast()) {
            abort(403, 'No puedes eliminar una transacción que ya pasó');
        }

        $transaction->delete();
    }

    public function destroyInvoice($invoice)
    {
        $transactions = Transaction::where('invoice_number', $invoice)->get();

        if ($transactions->isEmpty()) {
            abort(404, 'No se encontraron transacciones');
        }

        if (!$transactions->first()->created_at->isToday()) {
            abort(403, 'No puedes eliminar un recibo de otro día');
        }

        foreach ($transactions as $transaction) {
            if (Carbon::parse($transaction->hour)->isPast()) {
                abort(403, 'Hay transacciones que ya pasaron');
            }
        }

        $transactions->each->delete();
    }

    public function generateInvoiceNumber()
    {
        return strtoupper(Str::random(8));
    }

    public function existsInvoiceNumber($invoiceNumber)
    {
        return Transaction::where('invoice_number', $invoiceNumber)->exists();
    }

    public function getInvoices(array $request)
    {
        $isSeller = auth()->user()->isSeller();
        $invoices = $this->transactionRepository->getInvoicesPerDay($request, $isSeller);

        if ($isSeller) {
            $invoices->transform(function ($invoice) {
                $invoice->user = auth()->user()->name . " (Tú)";
                return $invoice;
            });
            $total = $this->transactionRepository->getUserTransactionsTotalPerDay(auth()->id(), $request);
        } else {
            $users = User::whereIn('id', $invoices->pluck('user_id')->unique())->withTrashed()->get(['id', 'name']);

            $invoices->transform(function ($invoice) use ($users) {
                $invoice->user = $users->where('id', $invoice->user_id)->value('name');
                return $invoice;
            });

            $total = $this->transactionRepository->getTeamTransactionsTotalPerDay($request);
        }

        return [
            'invoices' => $invoices,
            'total' => 'C$ ' . number_format($total)
        ];
    }

    public function getInvoiceTransactions($invoice)
    {
        $transactions = Transaction::query()
            ->where('invoice_number', $invoice)
            ->when(auth()->user()->isOwner(), fn ($query) => $query->withTrashed())
            ->orderBy('digit')
            ->orderBy('hour')
            ->get();

        if ($transactions->isEmpty()) {
            abort(404, 'No se encontraron transacciones');
        }

        return [
            'transactions' => $transactions,
            'user' => DB::table('users')->where('id', $transactions->first()->user_id)->value('name'),
            'raffle' => DB::table('raffles')->where('id', $transactions->first()->raffle_id)->value('name'),
            'invoice_number' => $invoice,
            'created_at' => $transactions->first()->created_at->format('d/m/y g:i A'),
            'status' => $transactions->first()->deleted_at
                ? 'ELIMINADO ' .  $transactions->first()->deleted_at->format('d/m/y g:i A')
                : 'VENDIDO',
            'total' => 'C$ ' . number_format($transactions->sum('amount')),
            'company' => auth()->user()->getCompanyName()
        ];
    }
}
