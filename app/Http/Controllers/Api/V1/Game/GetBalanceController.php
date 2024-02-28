<?php

namespace App\Http\Controllers\Api\V1\Game;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class GetBalanceController extends Controller
{
    public function getBalance(Request $request)
    {
        $operatorCode = $request->get("OperatorCode");
        $memberName = $request->get("MemberName");
        $requestTime = $request->get("RequestTime");

        $secretKey = config("game.api.secret_key");

        $sign = $request->get("Sign");

        $signature = md5($operatorCode . $requestTime . 'getbalance' . $secretKey);

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
            "Balance" => $member->balance
        ];
    }
}
