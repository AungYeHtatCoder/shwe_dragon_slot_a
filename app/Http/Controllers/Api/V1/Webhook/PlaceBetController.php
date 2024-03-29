<?php

namespace App\Http\Controllers\Api\V1\Webhook;

use App\Enums\SlotWebhookResponseCode;
use App\Enums\TransactionName;
use App\Http\Controllers\Api\V1\Webhook\Traits\UseWebhook;
use App\Http\Controllers\Controller;
use App\Http\Requests\Slot\SlotWebhookRequest;
use App\Models\SeamlessEvent;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wager;
use App\Services\Slot\SlotWebhookService;
use App\Services\Slot\SlotWebhookValidator;
use App\Services\WalletService;

class PlaceBetController extends Controller
{
    use UseWebhook;

    public function placeBet(SlotWebhookRequest $request)
    {
        $validator = $request->check();

        if ($validator->fails()) {
            return $validator->getResponse();
        }

        $before_balance = $request->getMember()->balanceFloat;

        $event = $this->createEvent($request);

        $seamless_transactions = $this->createWagerTransactions($validator->getRequestTransactions(), $event);

        foreach ($seamless_transactions as $seamless_transaction) {
            $this->processTransfer(
                $request->getMember(),
                User::adminUser(),
                TransactionName::Stake,
                $seamless_transaction->transaction_amount,
                $seamless_transaction->rate,
                [
                    "event_id" => $request->getMessageID(),
                    "seamless_transaction_id" => $seamless_transaction->id,
                ]
            );
        }

        $request->getMember()->wallet->refreshBalance();

        $after_balance = $request->getMember()->balanceFloat;

        return SlotWebhookService::buildResponse(
            SlotWebhookResponseCode::Success,
            $after_balance,
            $before_balance
        );
    }
}
