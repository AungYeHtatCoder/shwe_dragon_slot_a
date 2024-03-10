<?php

namespace App\Http\Controllers\Api\V1\Webhook;

use App\Enums\SlotWebhookResponseCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\Slot\SlotWebhookRequest;
use App\Services\Slot\SlotWebhookService;
use App\Services\Slot\SlotWebhookValidator;

class GetBalanceController extends Controller
{
    public function getBalance(SlotWebhookRequest $request)
    {
        $validator = SlotWebhookValidator::make($request)->validate();

        if ($validator->fails()) {
            return $validator->getResponse();
        }

        $balance = $request->getMember()->balanceFloat;

        return SlotWebhookService::buildResponse(
            SlotWebhookResponseCode::Success,
            $balance,
            $balance
        );
    }
}
