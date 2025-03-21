<?php

namespace App\Enum;

class UserRole
{
    const ADMIN = "admin";
    const CUSTOMER = "customer";

    public static function values()
    {
        return [
            self::ADMIN,
            self::CUSTOMER
        ];
    }
}
