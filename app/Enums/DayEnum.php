<?php

namespace App\Enums;

enum DayEnum: string
{
    case DOMINGO = 'Domingo';
    case LUNES = 'Lunes';
    case MARTES = 'Martes';
    case MIERCOLES = 'Miercoles';
    case JUEVES = 'Jueves';
    case VIERNES = 'Viernes';
    case SABADO = 'Sabado';

    public static function getDayNumber(string $value): int
    {
        switch ($value) {
            case self::DOMINGO->value:
                return 0;
            case self::LUNES->value:
                return 1;
            case self::MARTES->value:
                return 2;
            case self::MIERCOLES->value:
                return 3;
            case self::JUEVES->value:
                return 4;
            case self::VIERNES->value:
                return 5;
            case self::SABADO->value:
                return 6;
        }
    }
}
