<?php

namespace App\Observers;

use App\Models\Raffle;

class RaffleObserver
{
    public function created(Raffle $raffle)
    {
        $availability = [
            [
                'day' => 'Domingo',
                'order' => 0,
                'start_time' => '07:00:00',
                'end_time' => '21:00:00',
                'blocked_hours' => ['11:00:00', '15:00:00', '21:00:00'],
            ],
            [
                'day' => 'Lunes',
                'order' => 1,
                'start_time' => '07:00:00',
                'end_time' => '21:00:00',
                'blocked_hours' => ['11:00:00', '15:00:00', '21:00:00'],
            ],
            [
                'day' => 'Martes',
                'order' => 2,
                'start_time' => '07:00:00',
                'end_time' => '21:00:00',
                'blocked_hours' => ['11:00:00', '15:00:00', '21:00:00'],
            ],
            [
                'day' => 'Miercoles',
                'order' => 3,
                'start_time' => '07:00:00',
                'end_time' => '21:00:00',
                'blocked_hours' => ['11:00:00', '15:00:00', '21:00:00'],
            ],
            [
                'day' => 'Jueves',
                'order' => 4,
                'start_time' => '07:00:00',
                'end_time' => '21:00:00',
                'blocked_hours' => ['11:00:00', '15:00:00', '21:00:00'],
            ],
            [
                'day' => 'Viernes',
                'order' => 5,
                'start_time' => '07:00:00',
                'end_time' => '21:00:00',
                'blocked_hours' => ['11:00:00', '15:00:00', '21:00:00'],
            ],
            [
                'day' => 'Sabado',
                'order' => 6,
                'start_time' => '07:00:00',
                'end_time' => '21:00:00',
                'blocked_hours' => ['11:00:00', '15:00:00', '18:00:00', '21:00:00'],
            ],
        ];

        $raffle->availability()->createMany($availability);
    }
}
