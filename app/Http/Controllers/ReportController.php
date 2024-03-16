<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {

        $report =  DB::table('seamless_transactions')
            ->select(
                'users.id as user_id',
                'users.user_name',
                DB::raw('SUM(seamless_transactions.bet_amount) as total_bet_amount'),
                DB::raw('SUM(seamless_transactions.valid_amount) as total_valid_amount'),
                DB::raw(
                    'SUM(seamless_transactions.transaction_amount) as total_transaction_amount'
                )
            )
            ->join('users', 'seamless_transactions.user_id', '=', 'users.id')
            ->join('products', 'seamless_transactions.product_id', '=', 'products.id')
            ->join('game_types', 'seamless_transactions.game_type_id', '=', 'game_types.id')
            ->where('users.agent_id', Auth::id())
            ->get();

        return view('report.index', compact('report'));
    }

    public function show()
    {
        $report = DB::table('seamless_transactions')
        ->select(
            'users.user_name',
            'products.name as product_name',
            'game_types.name as game_type_name',
            DB::raw('SUM(seamless_transactions.bet_amount) as total_bet_amount'),
            DB::raw('SUM(seamless_transactions.valid_amount) as total_valid_amount'),
            DB::raw(
                'SUM(seamless_transactions.transaction_amount) as total_transaction_amount'
            )
        )
            ->join('users', 'seamless_transactions.user_id', '=', 'users.id')
            ->join('products', 'seamless_transactions.product_id', '=', 'products.id')
            ->join('game_types', 'seamless_transactions.game_type_id', '=', 'game_types.id')
            ->where('users.agent_id', Auth::id())
            ->groupBy('products.name')
            ->get();
    }
}
