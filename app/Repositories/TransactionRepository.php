<?php

namespace App\Repositories;

use App\Enums\TransactionStatusEnum;
use App\Models\Raffle;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;

class TransactionRepository
{
    public function store(array $request)
    {
        return Transaction::create([
            'user_id' => auth()->id(),
            'raffle_id' => $request['raffle_id'],
            'digit' => $request['digit'],
            'amount' => $request['amount'],
            'hour' => $request['hour'],
            'client' => $request['client'],
            'prize' => $request['prize'],
            'status' => TransactionStatusEnum::SOLD->value,
            'super_x' => $request['super_x'],
            'invoice_number' => $request['invoice_number']
        ]);
    }

    public function markAsPaid($transaction)
    {
        Transaction::where('id', $transaction)->update(['status' => TransactionStatusEnum::PAID->value]);
    }

    private function setTeam()
    {
        return Transaction::whereIn('user_id', (new UserRepository)->getTeam());
    }

    public function getInvoicesPerDay($request = [], $isSeller = false)
    {
        $query = $isSeller
            ? Transaction::where('user_id', auth()->id())
            : self::setTeam();

        return $query
            ->selectRaw('invoice_number, MAX(created_at) as created_at, MAX(deleted_at) as deleted_at, MAX(user_id) as user_id, (SELECT MAX(name) FROM raffles WHERE raffles.id = MAX(raffle_id)) as raffle, SUM(amount) as total')
            ->groupBy('invoice_number')
            ->latest('created_at')
            ->day($request)
            ->trashed($request)
            ->whereNotNull('invoice_number')
            ->paginate();
    }

    public function getTeamTransactionsPerDay($request = [])
    {
        return self::setTeam()
            ->with([
                'user' => fn ($query) => $query->withTrashed()->select('id', 'name'),
                'raffle:id,name'
            ])
            ->day($request)
            ->latest('id')
            ->paginate();
    }

    public function getTeamTransactionsTotalPerDay($request = [])
    {
        return self::setTeam()
            ->day($request)
            ->trashed($request)
            ->sum('amount');
    }

    public function getUserTransactionsPerDay($user_id, $request = [])
    {
        return Transaction::query()
            ->where('user_id', $user_id)
            ->day($request)
            ->trashed($request)
            ->with('raffle:id,name')
            ->latest('id')
            ->paginate();
    }

    public function getUserTransactionsTotalPerDay($user_id, $request = [])
    {
        return Transaction::query()
            ->where('user_id', $user_id)
            ->day($request)
            ->trashed($request)
            ->sum('amount');
    }

    public function getRaffleTransactionsPerDay($raffle_id, $request = [])
    {
        return self::setTeam()
            ->where('raffle_id', $raffle_id)
            ->day($request)
            ->trashed($request)
            ->with(['user' => fn ($query) => $query->withTrashed()->select('id', 'name')])
            ->latest('id')
            ->paginate();
    }

    public function getRaffleTransactionsTotalPerDay($raffle_id, $request = [])
    {
        return self::setTeam()
            ->where('raffle_id', $raffle_id)
            ->day($request)
            ->trashed($request)
            ->sum('amount');
    }

    public function getTeamCurrentTotal(array $request)
    {
        return self::setTeam()
            ->where('raffle_id', $request['raffle_id'])
            ->whereDate('created_at', Carbon::today())
            ->where('hour', $request['hour'])
            ->where('digit', $request['digit'])
            ->sum('amount');
    }

    public function setWinningTransactions($winningNumber)
    {
        self::setTeam()
            ->where('raffle_id', $winningNumber->raffle_id)
            ->where('hour', $winningNumber->hour)
            ->where('digit', $winningNumber->number)
            ->whereDate('created_at', $winningNumber->date)
            ->update(['status' => TransactionStatusEnum::PRIZE->value]);
    }

    public function revertWinningTransactions($winningNumber)
    {
        return self::setTeam()
            ->whereDate('created_at', $winningNumber->date)
            ->where('raffle_id', $winningNumber->raffle_id)
            ->where('hour', $winningNumber->hour)
            ->where('status', '!=', 'VENDIDO')
            ->update(['status' => Transaction::SOLD]);
    }

    public function getTeamSalesReport($raffle_id, $request)
    {
        return self::setTeam()
            ->where('raffle_id', $raffle_id)
            ->where('hour', $request['hour'])
            ->day($request)
            ->selectRaw('digit, sum(amount) as total')
            ->groupBy('digit')
            ->orderBy('digit')
            ->get();
    }

    public function getUserSalesReport($user_id, $raffle_id, $request)
    {
        return Transaction::query()
            ->where('user_id', $user_id)
            ->where('raffle_id', $raffle_id)
            ->where('hour', $request['hour'])
            ->day($request)
            ->selectRaw('digit, sum(amount) as total')
            ->groupBy('digit')
            ->orderBy('digit')
            ->get();
    }

    // PENDING REVIEW all down here
    public function getBalanceTeam($request = [])
    {
        return self::setTeam()
            ->when(isset($request['raffle_id']), fn ($query) => $query->where('raffle_id', $request['raffle_id']))
            ->when(isset($request['date']), function ($query) use ($request) {
                $query->whereBetween('created_at', [
                    Carbon::parse($request['date'])->format('Y-m-d 00:00:00'),
                    Carbon::parse($request['date'])->format('Y-m-d 23:59:59'),
                ]);
            }, function ($query) {
                $query->where('created_at', '>=', Carbon::now()->startOfWeek()->format('Y-m-d 00:00:00'));
            })
            ->selectRaw('SUM(amount) as income, SUM(CASE WHEN status != "VENDIDO" THEN prize ELSE 0 END) as expenditure')
            ->first();
    }

    public function getCashboxByUser($user_id, $request = [])
    {
        return Transaction::query()
            ->where('user_id', $user_id)
            ->when(isset($request['raffle_id']), fn ($query) => $query->where('raffle_id', $request['raffle_id']))
            ->when(isset($request['date']), function ($query) use ($request) {
                $query->whereDate('created_at', $request['date']);
            }, function ($query) {
                $query->where('created_at', '>=', Carbon::now()->startOfWeek());
            })
            ->selectRaw('COALESCE(SUM(amount), 0) as income, COALESCE(SUM(CASE WHEN status != "VENDIDO" THEN prize ELSE 0 END), 0) as expenditure')
            ->first();
    }

    //puedo unificar estas 2 funciones en 1 sola
    public function getTeamWinners($raffle_id, $request = [])
    {
        return self::setTeam()
            ->where('raffle_id', $raffle_id)
            ->when(isset($request['date']), function ($query) use ($request) {
                $query->whereDate('created_at', $request['date']);
            }, function ($query) {
                $query->whereDate('created_at', Carbon::today());
            })
            ->with(['user' => fn ($query) => $query->withTrashed()->select('id', 'name')])
            ->where('status', '!=', 'VENDIDO')
            ->get();
    }

    public function getUserWinners($user_id, $raffle_id, $request = [])
    {
        return Transaction::query()
            ->where('user_id', $user_id)
            ->where('raffle_id', $raffle_id)
            ->when(isset($request['date']), function ($query) use ($request) {
                $query->whereDate('created_at', $request['date']);
            }, function ($query) {
                $query->whereDate('created_at', Carbon::today());
            })
            ->where('status', '!=', 'VENDIDO')
            ->get();
    }
}
