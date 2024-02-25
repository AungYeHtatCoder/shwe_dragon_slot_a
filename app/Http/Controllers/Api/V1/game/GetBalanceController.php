<?php

namespace App\Http\Controllers\Api\V1\game;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Exception\JsonException;

class GetBalanceController extends Controller
{
    public function getBalance(Request $request)
    {
        $operatorCode = Config::get('game.api.operator_code');
        $secretKey = Config::get('game.api.secret_key');
        $memberName = Auth::user()->user_name; // Adjust this line if your user model uses a different field for username
        $requestTime = now()->format('YmdHis');
        $methodName = 'getbalance';
        $signature = md5($operatorCode . $requestTime . $methodName . $secretKey);

        // Include 'ProductID' if it's a required parameter based on your API documentation
        $data = [
            'MemberName' => $memberName,
            'OperatorCode' => $operatorCode,
            'ProductID' => $request->input('productId', ''), // Use a default or required value for ProductID
            'MessageID' => uniqid(),
            'RequestTime' => $requestTime,
            'Sign' => $signature,
        ];

        $apiUrl = Config::get('game.api.url') . '/Seamless/GetBalance';

        try {
            // Log the request data
            Log::info('GetBalance request sent', $data);
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post($apiUrl, $data);

            if ($response->successful()) {
                try {
                    $responseData = $response->json(); // Attempt to parse as JSON first
                } catch (JsonException $e) {
                    try {
                        $responseData = simplexml_load_string($response->body()); // Parse as XML if JSON fails
                    } catch (Exception $e) {
                        Log::error('Failed to parse API response as JSON or XML', [
                            'response_body' => $response->body(),
                            'exception' => $e->getMessage(),
                        ]);
                        return response()->json([
                            'error' => 'Invalid API response format',
                        ], 400);
                    }
                }

                return response()->json($responseData);
            } else {
                Log::error('GetBalance API request failed', [
                    'response_status' => $response->status(),
                    'response_body' => $response->body(),
                ]);
                return response()->json([
                    'error' => 'API request failed',
                    'details' => $response->body()
                ], $response->status());
            }
        } catch (\Throwable $e) {
            Log::error('GetBalance request exception', [
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