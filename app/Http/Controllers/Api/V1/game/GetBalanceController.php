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
        $response = Http::withHeaders([
            'Content-Type' => 'application/json; charset=utf-8',
            'Accept' => 'application/json; charset=utf-8',
        ])->post($apiUrl, $data);

        // Log the response for debugging
        Log::info('GetBalance response', ['body' => $response->body(), 'status' => $response->status()]);

        // Check the content type of the response
        $contentType = $response->header('Content-Type');

        if (str_contains($contentType, 'application/json')) {
            // It's JSON
            $responseData = $response->json();
        } elseif (str_contains($contentType, ['text/html', 'application/xml'])) {
            // It's HTML or XML, handle it accordingly
            // For example, parse the XML to get the error message
            $responseData = simplexml_load_string($response->body());
            // Convert SimpleXMLElement object to array for easier handling
            $responseData = json_decode(json_encode($responseData), true);
        } else {
            // Unknown content type
            throw new \Exception('Unknown response content type: ' . $contentType);
        }

        if ($response->successful()) {
            return response()->json($responseData);
        } else {
            return response()->json(['error' => 'API request failed', 'details' => $responseData], $response->status());
        }
    } catch (\Throwable $e) {
        Log::error('GetBalance request exception', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);
        return response()->json(['error' => 'An unexpected error occurred', 'exception' => $e->getMessage()], 500);
    }
    }
}