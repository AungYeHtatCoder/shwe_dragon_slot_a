<?php

namespace App\Http\Controllers\Report;
use App\Models\User;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TestReportController extends Controller
{
    public function index(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching the reports.'], 500);
        }
    }

    public function show(Request $request, int $product_code)
    {
        try {
            $reports = $this->makeJoinTable()->select(
                'users.user_name',
                'users.id as user_id',
                'products.name as product_name',
                'products.code as product_code',
                DB::raw('SUM(reports.bet_amount) as total_bet_amount'),
                DB::raw('SUM(reports.valid_bet_amount) as total_valid_bet_amount'),
                DB::raw('SUM(reports.payout_amount) as total_payout_amount'))
                ->groupBy('users.user_name', 'product_name', 'product_code')
                ->where('reports.product_code', $product_code)
                ->when(isset($request->player_name), function ($query) use ($request) {
                    $query->whereBetween('reports.member_name', $request->player_name);
                })
                ->when(isset($request->fromDate) && isset($request->toDate), function ($query) use ($request) {
                    $query->whereBetween('reports.settlement_date', [$request->fromDate, $request->toDate]);
                })
                ->get();

            return view('report.show', compact('reports'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching the reports.'], 500);
        }
    }

    public function detail(Request $request, int $userId, int $product_code)
    {
        try {
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
                ->where('users.id', $userId)
                ->where('reports.product_code', $product_code)
                ->when(isset($request->fromDate) && isset($request->toDate), function ($query) use ($request) {
                    $query->whereBetween('reports.settlement_date', [$request->fromDate, $request->toDate]);
                })
                ->get();

            $player = User::find($userId);

            if (!$player) {
                return response()->json(['error' => 'User not found.'], 404);
            }

            return view('report.detail', compact('report', 'player'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching the reports.'], 500);
        }
    }

    public function view($user_name)
    {
        try {
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

            if ($reports->isEmpty()) {
                return response()->json(['error' => 'User not found.'], 404);
            }

            return view('report.view', compact('reports'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching the reports.'], 500);
        }
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
