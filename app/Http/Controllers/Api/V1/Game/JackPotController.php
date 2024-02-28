<?php

namespace App\Http\Controllers\Api\V1\Game;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class JackPotController extends Controller
{
    public function JackPot(Request $request)
    {
        $method =  str(__FUNCTION__)->lower();
        $operatorCode = $request->get("OperatorCode");
        $memberName = $request->get("MemberName");
        $requestTime = $request->get("RequestTime");

        $secretKey = config("game.api.secret_key");

        $sign = $request->get("Sign");

        // return $operatorCode . $requestTime . 'gameresult' . $secretKey;

        $signature = md5($operatorCode . $requestTime . $method . $secretKey);

        if ($sign !== $signature) {
            return [
                "ErrorCode" => 1004,
                "ErrorMessage" => "Wrong Sign",
                "Balance" => 0
            ];
        }

        $member = User::where("user_name", $memberName)->first();

        $transaction = $request->get("Transactions")[0];

        $after_balance = $member->balance + $transaction["TransactionAmount"];

        if(Transaction::where("external_transaction_id", $transaction["TransactionID"])->exists()){
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
            "wager_id" => $transaction["WagerID"]
        ]);

        return [
            "ErrorCode" => 0,
            "ErrorMessage" => "",
            "Balance" => $after_balance,
            "BeforeBalance" => $member->balance
        ];
    }
}
