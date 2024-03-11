<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\SeamlessTransaction;
use App\Http\Controllers\Controller;

class GetBetDetailController extends Controller
{
    // public function index()
    // {
    //     $transactions = SeamlessTransaction::with(['user', 'seamlessEvent'])->get();

    //     return view('admin.get_bet_detail.index', compact('transactions'));
    // }
    public function index(Request $request)
    {
        $query = SeamlessTransaction::with(['user', 'seamlessEvent']);

        if ($request->has(['fromDate', 'toDate'])) {
            $query->whereBetween('created_at', [
                $request->fromDate . ' 00:00:00', // Start of fromDate
                $request->toDate . ' 23:59:59'    // End of toDate
            ]);
        }

        $transactions = $query->get();

        return view('admin.get_bet_detail.index', compact('transactions'));
    }
}