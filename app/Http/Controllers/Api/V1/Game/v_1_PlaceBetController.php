<?php

namespace App\Http\Controllers\Api\V1\Game;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class PlaceBetController extends Controller
{
    public function placeBet(Request $request)
    {
        $operatorCode = $request->get("OperatorCode");
        $memberName = $request->get("MemberName");
        $requestTime = $request->get("RequestTime");

        $secretKey = config("game.api.secret_key");

        $sign = $request->get("Sign");

        $signature = md5($operatorCode . $requestTime . 'placebet' . $secretKey);

        if ($sign !== $signature) {
            return [
                "ErrorCode" => 1004,
                "ErrorMessage" => "Wrong Sign",
                "Balance" => 0
            ];
        }

        $member = User::where("user_name", $memberName)->first();

        return [
            "ErrorCode" => 0,
            "ErrorMessage" => "",
            "Balance" => $member->balance - $request->get("Transactions")["BetAmount"]
        ];
    }
}