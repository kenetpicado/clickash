<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\User;
use App\Repositories\ArchingRepository;
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

    private TransactionRepository $transactionRepository;
    private ArchingRepository $archingRepository;

    public function __construct()
    {
        $this->currentTime = Carbon::now();
        $this->transactionRepository = new TransactionRepository();
        $this->archingRepository = new ArchingRepository();
    }

    public function validateBulkTransactions(array $request)
    {
        $availabilityRepository = new AvailabilityRepository();
        $blockedNumberRepository = new BlockedNumberRepository();
        $raffleUserRepository = new RaffleUserRepository();
        $dateTimeService = new DateTimeServiceCopy();

        $ownerId = auth()->user()->getOwnerId();

        $raffleSettings = $raffleUserRepository->getSettings($ownerId, $request['raffle_id']);

        $models = [
            [
                'id' => auth()->id(),
                'type' => 'user'
            ],
            [
                'id' => $ownerId,
                'type' => 'team'
            ]
        ];

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

            foreach ($models as $model) {
                $blockedNumber = $blockedNumberRepository->findWhere($request['raffle_id'], $model['id'], $transaction['digit']);

                if ($blockedNumber) {
                    if (isset($blockedNumber['settings']['individual_limit'])) {
                        self::checkIndividualLimit($transaction['amount'], $blockedNumber['settings']['individual_limit']);
                    }

                    if (isset($blockedNumber['settings']['general_limit'])) {

                        $amount = collect($request['data'])
                            ->where('hour', $transaction['hour'])
                            ->where('digit', $transaction['digit'])
                            ->sum('amount');

                        self::checkGeneralLimit($transaction + ['raffle_id' => $request['raffle_id']], $blockedNumber['settings']['general_limit'], $amount, $model['type']);
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

    public function checkGeneralLimit($request, $limit, $amount, $type = 'team')
    {
        $transactionsTotalAmount = $type == 'team'
            ? $this->transactionRepository->getTeamCurrentTotal($request)
            : $this->transactionRepository->getUserCurrentTotal($request);

        if ($transactionsTotalAmount + $amount > $limit) {
            $availableAmount = $limit - $transactionsTotalAmount;
            abort(422, "El monto " . ($type == 'team' ? 'global' : 'personal') . " disponible para {$request['digit']} es C$" . $availableAmount);
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

    public function getInvoices(array $request, $user = null)
    {
        $isSeller = auth()->user()->isSeller();

        if ($isSeller)
            $user_id = auth()->id();
        else
            $user_id = $user;

        $invoices = $this->transactionRepository->getInvoicesPerDay($request, $user_id);

        if ($user_id)
            $total = $this->transactionRepository->getUserTransactionsTotalPerDay($user_id, $request);
        else
            $total = $this->transactionRepository->getTeamTransactionsTotalPerDay($request);

        $users = User::whereIn('id', $invoices->pluck('user_id')->unique())
            ->withTrashed()
            ->get(['id', 'name']);

        $invoices->transform(function ($invoice) use ($users, $isSeller) {
            $invoice->user = $users->where('id', $invoice->user_id)->value('name') . ($isSeller ? ' (Tú)' : '');
            return $invoice;
        });

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

        return [
            'user' => DB::table('users')->where('id', $transactions->value('user_id'))->value('name'),
            'raffle' => DB::table('raffles')->where('id', $transactions->value('raffle_id'))->value('name'),
            'invoice_number' => $invoice,
            'total' => $transactions->sum('amount'),
            'company' => auth()->user()->getCompanyName(),
            'transactions' => $transactions,
            'client' => $transactions->value('client'),
            'datetime' => $transactions->first()->created_at->format('d/m/y g:i A')
        ];
    }

    public function getWinners(array $request, $raffle)
    {
        $user_id = auth()->user()->isSeller()
            ? auth()->id()
            : null;

        return [
            'transactions' => $this->transactionRepository->getWinners($request, $raffle, $user_id),
            'message' => isset($request['date']) ? 'Ganadores del ' . Carbon::parse($request['date'])->format('d/m/y') : 'Ganadores de hoy'
        ];
    }

    public function markAsPaid($transaction): void
    {
        $this->transactionRepository->markAsPaid($transaction);
    }

    public function getSalesReport(array $request, $raffle_id): array
    {
        if (!isset($request['hour']) || !$raffle_id) {
            return [
                'sales' => [],
                'total' => 'C$0'
            ];
        }

        $user_id = auth()->user()->isSeller()
            ? auth()->id()
            : $request['user_id'] ?? null;

        $data = $this->transactionRepository->getSalesReport($request, $raffle_id, $user_id);

        return [
            'sales' => $data,
            'total' => 'C$'.number_format($data->sum('total'))
        ];
    }

    public function getTransactionResumePerWeek($user_id)
    {
        $resume_transactions = $this->transactionRepository->getTransactionResumePerWeek($user_id);
        $arching = $this->archingRepository->getArchingResumePerWeek($user_id, $resume_transactions->min('week'), $resume_transactions->max('week'));

        $startDate = Carbon::now()->startOfYear()->startOfWeek();

        $resume_transactions->transform(function ($item) use ($arching, $startDate) {
            $item->week_label = self::getWeekLabel($startDate, $item->week);
            $weekRecord = $arching->where('week', $item->week)->first();

            if ($weekRecord) {
                $item->deposit = $weekRecord->deposit;
                $item->withdrawal = $weekRecord->withdrawal;
            }

            return $item;
        });

        return $resume_transactions;
    }

    public function getWeekTransactionResume($user_id, $week)
    {
        $resume = $this->transactionRepository->getWeekTransactionResume($week, $user_id);
        $resume_archings = $this->archingRepository->getWeekArchingResume($user_id, $week);

        $resume->week_label = self::getWeekLabel(Carbon::now()->startOfYear()->startOfWeek(), $week);

        if ($resume_archings) {
            $resume->deposit = $resume_archings->deposit;
            $resume->withdrawal = $resume_archings->withdrawal;
        }

        return $resume;
    }

    private function getWeekLabel($startDate, $week)
    {
        return "Semana: " . $startDate->copy()->addWeeks($week - 1)->format('d/m/y') . ' - ' . $startDate->copy()->addWeeks($week - 1)->addDays(6)->format('d/m/y');
    }
}
