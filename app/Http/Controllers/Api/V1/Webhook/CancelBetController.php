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
        DB::beginTransaction();
        try {
            $validator = $request->check();

            if ($validator->fails()) {
                return $validator->getResponse();
            }

            $before_balance = $request->getMember()->balanceFloat;

            $event = $this->createEvent($request);

            $seamless_transactions = $this->createWagerTransactions($validator->getRequestTransactions(), $event, true);

            foreach ($seamless_transactions as $seamless_transaction) {
                $this->processTransfer(
                    User::adminUser(),
                    $request->getMember(),
                    TransactionName::Cancel,
                    $seamless_transaction->transaction_amount,
                    $seamless_transaction->rate,
                    [
                        "wager_id" => $seamless_transaction->wager_id,
                        "event_id" => $request->getMessageID(),
                        "seamless_transaction_id" => $seamless_transaction->id,
                    ]
                );
            }

            $request->getMember()->wallet->refreshBalance();

            $after_balance = $request->getMember()->balanceFloat;

            DB::commit();

            return SlotWebhookService::buildResponse(
                SlotWebhookResponseCode::Success,
                $after_balance,
                $before_balance
            );
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                "message" => $e->getMessage()
            ]);
        }
    }
}
