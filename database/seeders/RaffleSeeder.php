<?php

namespace Database\Seeders;

use App\Models\Raffle;
use Illuminate\Database\Seeder;

class RaffleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $raffles = [
            [
                'name' => 'Diaria',
                'settings' => [
                    'date' => false,
                    'super_x' => true,
                    'min' => '00',
                    'max' => '99',
                    'general_limit' => '1000',
                    'individual_limit' => '100',
                ],
                'availability' => [
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
                ],
            ],
            [
                'name' => 'Terminacion 2',
                'settings' => [
                    'date' => false,
                    'super_x' => false,
                    'min' => '00',
                    'max' => '99',
                    'general_limit' => '1000',
                    'individual_limit' => null,
                ],
                'availability' => [
                    [
                        'day' => 'Martes',
                        'order' => 2,
                        'start_time' => '07:00:00',
                        'end_time' => '18:00:00',
                        'blocked_hours' => ['09:00:00', '18:00:00'],
                    ],
                ],
            ],
            [
                'name' => 'Tica',
                'settings' => [
                    'date' => false,
                    'super_x' => false,
                    'min' => '00',
                    'max' => '99',
                    'general_limit' => '1000',
                    'individual_limit' => '100',
                ],
                'availability' => [
                    [
                        'day' => 'Domingo',
                        'order' => 0,
                        'start_time' => '07:00:00',
                        'end_time' => '19:30:00',
                        'blocked_hours' => ['13:00:00', '16:30:00', '19:30:00'],
                    ],
                    [
                        'day' => 'Lunes',
                        'order' => 1,
                        'start_time' => '07:00:00',
                        'end_time' => '19:30:00',
                        'blocked_hours' => ['13:00:00', '16:30:00', '19:30:00'],
                    ],
                    [
                        'day' => 'Martes',
                        'order' => 2,
                        'start_time' => '07:00:00',
                        'end_time' => '19:30:00',
                        'blocked_hours' => ['13:00:00', '16:30:00', '19:30:00'],
                    ],
                    [
                        'day' => 'Miercoles',
                        'order' => 3,
                        'start_time' => '07:00:00',
                        'end_time' => '19:30:00',
                        'blocked_hours' => ['13:00:00', '16:30:00', '19:30:00'],
                    ],
                    [
                        'day' => 'Jueves',
                        'order' => 4,
                        'start_time' => '07:00:00',
                        'end_time' => '19:30:00',
                        'blocked_hours' => ['13:00:00', '16:30:00', '19:30:00'],
                    ],
                    [
                        'day' => 'Viernes',
                        'order' => 5,
                        'start_time' => '07:00:00',
                        'end_time' => '19:30:00',
                        'blocked_hours' => ['13:00:00', '16:30:00', '19:30:00'],
                    ],
                    [
                        'day' => 'Sabado',
                        'order' => 6,
                        'start_time' => '07:00:00',
                        'end_time' => '19:30:00',
                        'blocked_hours' => ['13:00:00', '16:30:00', '19:30:00'],
                    ],
                ],
            ],
            [
                'name' => 'Fecha',
                'settings' => [
                    'date' => true,
                    'super_x' => false,
                    'min' => null,
                    'max' => null,
                    'general_limit' => null,
                    'individual_limit' => '250',
                ],
                'availability' => [
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
                ],
            ],
            [
                'name' => 'Juega 3',
                'settings' => [
                    'date' => false,
                    'super_x' => false,
                    'min' => '000',
                    'max' => '999',
                    'general_limit' => '200',
                    'individual_limit' => null,
                ],
                'availability' => [
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
                ],
            ],
            [
                'name' => '3 Monazos',
                'settings' => [
                    'date' => false,
                    'super_x' => false,
                    'min' => '000',
                    'max' => '999',
                    'general_limit' => '200',
                    'individual_limit' => null,
                ],
                'availability' => [
                    [
                        'day' => 'Domingo',
                        'order' => 0,
                        'start_time' => '07:00:00',
                        'end_time' => '19:30:00',
                        'blocked_hours' => ['13:00:00', '16:30:00', '19:30:00'],
                    ],
                    [
                        'day' => 'Lunes',
                        'order' => 1,
                        'start_time' => '07:00:00',
                        'end_time' => '19:30:00',
                        'blocked_hours' => ['13:00:00', '16:30:00', '19:30:00'],
                    ],
                    [
                        'day' => 'Martes',
                        'order' => 2,
                        'start_time' => '07:00:00',
                        'end_time' => '19:30:00',
                        'blocked_hours' => ['13:00:00', '16:30:00', '19:30:00'],
                    ],
                    [
                        'day' => 'Miercoles',
                        'order' => 3,
                        'start_time' => '07:00:00',
                        'end_time' => '19:30:00',
                        'blocked_hours' => ['13:00:00', '16:30:00', '19:30:00'],
                    ],
                    [
                        'day' => 'Jueves',
                        'order' => 4,
                        'start_time' => '07:00:00',
                        'end_time' => '19:30:00',
                        'blocked_hours' => ['13:00:00', '16:30:00', '19:30:00'],
                    ],
                    [
                        'day' => 'Viernes',
                        'order' => 5,
                        'start_time' => '07:00:00',
                        'end_time' => '19:30:00',
                        'blocked_hours' => ['13:00:00', '16:30:00', '19:30:00'],
                    ],
                    [
                        'day' => 'Sabado',
                        'order' => 6,
                        'start_time' => '07:00:00',
                        'end_time' => '19:30:00',
                        'blocked_hours' => ['13:00:00', '16:30:00', '19:30:00'],
                    ],
                ],
            ],
        ];

        foreach ($raffles as $raffle) {
            $created = Raffle::create([
                'name' => $raffle['name'],
                'settings' => $raffle['settings'],
            ]);

            if (isset($raffle['availability'])) {
                foreach ($raffle['availability'] as $availability) {
                    $created->availability()->create($availability);
                }
            }
        }
    }
}
