<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('app.provider_initial_balance', env("PROVIDER_INITIAL_BALANCE", 0));
    }
};
