<?php

namespace App\Http\Controllers\Api\V1\Webhook;

use App\Enums\SlotWebhookResponseCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\Slot\SlotWebhookRequest;
use App\Services\Slot\SlotWebhookService;
use App\Services\Slot\SlotWebhookValidator;
use Illuminate\Support\Facades\DB;

class GetBalanceController extends Controller
{
    public function getBalance(SlotWebhookRequest $request)
    {
        DB::beginTransaction();
        try {
            $validator = SlotWebhookValidator::make($request)->validate();

            if ($validator->fails()) {
                return $validator->getResponse();
            }

            $balance = $request->getMember()->balanceFloat;

            DB::commit();

            return SlotWebhookService::buildResponse(
                SlotWebhookResponseCode::Success,
                $balance,
                $balance
            );
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                "message" => $e->getMessage()
            ]);
        }
    }
}
