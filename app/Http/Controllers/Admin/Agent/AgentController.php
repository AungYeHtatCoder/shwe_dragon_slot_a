<?php

namespace App\Http\Controllers\Admin\Agent;

use App\Enums\TransactionName;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AgentRequest;
use App\Http\Requests\TransferLogRequest;
use App\Models\Admin\TransferLog;
use App\Services\WalletService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private const AGENT_ROLE = 3;

    public function index()
    {
        abort_if(
            Gate::denies('agent_index'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );
        //kzt
        $users = User::with('roles')
            ->whereHas('roles', function ($query) {
                $query->where('role_id', 2);
            })
            ->where('agent_id', auth()->id())
            ->orderBy('id', 'desc')
            ->get();

        //kzt
        return view('admin.agent.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(
            Gate::denies('agent_create'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );
        $agent_name = $this->generateRandomString();

        return view('admin.agent.create', compact('agent_name'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AgentRequest $request)
    {
        abort_if(
            Gate::denies('agent_store'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );


        $inputs = $request->validated();
        $userPrepare  = array_merge(
            $inputs,
            [
                'password' => Hash::make($inputs['password']),
                'agent_id' => Auth()->user()->id,
                'status' => 1,
                'type' => 'agent'
            ]
        );
        $user = User::create($userPrepare);
        $user->roles()->sync(self::AGENT_ROLE);

        return redirect()->back()
            ->with('success', 'Agent created successfully')
            ->with('password', $request->password)
            ->with('username', $user->name);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(
            Gate::denies('agent_show'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );

        $user_detail = User::find($id);
        return view('admin.agent.show', compact('user_detail'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(
            Gate::denies('agent_edit'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );

        $agent = User::find($id);
        return view('admin.agent.edit', compact('agent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(
            Gate::denies('agent_update'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );

        $request->validate([
            'name' => 'required|min:3|unique:users,name,' . $id,
            'player_name' => 'required|string',
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'unique:users,phone,' . $id],
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'player_name' => $request->player_name
        ]);

        return redirect()->back()
            ->with('success', 'Agent Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function getCashIn(string $id)
    {
        abort_if(
            Gate::denies('agent_transfer'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );

        $agent = User::find($id);
        return view('admin.agent.cash_in', compact('agent'));
    }

    public function getCashOut(string $id)
    {
        abort_if(
            Gate::denies('agent_transfer'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );

        // Assuming $id is the user ID
        $agent = User::findOrFail($id);


        return view('admin.agent.cash_out', compact('agent'));
    }

    public function makeCashIn(TransferLogRequest $request, $id)
    {

        abort_if(
            Gate::denies('agent_transfer'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );

        try {
            $inputs = $request->validated();
            $agent = User::findOrFail($id);
            $admin = Auth::user();
            $cashIn = $inputs['amount'];
            if ($cashIn > $admin->balanceFloat) {
                throw new \Exception('You do not have enough balance to transfer!');
            }

            // Transfer money
            app(WalletService::class)->transfer($admin, $agent, $request->validated("amount"), TransactionName::CreditTransfer);

            return redirect()->back()->with('success', 'Money fill request submitted successfully!');
        } catch (Exception $e) {

            session()->flash('error', $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function makeCashOut(TransferLogRequest $request, string $id)
    {

        abort_if(
            Gate::denies('agent_transfer'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );

        try {
            $inputs = $request->validated();

            $agent = User::findOrFail($id);
            $admin = Auth::user();
            $cashOut = $inputs['amount'];

            if ($cashOut > $agent->balanceFloat) {

                return redirect()->back()->with('error', 'You do not have enough balance to transfer!');
            }

            // Transfer money
            app(WalletService::class)->transfer($agent, $admin, $request->validated("amount"), TransactionName::DebitTransfer);

            return redirect()->back()->with('success', 'Money fill request submitted successfully!');
        } catch (Exception $e) {

            session()->flash('error', $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Money fill request submitted successfully!');
    }

    public function getTransferDetail($id)
    {

        abort_if(
            Gate::denies('agent_transfer'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );
        $transfer_detail = TransferLog::where('from_user_id', $id)
            ->orWhere('to_user_id', $id)
            ->get();

        return view('admin.agent.transfer_detail', compact('transfer_detail'));
    }
    private function generateRandomString()
    {
        $randomNumber = mt_rand(10000000, 99999999);
        return 'MW' . $randomNumber;
    }


    public function banAgent($id)
    {
        $user = User::find($id);
        $user->update(['status' => $user->status == 1 ? 2 : 1]);
        if (Auth::check() && Auth::id() == $id) {
            Auth::logout();
        }
        return redirect()->back()->with(
            'success',
            'User ' . ($user->status == 1 ? 'activated' : 'banned') . ' successfully'
        );
    }

    public function getChangePassword($id)
    {
        $agent = User::find($id);
        return view('admin.agent.change_password', compact('agent'));
    }

    public function makeChangePassword($id, Request $request)
    {
        abort_if(
            Gate::denies('agent_access'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );

        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);

        $agent = User::find($id);
        $agent->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()
            ->with('success', 'Agent Change Password successfully')
            ->with('password', $request->password)
            ->with('username', $agent->name);
    }
}