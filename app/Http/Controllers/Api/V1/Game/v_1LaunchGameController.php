<?php

namespace App\Http\Controllers\Api\V1\Game;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LaunchGameController extends Controller
{
    public function launchGame(Request $request)
{
    // Replace these with actual values you receive from the request or configuration
    $user = Auth::user();
    $operatorCode = 'E680'; // From your provided details
    $secretKey = 'ljfVJA'; // From your provided details
    $memberName = $user->name; // This should come from the request or your application logic
    $displayName = $user->name ?? 'DefaultDisplayName'; // Example default or from request
    $playerPassword = $request->password; // Player's password if required
    //$gameId = $request->gameId; // Unique game ID, from request or your system
    //$providerGameType = $request->providerGameType; // From request or your system
    $productId = $request->productId; // Your provided product ID, change if needed
    $gameType = $request->gameType; // Game type, from request or your system
    $languageCode = $request->languageCode ?? 1; // Default or from request
    $platform = $request->platform ?? 0; // Default platform code or from request
    $ipAddress = $request->ip(); // IP address of the player

    // Construct the signature as per the API's requirements
    $requestTime = now()->format('YmdHis');
    $methodName = 'launchgame'; // This should match the case and spelling as per API's requirement
    $signature = md5($operatorCode . $requestTime . $methodName . $secretKey);

    // API endpoint
    $apiUrl = 'https://swmd.6633663.com/Seamless/LaunchGame';

    // Prepare the data payload
    $data = [
        'OperatorCode' => $operatorCode,
        'MemberName' => $memberName,
        'DisplayName' => $displayName,
        'Password' => $playerPassword,
        //'GameID' => $gameId,
       // 'ProviderGameType' => $providerGameType,
        'ProductID' => $productId,
        'GameType' => $gameType,
        'LanguageCode' => $languageCode,
        'Platform' => $platform,
        'IPAddress' => $ipAddress,
        'Sign' => $signature,
        'RequestTime' => $requestTime,
        // Include additional parameters as required by the API
    ];

    // Send the POST request to the API
    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
    ])->post($apiUrl, $data);

    // Handle the response
    if ($response->successful()) {
        // Process successful response
        return $response->json(); // or however you want to return the response
    } else {
        // Handle error, log it or return a custom error message
        return response()->json(['error' => 'API request failed', 'details' => $response->body()], 500);
    }
}
}