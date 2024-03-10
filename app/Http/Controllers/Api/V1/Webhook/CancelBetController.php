<?php

namespace App\Http\Controllers\Api\V1\Webhook;

use App\Enums\SlotWebhookResponseCode;
use App\Enums\TransactionName;
use App\Http\Controllers\Api\V1\Webhook\Traits\UseWebhook;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Slot\SlotWebhookRequest;
use App\Models\Transaction;
use App\Services\Slot\SlotWebhookService;
use App\Services\Slot\SlotWebhookValidator;
use App\Services\WalletService;
use Illuminate\Support\Facades\Log;

class CancelBetController extends Controller
{
    use UseWebhook;

    public function cancelBet(SlotWebhookRequest $request)
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
                    TransactionName::Cancel,
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
