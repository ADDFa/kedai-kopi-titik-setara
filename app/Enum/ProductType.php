<?php

namespace App\Enum;

class ProductType
{
    const FOODS = "foods";
    const DRINKS = "drinks";

    public static function values(): array
    {
        return [
            self::FOODS,
            self::DRINKS
        ];
    }
}
