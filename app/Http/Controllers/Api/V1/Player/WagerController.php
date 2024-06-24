<?php

namespace App\Http\Controllers\Api\V1\Player;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\SeamlessTransactionResource;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WagerController extends Controller
{
    use HttpResponses;

    public function index(Request $request)
    {
        $type = $request->get("type");

        [$from, $to] = match ($type) {
            "yesterday" => [now()->subDay()->startOfDay(), now()->subDay()->endOfDay()],
            "this_week" => [now()->startOfWeek(), now()->endOfWeek()],
            "last_week" => [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()],
            default => [now()->startOfDay(), now()],
        };

        $user = auth()->user();
    
        $transactions = $this->makeJoinTable()->select(
                'products.name as product_name',
                DB::raw('MIN(reports.settlement_date) as from_date'),
                DB::raw('MAX(reports.settlement_date) as to_date'),
                DB::raw('COUNT(product_code) as total_count'),
                DB::raw('SUM(reports.bet_amount) as total_bet_amount'),
                DB::raw('SUM(reports.payout_amount) as total_payout_amount'))
                ->groupBy('product_name')
                ->where("member_name", $user->user_name)
                ->whereBetween("reports.settlement_date", [$from, $to])
                ->paginate();
        return $this->success(SeamlessTransactionResource::collection($transactions));
    }

    private function makeJoinTable()
    {
        $query = User::query();
        $query->join('reports', 'reports.member_name', '=', 'users.user_name')
            ->join('products', 'reports.product_code', '=', 'products.code')
            ->where('reports.status', '101');

        return $query;
    }
}
