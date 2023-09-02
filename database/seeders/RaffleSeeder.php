<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                "name" => "Diaria",
                "fields" => json_encode([
                    "date" => false,
                    "number" => 1,
                    "super_x" => true,
                ])
            ],
            [
                "name" => "Fecha",
                "fields" => json_encode([
                    "date" => true,
                    "number" => 1,
                    "super_x" => false,
                ])
            ],
            [
                "name" => "3 monazos",
                "fields" => json_encode([
                    "date" => false,
                    "number" => 3,
                    "super_x" => false,
                ])
            ],
            [
                "name" => "Juega 3",
                "fields" => json_encode([
                    "date" => false,
                    "number" => 3,
                    "super_x" => false,
                ])
            ],
            [
                "name" => "Tica",
                "fields" => json_encode([
                    "date" => false,
                    "number" => 1,
                    "super_x" => false,
                ])
            ],
            [
                "name" => "Terminacion 2",
                "fields" => json_encode([
                    "date" => false,
                    "number" => 2,
                    "super_x" => false,
                ])
            ],
        ];

        foreach ($raffles as $raffle) {
            \App\Models\Raffle::create($raffle);
        }
    }
}
