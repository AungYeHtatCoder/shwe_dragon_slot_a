<?php

namespace App\Http\Controllers\Api\V1\game;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class RollbackController extends Controller
{
    public function rollback(Request $request)
    {
        $operatorCode = Config::get('game.api.operator_code');
        $secretKey = Config::get('game.api.secret_key');
        $requestTime = now()->format('YmdHis');
        
        // Generate the signature as per your API documentation
        $methodName = 'rollback'; // Ensure this is the correct method name expected by the API
        $signature = md5($operatorCode . $requestTime . $methodName . $secretKey);
        
        // Construct the request payload as per the API documentation
        $data = [
            'MemberName' => $request->input('MemberName'),
            'OperatorCode' => $operatorCode,
            'ProductID' => $request->input('ProductID'),
            'MessageID' => $request->input('MessageID'),
            'RequestTime' => $requestTime,
            'Sign' => $signature,
            'Transactions' => $request->input('Transactions', [])
        ];

        //$apiUrl = Config::get('game.api.url') . '/Seamless/Rollback';
        $apiUrl = 'https://swmd.6633663.com/Seamless/Rollback';
        try {
            Log::info('Rollback request sent', $data);
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post($apiUrl, $data);

            Log::info('Rollback response received', ['body' => $response->body(), 'status' => $response->status()]);

            if ($response->successful()) {
                return response()->json($response->json());
            } else {
                Log::error('Rollback API request failed', [
                    'response_status' => $response->status(),
                    'response_body' => $response->body(),
                ]);
                return response()->json([
                    'error' => 'API request failed',
                    'details' => $response->body()
                ], $response->status());
            }
        } catch (\Throwable $e) {
            Log::error('Rollback request exception', [
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