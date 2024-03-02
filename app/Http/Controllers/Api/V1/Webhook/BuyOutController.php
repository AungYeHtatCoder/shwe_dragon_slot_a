<?php

namespace App\Http\Controllers\Api\V1\Webhook;

use App\Enums\SlotWebhookResponseCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\Slot\SlotWebhookRequest;
use App\Models\Transaction;
use App\Models\User;
use App\Services\Slot\SlotWebhookService;
use App\Services\Slot\SlotWebhookValidator;
use Illuminate\Http\Request;

class BuyOutController extends Controller
{
    public function buyOut(SlotWebhookRequest $request)
    {
        $validator = SlotWebhookValidator::make($request)->validate();

        if ($validator->fails()) {
            return $validator->getResponse();
        }

        Transaction::create([
            "user_id" => $validator->getMember()->id,
            "external_transaction_id" => $validator->getRequestTransaction()->TransactionID,
            "wager_id" => $validator->getRequestTransaction()->WagerID
        ]);
        
        return SlotWebhookService::buildResponse(
            SlotWebhookResponseCode::Success,
            $validator->getAfterBalance(),
            $validator->getBeforeBalance()
        );
    }
}
