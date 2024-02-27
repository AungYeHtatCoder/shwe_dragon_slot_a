<?php

namespace App\Http\Controllers\Api\V1\game;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Config;

class PlaceBetController extends Controller
{
    public function placeBet(Request $request)
    {
        $operatorCode = $request->input("OperatorCode");
        $memberName = $request->input("MemberName");
        $requestTime = $request->input("RequestTime");
        $transactions = $request->input("Transactions");
        $betAmount = $transactions[0]['BetAmount']; // Assuming 'Transactions' is an array and we're interested in the first one.

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

        if (!$member) {
            return response()->json([
                "ErrorCode" => 1001,
                "ErrorMessage" => "User not found",
                "Balance" => 0
            ]);
        }

        // Check if member has enough balance
        if ($member->balance < $betAmount) {
            return response()->json([
                "ErrorCode" => 1001,
                "ErrorMessage" => "Insufficient balance",
                "Balance" => $member->balance
            ]);
        }

        // Deduct bet amount from member's balance and save
        $member->balance -= $betAmount;
        $member->save();

        // Return the successful response
        return response()->json([
            "ErrorCode" => 0,
            "ErrorMessage" => "",
            "Balance" => $member->balance
        ]);

        
        // Check if the expected balance matches the calculated balance
        $expectedBalance = $request->get("Transactions")['TransactionAmount']; // Assuming 'Balance' is sent within the transaction data.

        // Calculate what the new balance should be
        //$newBalance = $member->balance - $betAmount;

        if ($expectedBalance > $betAmount) {
            return response()->json([
                "ErrorCode" => 16,
                "ErrorMessage" => "Balance is incorrect",
                //"Balance" => $member->balance
                "Balance" => $request->get("Transactions")["TransactionAmount"]

            ]);
        }
    }
}