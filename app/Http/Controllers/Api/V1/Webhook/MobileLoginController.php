<?php

namespace App\Http\Controllers\Api\V1\Webhook;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MobileLoginController extends Controller
{
    public function MobileLogin(Request $request){
        $method =  str(__FUNCTION__)->lower();
        $operatorCode = $request->get("OperatorCode");
        $memberName = $request->get("MemberName");
        $requestTime = $request->get("RequestTime");

        $secretKey = config("game.api.secret_key");

        $sign = $request->get("Sign");

        $signature = md5($operatorCode . $requestTime . $method . $secretKey);

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
            "BeforeBalance" => $member->balance
        ];
    }
}
