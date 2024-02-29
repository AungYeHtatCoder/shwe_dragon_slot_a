<?php

namespace App\Http\Controllers\Api\V1\Game;

use App\Enums\SlotWebhookResponseCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Slot\SlotWebhookRequest;
use App\Models\Transaction;
use App\Models\User;
use App\Services\Slot\SlotWebhookService;
use App\Services\Slot\SlotWebhookValidator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class RollbackController extends Controller
{
    public function rollback(SlotWebhookRequest $request)
    {
        $validator = SlotWebhookValidator::make($request)->validate();

        if ($validator->fails()) {
            return $validator->getResponse();
        }

        foreach($validator->getRequestTransactions() as $requestTransaction){
            Transaction::create([
                "user_id" => $validator->getMember()->id,
                "external_transaction_id" => $requestTransaction->TransactionID,
                "wager_id" => $requestTransaction->WagerID
            ]);
        }

        return SlotWebhookService::buildResponse(
            SlotWebhookResponseCode::Success,
            $validator->getAfterBalance(),
            $validator->getBeforeBalance()
        );
    }
}
