<?php

namespace App\Http\Controllers\Api\V1\game;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class PlaceBetController extends Controller
{
    public function placeBet(Request $request)
    {
        $operatorCode = Config::get('game.api.operator_code');
        $secretKey = Config::get('game.api.secret_key');
        
        // Extract or construct the transaction details as required by your API
        $transactions = $request->input('Transactions', []); // Ensure this matches the structure expected by your API

        $requestTime = now()->format('YmdHis');
        $signature = md5($operatorCode . $requestTime . 'placebet' . $secretKey);

        // Construct the body of the request as per the API documentation
        $data = [
            'MemberName' => $transactions[0]['MemberName'], // Example, adjust as needed
            'OperatorCode' => $operatorCode,
            'ProductID' => $transactions[0]['ProductID'], // Example, adjust as needed
            'MessageID' => $transactions[0]['MessageID'], // Example, adjust as needed
            'RequestTime' => $requestTime,
            'Sign' => $signature,
            'Transactions' => $transactions
        ];

        $apiUrl = Config::get('game.api.url') . '/Seamless/PlaceBet';

        try {
            Log::info('PlaceBet request sent', $data);
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post($apiUrl, $data);

            Log::info('PlaceBet response received', ['body' => $response->body(), 'status' => $response->status()]);

            if ($response->successful()) {
                return response()->json($response->json());
            } else {
                Log::error('PlaceBet API request failed', [
                    'response_status' => $response->status(),
                    'response_body' => $response->body(),
                ]);
                return response()->json([
                    'error' => 'API request failed',
                    'details' => $response->body()
                ], $response->status());
            }
        } catch (\Throwable $e) {
            Log::error('PlaceBet request exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json([
                'error' => 'An unexpected error occurred',
                'exception' => $e->getMessage()
            ], 500);
        }
    }
}