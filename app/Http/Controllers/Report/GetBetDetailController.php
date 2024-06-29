<?php

namespace App\Http\Controllers\Report;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class GetBetDetailController extends Controller
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

        return view('get_bet_detail.index', compact('reports'));
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
        
        return view('get_bet_detail.show', compact('reports'));
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

        return view('get_bet_detail.detail', compact('report', 'player'));
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

            return view('get_bet_detail.view', compact('reports'));
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
