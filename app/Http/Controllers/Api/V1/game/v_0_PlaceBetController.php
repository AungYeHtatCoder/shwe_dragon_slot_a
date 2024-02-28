<?php
namespace App\Http\Controllers\Api\V1\Game;

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
        
        $transactions = $request->input("Transactions");
        if (empty($transactions)) {
            return response()->json(['ErrorCode' => 1006, 'ErrorMessage' => 'Transactions data missing'], 400);
        }
        
        $transactionData = $transactions[0]; // For simplicity, considering only the first transaction
        
        $user = User::where("user_name", $request->input("MemberName"))->first();
        
        if (!$user) {
            return response()->json(['ErrorCode' => 1001, 'ErrorMessage' => 'User not found'], 404);
        }
        
        if ($user->balance < $transactionData['BetAmount']) {
            return response()->json(['ErrorCode' => 1002, 'ErrorMessage' => 'Insufficient balance'], 400);
        }
        
        // Check for duplicate transaction
        if (UserWallet::where('TransactionID', $transactionData['TransactionID'])->exists()) {
            // Handle duplicate transaction
            return response()->json(['ErrorCode' => 2001, 'ErrorMessage' => 'Duplicate transaction'], 409);
        }
        
        // Create UserWallet transaction
        //$userWalletTransaction = $user->userWallet();
        $userWalletTransaction = UserWallet::create([
        'user_id' => '3',
        'wallet' => $user->balance - $transactionData['TransactionAmount'], 
        'MemberID' => $transactionData['MemberID'],
        'OperatorID' => $transactionData['OperatorID'],
        'ProductID' => $transactionData['ProductID'],
        'ProviderID' => $transactionData['ProviderID'],
        'ProviderLineID' => $transactionData['ProviderLineID'],
        'WagerID' => $transactionData['WagerID'],
        'CurrencyID' => $transactionData['CurrencyID'],
        'GameType' => $transactionData['GameType'],
        'GameID' => $transactionData['GameID'],
        'GameRoundID' => $transactionData['GameRoundID'],
        'ValidBetAmount' => $transactionData['ValidBetAmount'],
        'BetAmount' => $transactionData['BetAmount'],
        'TransactionAmount' => $transactionData['TransactionAmount'],
        'TransactionID', $transactionData['TransactionID'],
        'PayoutAmount' => $transactionData['PayoutAmount'],
        'PayoutDetail' => $transactionData['PayoutDetail'],
        'CommisionAmount' => $transactionData['CommissionAmount'], 
        'JackpotAmount' => $transactionData['JackpotAmount'],
        //'SettlementDate' => $transactionData['SettlementDate'],
        'SettlementDate' => now(), 
        'JPBet' => $transactionData['JPBet'],
        'Status' => $transactionData['Status'],
        'CreatedOn' => now(),
        'ModifiedOn' => now()
        ]);
        
        $placeBet = new PlaceBet([
            'MemberName' => $request->input("MemberName"),
            'OperatorCode' => $request->input("OperatorCode"),
            'ProductID' => $request->input("ProductID"),
            'MessageID' => $request->input("MessageID"),
            'RequestTime' => $request->input("RequestTime"), 
            'Sign' => $request->input("Sign"),
            'user_wallet_id' => $userWalletTransaction->id
        ]);
        $placeBet->save();
        
        // Update user's balance
        $user->balance -= $transactionData['BetAmount'];
        $user->save();
        
        // Return successful response
        return response()->json(['ErrorCode' => 0, 'ErrorMessage' => 'what happend', 'Balance' => $user->balance]);
    }
}