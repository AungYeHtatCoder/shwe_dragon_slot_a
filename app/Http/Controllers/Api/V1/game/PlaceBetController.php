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
        $transactions = $request->input('Transactions', []);

        $requestTime = now()->format('YmdHis');
        $signature = md5($operatorCode . $requestTime . 'placebet' . $secretKey);

        // Construct the body of the request as per the API documentation
        $data = [
            'MemberName' => $request->input('MemberName'),
            'OperatorCode' => $operatorCode,
            'ProductID' => $request->input('ProductID'),
            'MessageID' => $request->input('MessageID'),
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

            // Check the content type and log the raw response for debugging
            $contentType = $response->header('Content-Type');
            Log::info('PlaceBet response headers', ['headers' => $response->headers()]);
            Log::info('PlaceBet raw response body', ['body' => $response->body()]);

            if ($response->successful()) {
                return response()->json($response->json());
            } else {
                Log::error('PlaceBet API request failed', [
                    'url' => $apiUrl,
                    'response_status' => $response->status(),
                    'response_headers' => $response->headers(),
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