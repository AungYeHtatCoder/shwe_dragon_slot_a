<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:fetch-report';

    protected $operatorCode;
    protected $secretKey;
    protected $apiUrl;
    public const VERSION_KEY = 1;

    public function __construct()
    {
        parent::__construct();
        $this->operatorCode =   config('game.api.operator_code');
        $this->secretKey =  config('game.api.secret_key');
        $this->apiUrl =  config('game.api.url');

    }
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $apiUrl = $this->apiUrl. '/Seamless/FetchReport';
        $data = [
            'OperatorCode' => $this->operatorCode
           ];

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post($apiUrl, $data);
    
            if ($response->successful()) {
                dd($response->json());
 

            }else{
                return view('report.pullreport');
            }
        }
    
}
