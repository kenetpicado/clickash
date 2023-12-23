<?php

namespace App\Repositories;

use App\Enums\TransactionStatusEnum;
use App\Models\Transaction;
use Carbon\Carbon;

class TransactionRepository
{
    public function delete($transaction)
    {
        $transaction->delete();
    }

    public function markAsPaid($transaction)
    {
        Transaction::where('id', $transaction)->update(['status' => TransactionStatusEnum::PAID->value]);
    }

    // Obtener todas las transacciones de un vendedor
    // del dia actual o de una fecha especifica
    public function getByUserOfTheDay($user, $request = [])
    {
        if (isset($request['trashed'])) {
            $request['trashed'] = filter_var($request['trashed'], FILTER_VALIDATE_BOOLEAN);
        } else {
            $request['trashed'] = false;
        }

        return $user->transactions()
            ->with('raffle:id,name')
            ->latest('id')
            ->when(
                isset($request['date']),
                fn ($q) => $q->whereDate('created_at', $request['date']),
                fn ($q) => $q->whereDate('created_at', Carbon::today())
            )
            ->when($request['trashed'], fn ($q) => $q->onlyTrashed())
            ->paginate();
    }

    private function setTeam()
    {
        $team = (new UserRepository)->getTeam();

        return Transaction::whereIn('user_id', $team);
    }

    public function getByTeam()
    {
        return self::setTeam()
            ->with([
                'user' => fn ($query) => $query->withTrashed()->select('id', 'name'),
                'raffle:id,name'
            ])
            ->latest('id')
            ->paginate();
    }

    //TODO: should be deleted
    public function getTeamByRaffle($raffle_id)
    {
        return self::setTeam()
            ->where('raffle_id', $raffle_id)
            ->with(['user' => fn ($query) => $query->withTrashed()->select('id', 'name')])
            ->latest('id')
            ->paginate();
    }

    public function getAllOfTheDay($raffle_id, $request = [])
    {
        return self::setTeam()
            ->where('raffle_id', $raffle_id)
            ->with(['user' => fn ($query) => $query->withTrashed()->select('id', 'name')])
            ->when(isset($request['date']), function ($query) use ($request) {
                $query->whereDate('created_at', $request['date']);
            }, function ($query) {
                $query->whereDate('created_at', Carbon::today());
            })
            ->latest('id')
            ->paginate();
    }

    public function getMyDaily()
    {
        return Transaction::where('user_id', auth()->id())
            ->where('created_at', '>=', Carbon::now()->format('Y-m-d 00:00:00'))
            ->with('raffle:id,name')
            ->latest('id')
            ->paginate();
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

    public function markWinners($winningNumber)
    {
        self::setTeam()
            ->where('raffle_id', $winningNumber->raffle_id)
            ->where('hour', $winningNumber->hour)
            ->where('digit', $winningNumber->number)
            ->where('created_at', '>=', Carbon::now()->format('Y-m-d 00:00:00'))
            ->update(['status' => TransactionStatusEnum::PRIZE->value]);
    }

    public function getWinnersByRaffle($raffle_id)
    {
        return self::setTeam()
            ->where('raffle_id', $raffle_id)
            ->whereDate('created_at', Carbon::today())
            ->with(['user' => fn ($query) => $query->withTrashed()->select('id', 'name')])
            ->orderBy('hour')
            ->where(function ($query) {
                $query->where('status', TransactionStatusEnum::PRIZE->value)
                    ->orWhere('status', TransactionStatusEnum::PAID->value);
            })
            ->get();
    }

    public function getTotalByUserOfTheDay($user, $request = [])
    {
        return $user->transactions()
            ->when(
                isset($request['date']),
                fn ($q) => $q->whereDate('created_at', $request['date']),
                fn ($q) => $q->whereDate('created_at', Carbon::today())
            )
            ->when(isset($request['trashed']), fn ($q) => $q->onlyTrashed())
            ->sum('amount');
    }

    public function getDailyTotalByRaffle($raffle_id, $request = [])
    {
        return self::setTeam()
            ->where('raffle_id', $raffle_id)
            ->when(isset($request['date']), function ($query) use ($request) {
                $query->whereDate('created_at', $request['date']);
            }, function ($query) {
                $query->whereDate('created_at', Carbon::today());
            })
            ->sum('amount');
    }

    public function getTeamTotalOfTheDay($request = [])
    {
        return self::setTeam()
            ->when(isset($request['date']), function ($query) use ($request) {
                $query->whereDate('created_at', $request['date']);
            }, function ($query) {
                $query->whereDate('created_at', Carbon::today());
            })
            ->sum('amount');
    }

    public function getTeamSalesSummary($raffle_id, $request)
    {
        return self::setTeam()
            ->where('raffle_id', $raffle_id)
            ->where('hour', $request['hour'])
            ->when(isset($request['date']), function ($query) use ($request) {
                $query->whereDate('created_at', $request['date']);
            }, function ($query) {
                $query->whereDate('created_at', Carbon::today());
            })
            ->selectRaw('digit, sum(amount) as total')
            ->groupBy('digit')
            ->orderBy('digit')
            ->get();
    }

    public function getUserSalesSummary($user_id, $raffle_id, $request)
    {
        return Transaction::query()
            ->where('user_id', $user_id)
            ->where('raffle_id', $raffle_id)
            ->where('hour', $request['hour'])
            ->when(isset($request['date']), function ($query) use ($request) {
                $query->whereDate('created_at', $request['date']);
            }, function ($query) {
                $query->whereDate('created_at', Carbon::today());
            })
            ->selectRaw('digit, sum(amount) as total')
            ->groupBy('digit')
            ->orderBy('digit')
            ->get();
    }

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

    public function revertTeamTransactions($raffle_id, $winningNumber)
    {
        return self::setTeam()
            ->whereDate('created_at', $winningNumber->date)
            ->where('raffle_id', $raffle_id)
            ->where('hour', $winningNumber->hour)
            ->where('status', '!=', 'VENDIDO')
            ->update(['status' => 'VENDIDO']);
    }

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
