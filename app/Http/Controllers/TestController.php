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
    }
}
