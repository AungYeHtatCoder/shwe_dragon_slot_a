<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Admin\UserLog;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function showLogin()
    {

        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('user_name', $request->user_name)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Invalid credentials. Please try again.');
        }

        if ($user->is_changed_password == 0) {
            return view('auth.passwords.index', compact('user'));
        }

        if (Auth::attempt($request->only('user_name', 'password'))) {
            // Check for unauthorized roles
            if ($request->user()->hasRole('Player')) {
                abort(403);
            }

            // Log user activity (assuming UserLog model)
            UserLog::create([
                'ip_address' => $request->ip(),
                'user_id' => Auth::id(), // Use Auth::id() for logged in user
                'user_agent' => $request->userAgent()
            ]);

            return redirect()->route('home');
        }

        return redirect()->back()->with('error', 'Invalid credentials. Please try again.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }

    public function updatePassword(Request $request, User $user)
    {
        try {
            $request->validate([
                'password' => 'required|min:6|confirmed',
            ]);

            $user->update([
                'password' => Hash::make($request->password),
                'is_changed_password' => true
            ]);

            return redirect()->route('login')->with('success', "Password has been Updated.");
        } catch (Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
