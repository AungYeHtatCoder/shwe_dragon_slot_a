<?php

namespace App\Http\Controllers\Api\V1\Game;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class PushBetController extends Controller
{
    public function pushBet(Request $request)
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

        $transaction = $request->get("Transactions")[0];

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

        if (Transaction::where("wager_id", $wager_id)->whereNot("game_status", "ongoing")->exists()) {
            return [
                "ErrorCode" => 1003,
                "ErrorMessage" => "Duplicated transaction",
                "Balance" => $after_balance,
                "BeforeBalance" => $member->balance
            ];
        }

        Transaction::where("wager_id", $wager_id)->update([
            "game_status" => $transaction["PayoutAmount"] > 0 ? "win" : "lose"
        ]);

        return [
            "ErrorCode" => 0,
            "ErrorMessage" => "",
            "Balance" => $after_balance,
            "BeforeBalance" => $member->balance
        ];
    }
}
