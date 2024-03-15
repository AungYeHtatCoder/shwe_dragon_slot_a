<?php

namespace App\Http\Controllers\Admin\Player;

use App\Enums\TransactionName;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Admin\TransferLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\TransferLogRequest;
use App\Http\Requests\PlayerRequest;
use App\Models\Admin\UserLog;
use App\Models\Transfer;
use App\Services\WalletService;
use Illuminate\Http\Client\Request as ClientRequest;
use Symfony\Component\HttpFoundation\Response;


class PlayerController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(
            Gate::denies('player_index'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );
        //kzt
        $users = User::with('roles')
            ->whereHas('roles', function ($query) {
                $query->where('role_id', 4);
            })
            ->where('agent_id', auth()->id())
            ->orderBy('id', 'desc')
            ->get();
        return view('admin.player.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(
            Gate::denies('player_create'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );
        $player_name = $this->generateRandomString();
        return view('admin.player.create', compact('player_name'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlayerRequest $request)
    {
        abort_if(
            Gate::denies('player_store'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot Access this page because you do not have permission'
        );

        try {
            // Validate input
            $inputs = $request->validated();
            $userPrepare = array_merge(
                $inputs,
                // [
                //     'password' => Hash::make($inputs['password']),
                //     'agent_id' => Auth()->user()->id
                // ]
                 [
                'password' => Hash::make($inputs['password']),
                'agent_id' => Auth()->user()->id,
                'status' => 1,
                // Set 'max_score' to request value or default to '0.00' if not present
                //'max_score' => $request->has('max_score') ? $request->max_score : '0.00',
                'max_score' => $request->max_score ?? '0.00',
                'type' => 'agent'
                ]
            );
            Log::info('User prepared: ' . json_encode($userPrepare));


            // Create user in local database
            $user = User::create($userPrepare);
            $user->roles()->sync('4');

            return redirect()->back()
                ->with('success', 'Player created successfully')
                ->with('url', env('APP_URL'))
                ->with('password', $request->password)
                ->with('username', $user->name);
        } catch (Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(
            Gate::denies('player_show'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );

        $user_detail = User::findOrFail($id);

        return view('admin.player.show', compact('user_detail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $player)
    {
        abort_if(
            Gate::denies('player_edit'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );

        return response()->view('admin.player.edit', compact('player'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $player)
    {

        $player->update($request->all());
        return redirect()->route('admin.player.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $player)
    {
        abort_if(
            Gate::denies('user_delete'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );
        //$player->destroy();
        User::destroy($player->id);

        return redirect()->route('admin.player.index')->with('success', 'User deleted successfully');
    }


    public function massDestroy(Request $request)
    {
        User::whereIn('id', request('ids'))->delete();
        return response(null, 204);
    }

    public function banUser($id)
    {
        $user = User::find($id);
        $user->update(['status' => $user->status == 1 ? 0 : 1]);

        return redirect()->back()->with(
            'success',
            'User ' . ($user->status == 1 ? 'activate' : 'inactive') . ' successfully'
        );
    }

    public function getCashIn(User $player)
    {
        abort_if(
            Gate::denies('make_transfer'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );
        return view('admin.player.cash_in', compact('player'));
    }
    
    public function makeCashIn(TransferLogRequest $request, User $player)
    {
        abort_if(
            Gate::denies('make_transfer'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );

        try {
            $inputs = $request->validated();
            $inputs['refrence_id'] = $this->getRefrenceId();

            $agent = Auth::user();
            $cashIn = $inputs['amount'];

            if ($cashIn > $agent->balanceFloat) {

                return redirect()->back()->with('error', 'You do not have enough balance to transfer!');
            }

            app(WalletService::class)->transfer($agent, $player, $request->validated("amount"), TransactionName::CreditTransfer);

            return redirect()->back()
                ->with('success', 'CashIn submitted successfully!');
        } catch (Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function getCashOut(User $player)
    {
        abort_if(
            Gate::denies('make_transfer'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );
        return view('admin.player.cash_out', compact('player'));
    }
    public function makeCashOut(TransferLogRequest $request, User $player)
    {
        abort_if(
            Gate::denies('make_transfer'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );

        try {
            $inputs = $request->validated();
            $inputs['refrence_id'] = $this->getRefrenceId();

            $agent = Auth::user();
            $cashOut = $inputs['amount'];

            if ($cashOut > $player->balanceFloat) {

                return redirect()->back()->with('error', 'You do not have enough balance to transfer!');
            }

            app(WalletService::class)->transfer($player, $agent, $request->validated("amount"), TransactionName::DebitTransfer);

            return redirect()->back()
                ->with('success', 'CashOut submitted successfully!');
        } catch (Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function getTransferDetail($id)
    {
        $transfer_detail = Transfer::where('from_id', $id)
            ->orWhere('to_id', $id)
            ->get();
        
        return view('admin.player.transfer_detail', compact('transfer_detail'));
    }

    public function logs($id)
    {
        $logs = UserLog::with('user')->where('user_id', $id)->get();

        return view('admin.player.logs', compact('logs'));
    }

    private function generateRandomString()
    {
        $randomNumber = mt_rand(10000000, 99999999);
        return 'DC' . $randomNumber;
    }

    private function getRefrenceId($prefix = 'REF')
    {
        return  uniqid($prefix);
    }
}