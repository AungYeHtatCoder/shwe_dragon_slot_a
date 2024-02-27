<?php

namespace App\Http\Controllers\Api\V1\game;

use App\Models\User;
use App\Models\PlaceBet;
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

        if(isset($member))
        {
            // Create a new transaction in the UserWallet
    $transaction = new UserWallet([
        'user_id' => '3', // Assuming you have the user's ID stored in $userId
        'MemberID' => $transactions[0]['MemberID'],
        'OperatorID' => $transactions[0]['OperatorID'],
        'ProductID' => $transactions[0]['ProductID'],
        'ProviderID' => $transactions[0]['ProviderID'],
        'ProviderLineID' => $transactions[0]['ProviderLineID'],
        'WagerID' => $transactions[0]['WagerID'],
        'CurrencyID' => $transactions[0]['CurrencyID'],
        'GameType' => $transactions[0]['GameType'],
        'GameID' => $transactions[0]['GameID'],
        'GameRoundID' => $transactions[0]['GameRoundID'],
        'ValidBetAmount' => $transactions[0]['ValidBetAmount'],
        'BetAmount' => $transactions[0]['BetAmount'],
        'TransactionAmount' => $transactions[0]['TransactionAmount'],
        'PayoutAmount' => $transactions[0]['PayoutAmount'],
        'PayoutDetail' => $transactions[0]['PayoutDetail'],
        'CommisionAmount' => $transactions[0]['CommissionAmount'], // Correct the spelling here if it's a typo
        'JackpotAmount' => $transactions[0]['JackpotAmount'],
        'SettlementDate' => $transactions[0]['SettlementDate'], // Make sure the format matches your database column format
        'JPBet' => $transactions[0]['JPBet'],
        'Status' => $transactions[0]['Status'],
        //'CreatedOn' => $transactions[0]['CreatedOn'], // Or use now() if you want to set it to the current timestamp
        'CreatedOn' => now(),

        'ModifiedOn' => now() // Or use now() if you want to set it to the current timestamp
    ]);

    $transaction->save();

    // Create a new place bet record
    $placeBet = new PlaceBet([
        'MemberName' => $request->input("MemberName"),
        'OperatorCode' => $request->input("OperatorCode"),
        'ProductID' => $request->input("ProductID"),
        'MessageID' => $request->input("MessageID"),
        'RequestTime' => $request->input("RequestTime"), // Make sure the format matches your database column format
        'Sign' => $request->input("Sign"),
        'TransactionID' => $transaction->id // The id of the UserWallet transaction is saved in the TransactionID field
    ]);

    $placeBet->save();
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

        // Assuming $transactions[0] contains the transaction details from your provided JSON

        
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