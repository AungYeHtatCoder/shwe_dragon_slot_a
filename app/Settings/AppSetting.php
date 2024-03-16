<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AppSetting extends Settings
{

    public float $provider_balance;

    public static function group(): string
    {
        return 'app';
    }
}