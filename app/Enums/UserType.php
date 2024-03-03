<?php

namespace App\Enums;

enum UserType: string
{
    case Admin = "admin";
    case Agent = "agent";
    case Player = "player";

    public function rankPoint(): string
    {
        return match ($this) {
            self::Admin => 10,
            self::Agent => 30,
            self::Player => 40,
        };
    }
}
