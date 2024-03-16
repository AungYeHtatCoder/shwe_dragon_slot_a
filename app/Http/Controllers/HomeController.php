<?php

namespace App\Http\Controllers;

use App\Enums\TransactionName;
use App\Models\Admin\AdminAddBalance;
use App\Models\SeamlessTransaction;
use App\Models\User;
use App\Services\WalletService;
use App\Settings\AppSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Admin')) {

            $startLastMonth = now()->subMonth()->startOfMonth();
            $endLastMonth = now()->subMonth()->endOfMonth();

            $userCount = User::where('agent_id', null)->count();
            $lastUserCount = User::where('agent_id', null)->whereBetween('created_at', [$startLastMonth, $endLastMonth])
                ->count();

            $provider_balance = (new AppSetting())->provider_balance + SeamlessTransaction::sum("transaction_amount");

            return view('admin.dashboard', compact(
                'provider_balance',
                'userCount',
                'lastUserCount',
                'user'
            ));
        }elseif ($user->hasRole('Master')) {

            $startLastMonth = now()->subMonth()->startOfMonth();
            $endLastMonth = now()->subMonth()->endOfMonth();

            $userCount = User::where('agent_id', $user->id)->count();

            $lastUserCount = User::where('agent_id', null)->whereBetween('created_at', [$startLastMonth, $endLastMonth])
                ->count();

            return view('admin.dashboard', compact(
                'userCount',
                'lastUserCount',
                'user'
            ));
        }elseif ($user->hasRole('Agent')) {

            $startLastMonth = now()->subMonth()->startOfMonth();
            $endLastMonth = now()->subMonth()->endOfMonth();

            $userCount = User::where('agent_id', $user->id)->count();

            $lastUserCount = User::where('agent_id', null)->whereBetween('created_at', [$startLastMonth, $endLastMonth])
                ->count();

            return view('admin.dashboard', compact(
                'userCount',
                'lastUserCount',
                'user'
            ));
        } else {
            return redirect('/');
        }
    }

    public function balanceUp(Request $request)
    {
        abort_if(
            Gate::denies('admin_access'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );

        $request->validate([
            'balance' => 'required|numeric',
        ]);

        app(WalletService::class)->deposit($request->user(), $request->validated("balance"), TransactionName::CapitalDeposit);
    }
}