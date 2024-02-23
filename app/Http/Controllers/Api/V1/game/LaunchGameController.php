<?php

namespace App\Http\Controllers\Api\V1\game;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class LaunchGameController extends Controller
{
    // complete refactored code
    public function launchGame(Request $request)
    {
        $user = Auth::user();

        // Retrieve configuration values
        $operatorCode = config('game.api.operator_code');
        $secretKey = config('game.api.secret_key');
        $apiUrl = config('game.api.url') . '/Seamless/LaunchGame';

        // Get request data with default values where necessary
        $displayName = $user->name ?? 'DefaultDisplayName';
        $productId = $request->input('productId', config('game.default_product_id', 'default-product-id'));
        $gameType = $request->input('gameType', 1);
        $languageCode = $request->input('languageCode', 1);
        $platform = $request->input('platform', 0);
        $ipAddress = $request->ip();

        // Generate the signature
        $requestTime = now()->format('YmdHis');
        $methodName = 'launchgame';
        $signature = md5($operatorCode . $requestTime . $methodName . $secretKey);

        // Prepare the data payload
        $data = [
            'OperatorCode' => $operatorCode,
            'MemberName' => $user->user_name, 
            'DisplayName' => $displayName,
            'Password' => $request->password, // Ensure this is sent securely over HTTPS
            'ProductID' => $productId,
            'GameType' => $gameType,
            'LanguageCode' => $languageCode,
            'Platform' => $platform,
            'IPAddress' => $ipAddress,
            'Sign' => $signature,
            'RequestTime' => $requestTime,
        ];

        // Validate the request data
        $validatedData = $request->validate([
            'password' => 'required|string',
            // Add other validation rules as necessary
        ]);

        try {
            // Send the POST request to the API
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post($apiUrl, $data);

            // Check for successful response
            if ($response->successful()) {
                return $response->json();
            }

            // Handle API errors
            $errorDetails = $response->json();
            $errorCode = $response->status();
            $errorMsg = $errorDetails['message'] ?? 'API request failed with no error message.';
            
            return response()->json(['error' => $errorMsg, 'details' => $errorDetails], $errorCode);
        } catch (\Throwable $e) {
            // Handle exceptions
            return response()->json(['error' => 'An unexpected error occurred', 'exception' => $e->getMessage()], 500);
        }
    }
}