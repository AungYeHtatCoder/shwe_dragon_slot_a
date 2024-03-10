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

class JackPotController extends Controller
{
    use UseWebhook;

    public function jackPot(SlotWebhookRequest $request)
    {
        $validator = $request->check();

        if ($validator->fails()) {
            return $validator->getResponse();
        }

        $event = $this->createEvent($request);

        $this->createWagerTransactions($validator->getRequestTransactions(), $event);

        foreach ($validator->getRequestTransactions() as $requestTransaction) {
            app(WalletService::class)
                ->transfer(
                    User::adminUser(),
                    $request->getMember(),
                    $requestTransaction->TransactionAmount,
                    TransactionName::JackPot,
                    [
                        "event_id" => $request->getMessageID(),
                        "seamless_transaction_id" => $requestTransaction->TransactionID,
                    ]
                );
        }

        return SlotWebhookService::buildResponse(
            SlotWebhookResponseCode::Success,
            $validator->getAfterBalance(),
            $validator->getBeforeBalance()
        );
    }
}
