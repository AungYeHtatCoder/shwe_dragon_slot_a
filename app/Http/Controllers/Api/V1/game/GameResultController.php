<?php

namespace App\Http\Controllers\Api\V1\game;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class GameResultController extends Controller
{
    public function gameResult(Request $request)
    {
        $operatorCode = Config::get('game.api.operator_code');
        $secretKey = Config::get('game.api.secret_key');        
        $transactions = $request->input('Transactions', []);
        $data = [
            'MemberName' => $request->input('MemberName'),
            'OperatorCode' => $operatorCode,
            'ProductID' => $request->input('ProductID'),
            'MessageID' => $request->input('MessageID'),
            'RequestTime' => $request->RequestTime,
            'Sign' => $request->input('Sign'),
            'Transactions' => $transactions
        ];

        $apiUrl = Config::get('game.api.url') . '/Seamless/GameResult';

        try {
            Log::info('GameResult request sent', $data);
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post($apiUrl, $data);

            Log::info('GameResult response received', ['body' => $response->body(), 'status' => $response->status()]);

            if ($response->successful()) {
                return response()->json($response->json());
            } else {
                Log::error('GameResult API request failed', [
                    'response_status' => $response->status(),
                    'response_body' => $response->body(),
                ]);
                return response()->json([
                    'error' => 'API request failed',
                    'details' => $response->body()
                ], $response->status());
            }
        } catch (\Throwable $e) {
            Log::error('GameResult request exception', [
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