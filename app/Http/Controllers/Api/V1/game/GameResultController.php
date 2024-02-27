<?php

namespace App\Http\Controllers\Api\V1\game;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GameResultController extends Controller
{
    public function gameResult(Request $request)
    {
        $operatorCode = $request->get("OperatorCode");
        $memberName = $request->get("MemberName");
        $requestTime = $request->get("RequestTime");

        $secretKey = config("game.api.secret_key");

        $sign = $request->get("Sign");

        $signature = md5($operatorCode . $requestTime . 'gameresult' . $secretKey);

        if ($sign !== $signature) {
            return [
                "ErrorCode" => 1004,
                "ErrorMessage" => "Wrong Sign",
                "Balance" => 0
            ];
        }

        $member = User::where("user_name", $memberName)->first();

        $after_balance = $member->balance - $request->get("Transactions")[0]["TransactionAmount"];

        if ($after_balance < 0) {
            return [
                "ErrorCode" => 1001,
                "ErrorMessage" => "Insufficient Balance",
                "Balance" => $after_balance,
                "BeforeBalance" => $member->balance
            ];
        }

        return [
            "ErrorCode" => 0,
            "ErrorMessage" => "",
            "Balance" => $after_balance,
            "BeforeBalance" => $member->balance
        ];
    }
}
