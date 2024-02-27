<?php
namespace App\Http\Controllers\Api\V1\game;

use App\Models\User;
use App\Models\PlaceBet;
use App\Models\UserWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Support\Facades\Config;

class PlaceBetController extends Controller
{
    public function placeBet(Request $request)
    {
        $operatorCode = $request->input("OperatorCode");
        $memberName = $request->get("MemberName");
        $requestTime = $request->input("RequestTime");
        $secretKey = config("game.api.secret_key");
        $sign = $request->input("Sign");
        $signature = md5($operatorCode . $requestTime . 'placebet' . $secretKey);
        if ($sign !== $signature) {
            return response()->json([
                "ErrorCode" => 1004,
                "ErrorMessage" => "Wrong Sign",
                "Balance" => 0
            ]);
        }

        $member = User::where("user_name", $memberName)->first();

        $transaction = $request->get("Transactions")[0];

        $after_balance = $member->balance - $transaction["BetAmount"];

        if ($after_balance < 0) {
            return [
                "ErrorCode" => 1001,
                "ErrorMessage" => "Insufficient Balance",
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
