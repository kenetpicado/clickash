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
                    "number" => 2,
                    "super_x" => true,
                ]),
                "image" => "https://static.vecteezy.com/system/resources/thumbnails/004/229/131/small/sticker-with-today-word-free-vector.jpg"
            ],
            [
                "name" => "Fecha",
                "fields" => json_encode([
                    "date" => true,
                    "number" => 4,
                    "super_x" => false,
                ]),
                "image" => "https://as1.ftcdn.net/v2/jpg/00/98/96/46/1000_F_98964641_fe9ooO3c0nI4Qv2w6Zw0HOOtbiRfHbCn.jpg"
            ],
            [
                "name" => "3 monazos",
                "fields" => json_encode([
                    "date" => false,
                    "number" => 3,
                    "super_x" => false,
                ]),
                "image" => "https://img.freepik.com/vector-gratis/tres-monos-sobre-fondo-blanco_1308-43080.jpg"
            ],
            [
                "name" => "Juega 3",
                "fields" => json_encode([
                    "date" => false,
                    "number" => 3,
                    "super_x" => false,
                ]),
                "image" => "https://img.freepik.com/premium-photo/gold-number-3_2227-11.jpg"
            ],
            [
                "name" => "Tica",
                "fields" => json_encode([
                    "date" => false,
                    "number" => 2,
                    "super_x" => false,
                ])
            ],
            [
                "name" => "Terminacion 2",
                "fields" => json_encode([
                    "date" => false,
                    "number" => 2,
                    "super_x" => false,
                ]),
                "image" => "https://st.depositphotos.com/1561359/4118/v/600/depositphotos_41184825-stock-illustration-3d-shiny-golden-number-2.jpg"
            ],
        ];

        foreach ($raffles as $raffle) {
            \App\Models\Raffle::create($raffle);
        }
    }
}
