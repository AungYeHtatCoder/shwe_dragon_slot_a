<?php

namespace App\Http\Controllers;

use App\Models\Admin\GameType;
use App\Models\Admin\Product;
use App\Models\Report;
use App\Models\User;
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
            ->join('wagers', 'seamless_transactions.wager_id', '=', 'wagers.id')
            ->where('users.agent_id', Auth::id())
            ->where('wagers.status','101')
            ->groupBy('users.user_name')
            ->get();

        return view('report.index', compact('report'));
    }

    public function show(int $userId)
    {
        $report = DB::table('seamless_transactions')
            ->select(
            'products.name as product_name',
            'products.id as product_id',
            'game_types.name as game_type_name',
            'game_types.id as game_type_id',
            'users.user_name',
            'users.id as user_id',
            DB::raw('SUM(seamless_transactions.bet_amount) as total_bet_amount'),
            DB::raw('SUM(seamless_transactions.valid_amount) as total_valid_amount'),
            DB::raw(
                'SUM(seamless_transactions.transaction_amount) as total_transaction_amount'
            )
            )
            ->join('users', 'seamless_transactions.user_id', '=', 'users.id')
            ->join('products', 'seamless_transactions.product_id', '=', 'products.id')
            ->join('game_types', 'seamless_transactions.game_type_id', '=', 'game_types.id')
            ->join('wagers', 'seamless_transactions.wager_id', '=', 'wagers.id')
            ->where('users.id',$userId)
            ->where('users.agent_id', Auth::id())
            ->where('wagers.status','101')
            ->groupBy('products.name','game_types.name','users.user_name','users.id','game_types.id','products.id')
            ->get();

        return view('report.show', compact('report'));

    }

    public function detail(Request $request)
    {
        $report = DB::table('seamless_transactions')
        ->select(
            'products.name as product_name',
            'game_types.name as game_type_name',
            'users.user_name',
            'users.id as user_id',
            'seamless_transactions.bet_amount',
            'seamless_transactions.valid_amount',
            'seamless_transactions.transaction_amount'
            )
            ->join('users', 'seamless_transactions.user_id', '=', 'users.id')
            ->join('products', 'seamless_transactions.product_id', '=', 'products.id')
            ->join('game_types', 'seamless_transactions.game_type_id', '=', 'game_types.id')
            ->join('wagers', 'seamless_transactions.wager_id', '=', 'wagers.id')
            ->where('users.id',$request->user_id)
            ->where('products.id',$request->product_id)
            ->where('game_types.id',$request->game_type_id)
            ->where('users.agent_id', Auth::id())
            ->where('wagers.status','101')
            ->get();
        $product = Product::find($request->product_id);
        $player = User::find($request->user_id);

    return view('report.detail',compact('report','product','player'));
    }
}
