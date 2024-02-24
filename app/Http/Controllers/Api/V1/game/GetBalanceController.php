<?php

namespace App\Http\Controllers\Api\V1\game;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class GetBalanceController extends Controller
{
   public function getBalance(Request $request)
    {
        // Retrieve request parameters from the config or request
        $operatorCode = Config::get('game.api.operator_code');
        $secretKey = Config::get('game.api.secret_key');
        $memberName = Auth::user()->user_name; // Assuming you have the user's info

        // Generate the signature
        $requestTime = now()->format('YmdHis');
        // Make sure to use the method name in lowercase as specified
        $methodName = 'getbalance'; // The method name must be in lowercase
        $signature = md5($operatorCode . $requestTime . $methodName . $secretKey);

        // Prepare the data payload
        $data = [
            'MemberName' => $memberName,
            'OperatorCode' => $operatorCode,
            'ProductID' => $request->productId,
            // Assuming ProductID is not required for GetBalance as per your screenshot
            'MessageID' => uniqid(), // Generate a unique message ID
            'RequestTime' => $requestTime,
            'Sign' => $signature,
        ];

        // Define the API endpoint
        $apiUrl = Config::get('game.api.url') . '/Seamless/GetBalance';

        // Send the POST request to the API
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post($apiUrl, $data);

        // Handle the response
        if ($response->successful()) {
            // Process successful response
            return response()->json($response->json());
        }
        Log::info($data);
        // Handle the case where the API request was not successful
        return response()->json([
            'error' => 'API request failed',
            'details' => $response->body()
        ], $response->status());
    }
}