<?php

namespace App\Enums;

enum UserType: string
{
    case Admin = "admin";
    case Master = "master";
    case Agent = "agent";
    case Player = "player";

    public function rankPoint(): string
    {
        return match ($this) {
            self::Admin => 10,
            self::Master => 20,
            self::Agent => 30,
            self::Player => 40,
        };
    }
}
