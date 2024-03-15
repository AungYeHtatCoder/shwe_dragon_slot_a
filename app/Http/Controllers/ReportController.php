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
        $report = DB::table('seamless_transactions')
            ->join('users', 'seamless_transactions.user_id', '=', 'users.id')
            ->where('users.agent_id', Auth::id())
            ->get();

        return view('report.index', compact('report'));
    }
}
