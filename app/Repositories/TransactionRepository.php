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

    public function getInvoicesPerDay($request = [], $user_id = null)
    {
        $query = $user_id
            ? Transaction::where('user_id', $user_id)
            : self::setTeam();

        return $query
            ->selectRaw('invoice_number, MAX(created_at) as created_at, MAX(deleted_at) as deleted_at, MAX(raffle_id) as raffle_id, MAX(user_id) as user_id, (SELECT MAX(name) FROM raffles WHERE raffles.id = MAX(raffle_id)) as raffle, SUM(amount) as total, MAX(client) as client')
            ->groupBy('invoice_number')
            ->latest('created_at')
            ->day($request)
            ->trashed($request)
            ->whereNotNull('invoice_number')
            ->when(isset($request['raffle_id']), fn ($query) => $query->where('raffle_id', $request['raffle_id']))
            ->paginate();
    }

    public function getTeamTransactionsTotalPerDay($request = [])
    {
        return self::setTeam()
            ->day($request)
            ->trashed($request)
            ->sum('amount');
    }

    public function getUserTransactionsTotalPerDay($user_id, $request = [])
    {
        return Transaction::query()
            ->where('user_id', $user_id)
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

    public function getUserCurrentTotal(array $request)
    {
        return Transaction::query()
            ->where('user_id', auth()->id())
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

    public function getSalesReport(array $request, $raffle_id, $user_id = null)
    {
        $query = $user_id
            ? Transaction::where('user_id', $user_id)
            : self::setTeam();

        return $query->where('raffle_id', $raffle_id)
            ->where('hour', $request['hour'])
            ->day($request)
            ->selectRaw('digit, sum(amount) as total')
            ->groupBy('digit')
            ->orderBy('digit')
            ->get();
    }

    public function getWinners(array $request, $raffle_id, $user_id = null)
    {
        $query = $user_id
            ? Transaction::where('user_id', $user_id)
            : self::setTeam();

        return $query
            ->where('raffle_id', $raffle_id)
            ->day($request)
            ->with(['raffle:id,name', 'user:id,name'])
            ->when($user_id == null, fn ($query) => $query->with(['user' => fn ($query) => $query->withTrashed()->select('id', 'name')]))
            ->where('status', '!=', 'VENDIDO')
            ->get();
    }

    public function getTransactionResumePerWeek($user_id)
    {
        return Transaction::query()
            ->where('user_id', $user_id)
            ->whereRaw('YEAR(created_at) = ?', [Carbon::now()->year])
            ->selectRaw('WEEK(created_at, 1) as week, COALESCE(SUM(amount), 0) as income, COALESCE(SUM(CASE WHEN status != "VENDIDO" THEN prize ELSE 0 END), 0) as expenditure')
            ->groupBy('week')
            ->orderBy('week', 'desc')
            ->paginate();
    }

    public function getWeekTransactionResume($week, $user_id)
    {
        return Transaction::query()
            ->where('user_id', $user_id)
            ->whereRaw('YEAR(created_at) = ? and WEEK(created_at, 1) = ?', [Carbon::now()->year, $week])
            ->selectRaw('WEEK(created_at, 1) as week, COALESCE(SUM(amount), 0) as income, COALESCE(SUM(CASE WHEN status != "VENDIDO" THEN prize ELSE 0 END), 0) as expenditure')
            ->groupBy('week')
            ->first();
    }

    // PENDING REVIEW all down here
    public function getCashboxByUser($user_id, $request = [])
    {
        return Transaction::query()
            ->where('user_id', $user_id)
            ->when(isset($request['date']), function ($query) use ($request) {
                $query->whereDate('created_at', $request['date']);
            }, function ($query) {
                $query->where('created_at', '>=', Carbon::now()->startOfWeek());
            })
            ->selectRaw('COALESCE(SUM(amount), 0) as income, COALESCE(SUM(CASE WHEN status != "VENDIDO" THEN prize ELSE 0 END), 0) as expenditure')
            ->first();
    }
}
