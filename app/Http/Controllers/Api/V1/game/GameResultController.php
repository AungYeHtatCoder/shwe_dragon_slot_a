<?php

namespace App\Http\Controllers\Api\V1\game;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GameResultController extends Controller
{
    public function gameResult(Request $request)
    {
        $operatorCode = Config::get('game.api.operator_code');
        $secretKey = Config::get('game.api.secret_key');
        $requestTime = now()->format('YmdHis');
        $signature = md5($operatorCode . $requestTime . 'gameresult' . $secretKey);
        
        // Assuming that the 'Transactions' input is an array of transactions
        $transactions = $request->input('Transactions', []);
        $currentDateTime = now()->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');

        // Update each transaction's date fields with the current date and time
        $transactions = array_map(function ($transaction) use ($currentDateTime) {
            $transaction['SettlementDate'] = $currentDateTime;
            $transaction['CreatedOn'] = $currentDateTime;
            $transaction['ModifiedOn'] = $currentDateTime;
            return $transaction;
        }, $transactions);

        $data = [
            'MemberName' => $request->input('MemberName'),
            'OperatorCode' => $operatorCode,
            'ProductID' => $request->input('ProductID'),
            'MessageID' => $request->input('MessageID'),
            'RequestTime' => $requestTime,
            'Sign' => $signature,
            'Transactions' => $transactions
        ];
            
        return $data;
        
        
    }
}