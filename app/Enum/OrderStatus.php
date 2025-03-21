<?php

namespace App\Enum;

class OrderStatus
{
    const PENDING = "pending";
    const PROCESS = "processed";
    const COMPLETE = "completed";
    const CANCEL = "canceled";

    public static function values()
    {
        return [
            self::PENDING,
            self::PROCESS,
            self::COMPLETE,
            self::CANCEL
        ];
    }
}
