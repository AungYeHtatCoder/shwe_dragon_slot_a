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
use App\Services\Slot\SlotWebhookService;
use App\Services\Slot\SlotWebhookValidator;
use App\Services\WalletService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class GameResultController extends Controller
{
    use UseWebhook;

    public function gameResult(SlotWebhookRequest $request)
    {
        DB::beginTransaction();
        try {
            $validator = $request->check();

            if ($validator->fails()) {
                return $validator->getResponse();
            }

            $before_balance = $request->getMember()->balanceFloat;

            $event = $this->createEvent($request);

            $seamless_transactions = $this->createWagerTransactions($validator->getRequestTransactions(), $event);

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
                    TransactionName::Payout,
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
