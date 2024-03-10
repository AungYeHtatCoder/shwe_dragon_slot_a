<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = User::first();

        $base_url = config('game.api.url');

        $operatorCode = config('game.api.operator_code');
        $secretKey = config('game.api.secret_key');
        $requestTime = now()->format('YmdHis');
        $signature = md5($operatorCode . $requestTime . 'launchgame' . $secretKey);

        $game_list_data = [
            "OperatorCode" => $operatorCode,
            "MemberName" => "tak",
            "DisplayName" => "tak",
            "Password" => "password",
            // "GameID" => 1, ignore
            "ProductID" => 1009,
            "GameType" => 1,
            "LanguageCode" => 1,
            "Platform" => 0,
            "Sign" => $signature,
            "RequestTime" => $requestTime
        ];

        $launch_data = [
            "OperatorCode" => $operatorCode,
            "MemberName" => "tak",
            "DisplayName" => "tak",
            "Password" => "password",
            "GameID" => 1,
            "ProviderGameType" =>1,
            "ProductID" => 1009,
            "GameType" => 1,
            "LanguageCode" => 1,
            "Platform" => 0,
            "OperatorLobbyURL" => "www.google.com",
            "Sign" => $signature,
            "RequestTime" => $requestTime
        ];

        return json_encode($launch_data);
    }
}
