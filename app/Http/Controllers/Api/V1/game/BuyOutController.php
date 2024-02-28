<?php

namespace App\Http\Controllers\Api\V1\Game;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class BuyOutController extends Controller
{
    public function buyOut(Request $request)
    {
        $method =  str(__FUNCTION__)->lower();

        $operatorCode = $request->get("OperatorCode");
        $memberName = $request->get("MemberName");
        $requestTime = $request->get("RequestTime");

        $secretKey = config("game.api.secret_key");

        $sign = $request->get("Sign");

        $signature = md5($operatorCode . $requestTime . $method . $secretKey);

        if ($sign !== $signature) {
            return response()->json([
                "ErrorCode" => 1004,
                "ErrorMessage" => "Wrong Sign"
            ]);
        }

        $member = User::where("user_name", $memberName)->first();

        if (!$member) {
            return response()->json([
                "ErrorCode" => 1002,
                "ErrorMessage" => "Member not found"
            ]);
        }

        $transaction = $request->get("Transaction");

        $after_balance = $member->balance + $transaction["TransactionAmount"];

        if ($after_balance < 0) {
            return [
                "ErrorCode" => 1001,
                "ErrorMessage" => "Insufficient Balance",
                "Balance" => $after_balance,
                "BeforeBalance" => $member->balance
            ];
        }

        $wager_id = $transaction["WagerID"] ?: null;

        if ($wager_id && !Transaction::where("wager_id", $wager_id)->exists()) {
            return [
                "ErrorCode" => 1006,
                "ErrorMessage" => "Wager Not Found",
                "Balance" => $after_balance,
                "BeforeBalance" => $member->balance
            ];
        }

        if (Transaction::where("external_transaction_id", $transaction["TransactionID"])->exists()) {
            return [
                "ErrorCode" => 1003,
                "ErrorMessage" => "Duplicate Transaction",
                "Balance" => $after_balance,
                "BeforeBalance" => $member->balance
            ];
        }

        Transaction::create([
            "user_id" => $member->id,
            "external_transaction_id" => $transaction["TransactionID"],
            "wager_id" => $wager_id
        ]);

        return [
            "ErrorCode" => 0,
            "ErrorMessage" => "",
            "Balance" => $after_balance,
            "BeforeBalance" => $member->balance
        ];
    }
}
