<?php

namespace App\Repositories;

use App\Models\Arching;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ArchingRepository
{
    public function getArchingsBySeller($seller_id, $request, $ownerId = null)
    {
        return Arching::query()
            ->when($ownerId, fn ($query) => $query->where('user_id', $ownerId), fn ($query) => $query->where('user_id', auth()->id()))
            ->where('seller_id', $seller_id)
            ->when(isset($request['date']), function ($query) use ($request) {
                $query->whereDate('created_at', $request['date']);
            }, function ($query) {
                $query->where('created_at', '>=', Carbon::now()->startOfWeek());
            })
            ->latest('id')
            ->paginate();
    }

    public function getTotalArchingsBySeller($seller_id, $request, $ownerId = null)
    {
        return Arching::query()
            ->when($ownerId, fn ($query) => $query->where('user_id', $ownerId), fn ($query) => $query->where('user_id', auth()->id()))
            ->where('seller_id', $seller_id)
            ->when(isset($request['date']), function ($query) use ($request) {
                $query->whereDate('created_at', $request['date']);
            }, function ($query) {
                $query->where('created_at', '>=', Carbon::now()->startOfWeek());
            })
            ->selectRaw('COALESCE(SUM(CASE WHEN type = "RETIRO" THEN amount ELSE 0 END), 0) as withdrawal, COALESCE(SUM(CASE WHEN type = "DEPOSITO" THEN amount ELSE 0 END), 0) as deposit')
            ->first();
    }
}
