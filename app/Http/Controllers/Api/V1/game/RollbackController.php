<?php

namespace App\Http\Controllers\Api\V1\game;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class RollbackController extends Controller
{
    public function rollback(Request $request)
    {
        $operatorCode = $request->input("OperatorCode");
        $memberName = $request->get("MemberName");
        $requestTime = $request->input("RequestTime");
        $secretKey = config("game.api.secret_key");
        $sign = $request->input("Sign");
        $signature = md5($operatorCode . $requestTime . 'rollback' . $secretKey);
        if ($sign !== $signature) {
            return response()->json([
                "ErrorCode" => 1004,
                "ErrorMessage" => "Wrong Sign",
                "Balance" => 0
            ]);
        }

        $transaction = $request->get("Transactions")[0];

        $member = User::where("user_name", $memberName)->first();
        $after_balance = $member->balance + $transaction["TransactionAmount"];

        if ($after_balance < 0) {
            return [
                "ErrorCode" => 1001,
                "ErrorMessage" => "Insufficient Balance",
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
