<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Models\Admin\GameType;
use App\Models\Admin\Product;
use App\Models\FinicalReport;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $reports = $this->makeJoinTable()->select(
            'products.name as product_name',
            'products.code',
            DB::raw('SUM(reports.bet_amount) as total_bet_amount'),
            DB::raw('SUM(reports.valid_bet_amount) as total_valid_bet_amount'),
            DB::raw('SUM(reports.payout_amount) as total_payout_amount'))
        ->groupBy('product_name', 'products.code')
            ->when(isset($request->fromDate) && isset($request->toDate), function ($query) use ($request) {
                $query->whereBetween('reports.settlement_date', [$request->fromDate, $request->toDate]);
            })
            ->get();

        return view('report.index', compact('reports'));
    }

    public function show(Request $request ,int $code)
    {
        $reports = $this->makeJoinTable()->select(
            'users.user_name',
            'users.id as user_id',
            'products.name as product_name',
            'products.code as product_code',
            DB::raw('SUM(reports.bet_amount) as total_bet_amount'),
            DB::raw('SUM(reports.valid_bet_amount) as total_valid_bet_amount'),
            DB::raw('SUM(reports.payout_amount) as total_payout_amount'))
            ->groupBy('users.user_name', 'product_name', 'product_code')
            ->where('reports.product_code', $code)
            ->when(isset($request->player_name), function ($query) use ($request) {
                $query->whereBetween('reports.member_name', $request->player_name);
            })
            ->when(isset($request->fromDate) && isset($request->toDate), function ($query) use ($request) {
                $query->whereBetween('reports.settlement_date', [$request->fromDate, $request->toDate]);
            })
            ->get();
        
        return view('report.show', compact('reports'));
    }

    public function detail(Request $request, int $userId)
    {

        $report = $this->makeJoinTable()
            ->select(
                'products.name as product_name',
                'users.user_name',
                'users.id as user_id',
                'reports.valid_bet_amount',
                'reports.bet_amount',
                'reports.payout_amount',
                'reports.settlement_date'
            )
            ->where('users.id', $request->user_id)
            ->when(isset($request->product_code), function ($query) use ($request) {
                $query->where('reports.product_code', $request->product_code);
            })
            ->when(isset($request->fromDate) && isset($request->toDate), function ($query) use ($request) {
                $query->whereBetween('reports.settlement_date', [$request->fromDate, $request->toDate]);
            })
            ->get();

        $player = User::find($userId);

        return view('report.detail', compact('report', 'player'));
    }

    public function view($user_name)
    {
        $reports = $this->makeJoinTable()->select(
            'users.user_name',
            'users.id as user_id',
            'products.name as product_name',
            'products.code as product_code',
            DB::raw('SUM(reports.bet_amount) as total_bet_amount'),
            DB::raw('SUM(reports.valid_bet_amount) as total_valid_bet_amount'),
            DB::raw('SUM(reports.payout_amount) as total_payout_amount'))
            ->groupBy('users.user_name', 'product_name', 'product_code')
            ->where('reports.member_name', $user_name)
            ->get();

            return view('report.view', compact('reports'));
    }

    private function makeJoinTable()
    {
        $query = User::query()->roleLimited();
        $query->join('reports', 'reports.member_name', '=', 'users.user_name')
            ->join('products', 'reports.product_code', '=', 'products.code')
            ->where('reports.status', '101');

        return $query;
    }

}

/*
SELECT 
    product_code, 
    SUM(bet_amount) AS total_bet_amount,
    SUM(valid_bet_amount) AS total_valid_bet_amount,
    SUM(payout_amount) AS total_payout_amount
FROM 
    reports
WHERE 
    status = '101' 
    AND settlement_date BETWEEN '2024-01-01' AND '2024-12-31'
GROUP BY 
    product_code;


    ------------------- 
    SELECT DISTINCT
    u.user_name AS player_id,
    p.name AS product_name,
    r.valid_bet_amount AS total_valid_bet,
    r.bet_amount AS total_bet,
    r.payout_amount AS total_payout,
    (r.bet_amount - r.payout_amount) AS win_lose
FROM 
    reports r
JOIN 
    (SELECT DISTINCT code, name FROM products) p ON r.product_code = p.code
JOIN 
    users u ON r.member_name = u.user_name;

*/
