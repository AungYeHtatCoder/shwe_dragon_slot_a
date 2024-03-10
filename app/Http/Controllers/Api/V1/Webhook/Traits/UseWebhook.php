<?php

namespace App\Http\Controllers\Api\V1\Webhook\Traits;

use App\Enums\TransactionStatus;
use App\Http\Requests\Slot\SlotWebhookRequest;
use App\Models\SeamlessEvent;
use App\Models\Wager;

trait UseWebhook {
    public function createEvent(
        SlotWebhookRequest $request
    ): SeamlessEvent
    {
        return SeamlessEvent::create([
            "user_id" => $request->getMember()->id,
            "message_id" => $request->getMessageID(),
            "product_id" => $request->getProductID(),
            "request_time" => $request->getRequestTime(),
            "raw_data" => $request->all(),
        ]);
    }

    public function createWagerTransactions(
        $requestTransactions,
        SeamlessEvent $event,
    )
    {
        foreach ($requestTransactions as $requestTransaction) {
            $wager = Wager::firstOrCreate([
                "seamless_wager_id" => $requestTransaction->WagerID
            ]);

            $wager->update([
                "status" => $requestTransaction->Status
            ]);

            $event->transactions()->create([
                "user_id" => $event->user_id,
                "wager_id" => $wager->id,
                "seamless_transaction_id" => $requestTransaction->TransactionID,
                "transaction_amount" => $requestTransaction->TransactionAmount,
                "bet_amount" => $requestTransaction->BetAmount,
                "valid_amount" => $requestTransaction->ValidBetAmount,
                "status" => $requestTransaction->Status,
            ]);

        }
    }
}