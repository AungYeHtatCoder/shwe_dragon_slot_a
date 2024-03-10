<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class ReportController extends Controller
{
    public function pullReport(Request $request)
    {
        $operatorCode = Config::get('game.api.operator_code');
        $secretKey = Config::get('game.api.secret_key');
        $apiUrl = Config::get('game.api.url') . '/Seamless/PullReportBySettlementDate';
        // Generate the signature
        $requestTime = now()->format('YmdHis');
        $signature = md5($operatorCode . $requestTime . 'pullreportbysettlementdate' . $secretKey);
        // Prepare the payload
        $data = [
            'OperatorCode' => $operatorCode,
            'StartDate' => $request->start_date,
            'EndDate' => $request->end_date,
            'Sign' => $signature,
            'RequestTime' => $requestTime,
        ];

        if(isset($request->start_date) && isset($request->end_date))
        {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post($apiUrl, $data);
    
            if ($response->successful()) {
                $data = $response->json();
                $result = $data['Wagers'];
                return view('report.pullreport',compact('result'));

            }else{
                return view('report.pullreport');
            }
        }
        return view('report.pullreport');
        
       
    }
}
