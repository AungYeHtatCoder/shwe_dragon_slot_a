<?php
namespace App\Http\Controllers\Api\V1\game;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class TransactionController extends Controller
{
    public function createTransaction(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'MemberID' => 'required|numeric',
            'OperatorID' => 'required|numeric',
            'ProductID' => 'required|numeric',
            'ProviderID' => 'required|numeric',
            'CurrencyID' => 'required|numeric',
            'GameType' => 'required|numeric',
            'BetAmount' => 'required|numeric',
            'TransactionAmount' => 'required|numeric',
            // ... include other fields based on the model shown in the image
        ]);

        // Prepare the data payload
        $data = [
            'MemberID' => $validated['MemberID'],
            'OperatorID' => $validated['OperatorID'],
            'ProductID' => $validated['ProductID'],
            'ProviderID' => $validated['ProviderID'],
            'CurrencyID' => $validated['CurrencyID'],
            'GameType' => $validated['GameType'],
            'BetAmount' => $validated['BetAmount'],
            'TransactionAmount' => $validated['TransactionAmount'],
            // ... and so on for each required field
            // Assuming GameID, GameRoundID, and other nullable fields are not required
        ];

        // Generate the signature if necessary
        $operatorCode = Config::get('game.api.operator_code');
        $requestTime = now()->format('YmdHis');
        $secretKey = Config::get('game.api.secret_key');
        $signature = md5($operatorCode . $requestTime . $secretKey);

        $data['Sign'] = $signature;
        $data['RequestTime'] = $requestTime;

        // API endpoint from the config
        $apiUrl = Config::get('game.api.url') . '/Seamless/Transaction';

        try {
            // Send the POST request to the API
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post($apiUrl, $data);

            // Log the request and response for debugging
            Log::info('Transaction request sent:', $data);
            Log::info('Transaction response received:', $response->json());

            if ($response->successful()) {
                // Return the successful response
                return $response->json();
            } else {
                // Handle errors from the API
                return response()->json(['error' => 'API request failed', 'details' => $response->body()], $response->status());
            }
        } catch (\Throwable $e) {
            // Handle exceptions
             Log::error('Error making API call: ' . $e->getMessage());
        return response()->json(['error' => 'An unexpected error occurred', 'exception' => $e->getMessage()], 500);
        }
    }
}