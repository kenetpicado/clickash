<?php

namespace App\Repositories;

use App\Models\Arching;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ArchingRepository
{
    public function getAll(array $request)
    {
        return Arching::where('user_id', auth()->id())
            ->with('seller:id,name')
            ->when(isset($request['type']), fn ($query) => $query->where('type', $request['type']))
            ->when(isset($request['seller_id']), fn ($query) => $query->where('seller_id', $request['seller_id']))
            ->when(isset($request['date']), fn ($query) => $query->whereDate('created_at', $request['date']), fn ($query) => $query->where('created_at', '>=', Carbon::now()->startOfWeek()))
            ->latest('id')
            ->paginate();
    }

    public function getTotal(array $request)
    {
        return DB::table('archings')
            ->where('user_id', auth()->id())
            ->when(isset($request['type']), fn ($query) => $query->where('type', $request['type']))
            ->when(isset($request['seller_id']), fn ($query) => $query->where('seller_id', $request['seller_id']))
            ->when(isset($request['date']), fn ($query) => $query->whereDate('created_at', $request['date']), fn ($query) => $query->where('created_at', '>=', Carbon::now()->startOfWeek()))
            ->sum('amount');
    }
}
