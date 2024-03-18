<?php

namespace App\Http\Controllers;

use App\Enums\TransactionName;
use App\Models\SeamlessTransaction;
use App\Models\User;
use Bavix\Wallet\Models\Transaction;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __invoke(Request $request)
    {
        $type = $request->get("type");

        [$from, $to] = match ($type) {
            "yesterday" => [now()->subDay()->startOfDay(), now()->subDay()->endOfDay()],
            "this_week" => [now()->startOfWeek(), now()->endOfWeek()],
            "last_week" => [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()],
            default => [now()->subMonth(), now()],
        };

        $user = User::find(12);

        $transactionQuery = Transaction::join('seamless_transactions', function($join) use($user){
            $join->on('seamless_transactions.id', '=', 'transactions.seamless_transaction_id')
                ->whereColumn('seamless_transactions.wager_id', 'wagers.id')
                ->where("transactions.payable_id", $user->id);
        })->orderBy('transactions.id', 'desc')
        ->select('meta->opening_balance')
        ->limit(1);

        // return $user->wagers()
        //     ->where("created_at", ">=", $from)
        //     ->where("created_at", "<=", $to)
        //     ->addSelect(['opening_balance' => $transactionQuery])
        //     ->latest()
        //     ->get();

        $wagers = $user->wagers()->with(["latestTransaction.transactions" => function($q) use($user){
            $q->where("payable_id", $user->id);
        }])->whereBetween("created_at", [$from, $to])
        ->get();
    }
}
