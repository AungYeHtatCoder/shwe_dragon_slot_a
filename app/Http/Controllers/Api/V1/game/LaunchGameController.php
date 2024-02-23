<?php
namespace App\Http\Controllers\Api\V1\game;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LaunchGameController extends Controller
{
    public function launchGame(Request $request)
    {
        //Log::info($request->all());
        // Validate the request data
        $validatedData = $request->validate([
            'productId' => 'required|integer',
            'gameType' => 'required|integer',
            'languageCode' => 'integer',
            'platform' => 'integer',
            'password' => 'required|string',
            // Add other validation rules as necessary
        ]);

        // Retrieve user and configuration settings
        $user = Auth::user();
        $operatorCode = Config::get('game.api.operator_code');
        $secretKey = Config::get('game.api.secret_key');
        $apiUrl = Config::get('game.api.url') . '/Seamless/LaunchGame';

        // Generate the signature
        $requestTime = now()->format('YmdHis');
        $signature = md5($operatorCode . $requestTime . 'launchgame' . $secretKey);

        // Prepare the payload
        $data = [
            'OperatorCode' => $operatorCode,
            'MemberName' => $user->user_name, // Assume username is the member identifier
            'DisplayName' => $validatedData['displayName'] ?? $user->name,
            'Password' => $validatedData['password'],
            'ProductID' => $validatedData['productId'],
            'GameType' => $validatedData['gameType'],
            'LanguageCode' => $validatedData['languageCode'] ?? 1,
            'Platform' => $validatedData['platform'] ?? 0,
            'IPAddress' => $request->ip(),
            'Sign' => $signature,
            'RequestTime' => $requestTime,
        ];

        // Log the request details
        //Log::info('Sending launch game request', $data);

        try {
            // Send the request
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post($apiUrl, $data);

            // Log the response from the server
            // Log::info('Received response from launch game request', [
            //     'response' => $response->json(),
            //     'status' => $response->status()
            // ]);

            if ($response->successful()) {
                return $response->json();
            }

             // Log the full response
            // Log::info('API response', [
            //     'status' => $response->status(),
            //     'headers' => $response->headers(),
            //     'body' => $response->json(),
            // ]);

            return response()->json(['error' => 'API request failed', 'details' => $response->body()], $response->status());
        } catch (\Throwable $e) {
            // Log the exception
            // Log::error('Launch game request failed', [
            //     'exception' => $e->getMessage(),
            //     'trace' => $e->getTraceAsString() // Optionally log the stack trace
            // ]);

            return response()->json(['error' => 'An unexpected error occurred', 'exception' => $e->getMessage()], 500);
        }
    }

    public function getGameList(Request $request)
{
    // Validate the request data
    $validatedData = $request->validate([
        'memberName' => 'required|string', // Must be provided by the client
        'productId' => 'required|integer',
        'gameType' => 'required|integer',
        'languageCode' => 'required|integer',
        'platform' => 'required|integer',
        // Additional validation rules...
    ]);

    // Retrieve user and configuration settings
    $operatorCode = Config::get('game.api.operator_code');
    $secretKey = Config::get('game.api.secret_key');
    $apiUrl = Config::get('game.api.url') . '/Seamless/GetGameList';

    // Generate the signature
    $requestTime = now()->format('YmdHis');
    $signature = md5($operatorCode . $validatedData['memberName'] . $requestTime . $secretKey);

    // Prepare the payload
    $data = [
        'OperatorCode' => $operatorCode,
        'MemberName' => $validatedData['memberName'],
        'ProductID' => $validatedData['productId'],
        'GameType' => $validatedData['gameType'],
        'LanguageCode' => $validatedData['languageCode'],
        'Platform' => $validatedData['platform'],
        'IPAddress' => $request->ip(),
        'Sign' => $signature,
        'RequestTime' => $requestTime,
    ];

    // Send the request
    try {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post($apiUrl, $data);

        // Handle the response
        if ($response->successful()) {
            return $response->json();
        }

        return response()->json(['error' => 'API request failed', 'details' => $response->body()], $response->status());
    } catch (\Throwable $e) {
        // Log and handle any exceptions
        Log::error('Error making API call: ' . $e->getMessage());
        return response()->json(['error' => 'An unexpected error occurred', 'exception' => $e->getMessage()], 500);
    }
}


}

    // public function launchGame(Request $request)
    // {
    //     $user = Auth::user();

    //     // Retrieve configuration values
    //     //$operatorCode = config('game.api.operator_code');
    //     $operatorCode = 'E680'; //
    //     //$secretKey = config('game.api.secret_key');
    //     $secretKey = 'ljfVJA'; // From your provided details
    //     //$apiUrl = config('game.api.url') . '/Seamless/LaunchGame';
    //     $apiUrl = 'https://swmd.6633663.com/Seamless/LaunchGame';

    //     // Get request data with default values where necessary
    //     $displayName = $user->name ?? 'DefaultDisplayName';
    //     $productId = $request->productId;
    //     $gameType = $request->gameType;
    //     $languageCode = $request->languageCode;
    //     $platform = $request->platform;
    //     $ipAddress = $request->ip();

    //     // Generate the signature
    //     $requestTime = now()->format('YmdHis');
    //     $methodName = 'launchgame';
    //     $signature = md5($operatorCode . $requestTime . $methodName . $secretKey);

    //     // Prepare the data payload
    //     $data = [
    //         'OperatorCode' => $operatorCode,
    //         'MemberName' => $user->user_name, 
    //         'DisplayName' => $displayName,
    //         'Password' => $request->password, // Ensure this is sent securely over HTTPS
    //         'ProductID' => $productId,
    //         'GameType' => $gameType,
    //         'LanguageCode' => $languageCode,
    //         'Platform' => $platform,
    //         'IPAddress' => $ipAddress,
    //         'Sign' => $signature,
    //         'RequestTime' => $requestTime,
    //     ];

    //     // Validate the request data
    //     $validatedData = $request->validate([
    //         'password' => 'required|string',
    //         // Add other validation rules as necessary
    //     ]);

    //     try {
    //         // Send the POST request to the API
    //         $response = Http::withHeaders([
    //             'Content-Type' => 'application/json',
    //             'Accept' => 'application/json',
    //         ])->post($apiUrl, $data);

    //         // Check for successful response
    //         if ($response->successful()) {
    //             return $response->json();
    //         }

    //         // Handle API errors
    //         $errorDetails = $response->json();
    //         $errorCode = $response->status();
    //         $errorMsg = $errorDetails['message'] ?? 'API request failed with no error message.';
            
    //         return response()->json(['error' => $errorMsg, 'details' => $errorDetails], $errorCode);
    //     } catch (\Throwable $e) {
    //         // Handle exceptions
    //         return response()->json(['error' => 'An unexpected error occurred', 'exception' => $e->getMessage()], 500);
    //     }
    // }