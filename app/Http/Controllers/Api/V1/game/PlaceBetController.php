<?php
namespace App\Http\Controllers\Api\V1\game;

use App\Models\User;
use App\Models\PlaceBet;
use App\Models\UserWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class PlaceBetController extends Controller
{
    public function placeBet(Request $request)
    {
        $operatorCode = $request->input("OperatorCode");
        $memberName = $request->get("MemberName");
        $requestTime = $request->input("RequestTime");
        $secretKey = config("game.api.secret_key");
        $sign = $request->input("Sign");
        $signature = md5($operatorCode . $requestTime . 'placebet' . $secretKey);
        if ($sign !== $signature) {
            return response()->json([
                "ErrorCode" => 1004,
                "ErrorMessage" => "Wrong Sign",
                "Balance" => 0
            ]);
        }

        $member = User::where("user_name", $memberName)->first();

        $after_balance = $member->balance - $request->get("Transactions")[0]["BetAmount"];

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
