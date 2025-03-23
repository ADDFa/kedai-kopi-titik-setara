<?php

namespace App\Enum;

class PaymentStatus
{
    const PENDING = "pending";
    const PAID = "paid";
    const FAILED = "failed";

    public static function values()
    {
        return [
            self::PENDING,
            self::PAID,
            self::FAILED
        ];
    }
}
