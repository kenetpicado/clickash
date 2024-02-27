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
        $currentWeek = Carbon::now()->week - 1;

        if ($currentWeek != $request['week']) {
            $startDate = Carbon::createFromDate(2024, 1, 1);
            $startDate->startOfWeek();

            $request['created_at'] = $startDate->addWeeks($request['week'])->addDays(5)->endOfDay();
        }

        Arching::create($request + ['current_balance' => 0, 'user_id' => auth()->id()]);
    }
}
