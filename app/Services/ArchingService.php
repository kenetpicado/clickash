<?php

namespace App\Services;

use App\Models\Arching;
use App\Repositories\ArchingRepository;
use Carbon\Carbon;

class ArchingService
{
    private ArchingRepository $archingRespository;

    public function __construct()
    {
        $this->archingRespository = new ArchingRepository();
    }

    public function getArchingsOfWeek($week, $seller_id)
    {
        return $this->archingRespository->getArchingsOfWeek($week, $seller_id);
    }

    public function store(array $request)
    {
        $currentWeek = Carbon::now()->week;

        if ($currentWeek != $request['week']) {
            $startDate = Carbon::createFromDate(2024, 1, 1)->addWeeks($request['week'] - 1)->addDays(6);
            $request['created_at'] = $startDate->endOfDay();
        }

        Arching::create($request + ['current_balance' => 0, 'user_id' => auth()->id()]);
    }
}
