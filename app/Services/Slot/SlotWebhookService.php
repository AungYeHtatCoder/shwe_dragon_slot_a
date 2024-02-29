<?php

namespace App\Services\Slot;

use App\Enums\SlotWebhookResponseCode;

class SlotWebhookService
{
    public static function buildResponse(SlotWebhookResponseCode $responseCode, $balance, $before_balance){
        return [
            "ErrorCode" => $responseCode->value,
            "ErrorMessage" => $responseCode->name,
            "Balance" => $balance,
            "BeforeBalance" => $before_balance
        ];
    }
}