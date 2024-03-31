<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Models\Admin\GameType;
use App\Models\Admin\Product;
use App\Models\FinicalReport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function indexV2(Request $request){
        // TODO: check valid tree
        $username = $request->get("user_name", auth()->user()->user_name);

        $user = User::where("user_name", $username)->first();

        $child_user_type = UserType::childUserType($user->type);

        $date = $request->get("date", now()->setTimezone("Asia/Yangon")->format("Y-m-d"));

        $reports = FinicalReport::with("user")->whereIn(
            "user_id",
            User::where("type", $child_user_type)->where("agent_id", $user->id)->select("id")
        )
            ->where("date", $date)
            ->paginate();

        return view("report.index_v2", [
            "reports" => $reports, 
            "parent_user_type" => $user->type, 
            "child_user_type" => $child_user_type
        ]);
    }

    public function index(Request $request)
    {
        $query = $this->makeJoinTable()->select(
            'users.id as user_id',
            'users.user_name',
            DB::raw('SUM(seamless_transactions.bet_amount) as total_bet_amount'),
            DB::raw('SUM(seamless_transactions.valid_amount) as total_valid_amount'),
            DB::raw('SUM(seamless_transactions.transaction_amount) as total_transaction_amount')
        )
        ->when(isset($request->fromDate) && isset($request->toDate), function ($query) use ($request) {
            $query->whereBetween('seamless_transactions.created_at', [$request->fromDate, $request->toDate]);
        })
        ->when(isset($request->player_name), function ($query) use ($request) {
            $query->where('users.user_name', $request->player_name);
        })
        ->groupBy('users.user_name');

        $report = $query->get();

        $gameTypes = GameType::all();

        return view('report.index', compact('report', 'gameTypes'));
    }

    public function show(Request $request, int $userId)
    {
        $report = $this->makeJoinTable()
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
            ->where('users.id', $userId)
            ->when(isset($request->fromDate) && isset($request->toDate), function ($query) use ($request) {
                $query->whereBetween('seamless_transactions.created_at', [$request->fromDate, $request->toDate]);
            })
            ->when(isset($request->product_id), function ($query) use ($request) {
                $query->where('seamless_transactions.product_id', $request->product_id);
            })
            ->groupBy('products.name', 'game_types.name', 'users.user_name', 'users.id', 'game_types.id', 'products.id')
            ->get();
        $products = Product::all();

        return view('report.show', compact('report','userId','products'));
    }

    public function detail(Request $request)
    {
        $request->validate([
            "product_id" => ["required"],
            "user_id" => ["required"],
            "game_type_id" => ["required"],
        ]);

        $report =$this->makeJoinTable()
            ->select(
                'products.name as product_name',
                'game_types.name as game_type_name',
                'users.user_name',
                'users.id as user_id',
                'seamless_transactions.bet_amount',
                'seamless_transactions.valid_amount',
                'seamless_transactions.transaction_amount',
                'seamless_transactions.created_at'
            )
            ->where('users.id', $request->user_id)
            ->where('products.id', $request->product_id)
            ->where('game_types.id', $request->game_type_id)
            ->when(isset($request->fromDate) && isset($request->toDate), function ($query) use ($request) {
                $query->whereBetween('seamless_transactions.created_at', [$request->fromDate, $request->toDate]);
            })
            ->get();

        $product = Product::find($request->product_id);
        $player = User::find($request->user_id);
        $gameType =  GameType::find($request->game_type_id);

        return view('report.detail', compact('report', 'product', 'player','gameType'));
    }

    private function makeJoinTable()
    {
        $query = User::query()->roleLimited();
        $query->join('seamless_transactions', 'users.id', '=', 'seamless_transactions.user_id')
              ->join('products', 'seamless_transactions.product_id', '=', 'products.id')
              ->join('game_types', 'seamless_transactions.game_type_id', '=', 'game_types.id')
              ->where('seamless_transactions.status', '101');

        return $query;
    }

}
