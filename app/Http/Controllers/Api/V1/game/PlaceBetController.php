<?php

namespace App\Http\Controllers\Api\V1\game;

use App\Models\User;
use App\Models\UserWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
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

        
       // Assuming that 'TransactionAmount' is the amount of money deducted from the balance
        $transactionAmount = $transactions[0]['TransactionAmount']; // Get the transaction amount from the request
        
        // Calculate what the balance should be after the transaction
        $calculatedBalance = $member->balance - $betAmount;

        // Check if the calculated balance matches the balance after the transaction
        if ($calculatedBalance != $member->balance + $transactionAmount) {
            $response = [
                "ErrorCode" => 16,
                "ErrorMessage" => "Balance is incorrect",
                "Balance" => $member->balance,
                "ExpectedBalance" => $calculatedBalance,
                "TransactionAmount" => $transactionAmount
            ];
        }

         $transactionID = $transactions[0]['TransactionID']; // Make sure this matches the actual key in the request

        // Check for duplicate transaction
        if ($this->isDuplicateTransaction($transactionID)) {
            return response()->json([
                "ErrorCode" => 2001, // Use an appropriate error code for duplicates
                "ErrorMessage" => "Duplicate transaction",
                "Balance" => $member->balance
            ]);
        }

        

        return response()->json($response);
    }

     private function isDuplicateTransaction($transactionID)
    {
        return UserWallet::where('TransactionID', $transactionID)->exists();
    }
}