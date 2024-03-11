<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\SeamlessTransaction;
use App\Http\Controllers\Controller;

class GetBetDetailController extends Controller
{
    public function index()
    {
        $transactions = SeamlessTransaction::with(['user', 'seamlessEvent'])->get();

        return view('admin.get_bet_detail.index', compact('transactions'));
    }
}