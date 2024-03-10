<?php

namespace App\Http\Controllers\Api\V1\Webhook;

use App\Enums\SlotWebhookResponseCode;
use App\Enums\TransactionName;
use App\Http\Controllers\Api\V1\Webhook\Traits\UseWebhook;
use App\Http\Controllers\Controller;
use App\Http\Requests\Slot\SlotWebhookRequest;
use App\Models\Transaction;
use App\Models\User;
use App\Services\Slot\SlotWebhookService;
use App\Services\Slot\SlotWebhookValidator;
use App\Services\WalletService;
use Illuminate\Http\Request;

class BuyOutController extends Controller
{
    use UseWebhook;

    public function buyOut(SlotWebhookRequest $request)
    {
        $validator = $request->check();

        if ($validator->fails()) {
            return $validator->getResponse();
        }

        $before_balance = $request->getMember()->balanceFloat;

        $event = $this->createEvent($request);

        $this->createWagerTransactions($validator->getRequestTransactions(), $event);

        foreach ($validator->getRequestTransactions() as $requestTransaction) {
            app(WalletService::class)
                ->transfer(
                    User::adminUser(),
                    $request->getMember(),
                    abs($requestTransaction->TransactionAmount),
                    TransactionName::Cancel,
                    [
                        "event_id" => $request->getMessageID(),
                        "seamless_transaction_id" => $requestTransaction->TransactionID,
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
