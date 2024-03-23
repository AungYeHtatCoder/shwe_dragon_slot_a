<?php

namespace App\Http\Controllers\Admin\Master;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Enums\TransactionName;
use App\Services\WalletService;
use App\Models\Admin\TransferLog;
use App\Http\Controllers\Controller;
use App\Http\Requests\MasterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\TransferLogRequest;
use Symfony\Component\HttpFoundation\Response;

class MasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private const MASTER_ROLE = 2;

    public function index()
    {
        abort_if(
            Gate::denies('master_index'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );
        //kzt
        $users = User::with('roles')
            ->whereHas('roles', function ($query) {
                $query->where('role_id', self::MASTER_ROLE);
            })
            ->where('agent_id', auth()->id())
            ->orderBy('id', 'desc')
            ->get();

        //kzt
        return view('admin.master.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(
            Gate::denies('master_create'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );
        $agent_name = $this->generateRandomString();

        return view('admin.master.create', compact('agent_name'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MasterRequest $request)
    {
        abort_if(
            Gate::denies('master_store'),
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
                'max_score' => $request->max_score ?? '0.00',
                'type' => 'master'
            ]
        );
        $user = User::create($userPrepare);
        $user->roles()->sync(self::MASTER_ROLE);

        return redirect()->back()
            ->with('success', 'Master created successfully')
            ->with('password', $request->password)
            ->with('username', $user->user_name);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(
            Gate::denies('master_show'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );

        $master = User::find($id);
        return view('admin.master.show', compact('master'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(
            Gate::denies('master_edit'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );

        $master = User::find($id);
        return view('admin.master.edit', compact('master'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(
            Gate::denies('master_update'),
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
            ->with('success', 'Master Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function getCashIn(string $id)
    {
        abort_if(
            Gate::denies('make_transfer'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );

        $master = User::find($id);
        return view('admin.master.cash_in', compact('master'));
    }

    public function getCashOut(string $id)
    {
        abort_if(
            Gate::denies('make_transfer'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );

        // Assuming $id is the user ID
        $master = User::findOrFail($id);


        return view('admin.master.cash_out', compact('master'));
    }

    public function makeCashIn(TransferLogRequest $request, $id)
    {

        abort_if(
            Gate::denies('make_transfer'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );

        try {
            $inputs = $request->validated();
            $master = User::findOrFail($id);
            $admin = Auth::user();
            $cashIn = $inputs['amount'];
            if ($cashIn > $admin->balanceFloat) {
                throw new \Exception('You do not have enough balance to transfer!');
            }

            // Transfer money
            app(WalletService::class)->transfer($admin, $master, $request->validated("amount"), TransactionName::CreditTransfer);

            return redirect()->back()->with('success', 'Money fill request submitted successfully!');
        } catch (Exception $e) {

            session()->flash('error', $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function makeCashOut(TransferLogRequest $request, string $id)
    {

        abort_if(
            Gate::denies('make_transfer'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );

        try {
            $inputs = $request->validated();

            $master = User::findOrFail($id);
            $admin = Auth::user();
            $cashOut = $inputs['amount'];

            if ($cashOut > $master->balanceFloat) {

                return redirect()->back()->with('error', 'You do not have enough balance to transfer!');
            }

            // Transfer money
            app(WalletService::class)->transfer($master, $admin, $request->validated("amount"), TransactionName::DebitTransfer);

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
            Gate::denies('make_transfer'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );
        $transfer_detail = TransferLog::where('from_user_id', $id)
            ->orWhere('to_user_id', $id)
            ->get();

        return view('admin.master.transfer_detail', compact('transfer_detail'));
    }
    private function generateRandomString()
    {
        $randomNumber = mt_rand(10000000, 99999999);
        return 'MW' . $randomNumber;
    }


    public function banMaster($id)
    {
        $user = User::find($id);
        $user->update(['status' => $user->status ==  1 ? 0 : 1 ]);
      
        return redirect()->back()->with(
            'success',
            'User ' . ($user->status == 1 ? 'activate' : 'inactive') . ' successfully'
        );
    }

    public function getChangePassword($id)
    {
        $master = User::find($id);
        return view('admin.master.change_password', compact('master'));
    }

    public function makeChangePassword($id, Request $request)
    {
        abort_if(
            Gate::denies('make_transfer'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden |You cannot  Access this page because you do not have permission'
        );

        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);

        $master = User::find($id);
        $master->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()
            ->with('success', 'Master Change Password successfully')
            ->with('password', $request->password)
            ->with('username', $master->name);
    }
}