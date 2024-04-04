<?php

namespace App\Enums;

enum UserType: int
{
    case Admin = 10;
    case Agent = 20;
    case Player = 30;

    public static function usernameLength(UserType $type)
    {
        return match ($type) {
            self::Admin => 1,
            self::Agent => 2,
            self::Player => 3,
        };
    }

    public static function childUserType(UserType $type)
    {
        return match ($type) {
            self::Admin => self::Agent,
            self::Agent => self::Player,
            self::Player => self::Player
        };
    }
}
