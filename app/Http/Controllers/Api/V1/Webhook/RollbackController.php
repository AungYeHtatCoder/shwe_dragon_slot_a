<?php

namespace App\Http\Controllers\Api\V1\Webhook;

use App\Enums\SlotWebhookResponseCode;
use App\Enums\TransactionName;
use App\Http\Controllers\Api\V1\Webhook\Traits\UseWebhook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Slot\SlotWebhookRequest;
use App\Models\Transaction;
use App\Models\User;
use App\Services\Slot\SlotWebhookService;
use App\Services\Slot\SlotWebhookValidator;
use App\Services\WalletService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class RollbackController extends Controller
{
    use UseWebhook;

    public function rollback(SlotWebhookRequest $request)
    {
        $validator = $request->check();

        if ($validator->fails()) {
            return $validator->getResponse();
        }

        $before_balance = $request->getMember()->balanceFloat;

        $event = $this->createEvent($request);

        $seamless_transactions = $this->createWagerTransactions($validator->getRequestTransactions(), $event, true);

        foreach ($seamless_transactions as $seamless_transaction) {
            if ($seamless_transaction->transaction_amount < 0) {
                $from = $request->getMember();
                $to = User::adminUser();
            } else {
                $from = User::adminUser();
                $to = $request->getMember();
            }

            $this->processTransfer(
                $from,
                $to,
                TransactionName::Rollback,
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
