<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ChangePasswordRequest;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\ProfileRequest;
use App\Http\Requests\PlayerRequest;
use App\Http\Resources\PlayerResource;
use App\Http\Resources\UserResource;
use App\Models\Admin\UserLog;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;
    public function login(LoginRequest $request)
    {
        $request->validated($request->all());
        $credentials = $request->only('user_name', 'password');
        if (Auth::attempt($credentials)) {
            $user = User::where('user_name', $request->user_name)->first();

            UserLog::create([
                'ip_address' => $request->ip(),
                'user_id' => $user->id
            ]);
            
            return $this->success(new UserResource($user), 'User Login Successfully');
        } else {
            return $this->error("", "Credentials do not match!", 401);
        }
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return $this->success([
            'message' => 'Logged out successfully.'
        ]);
    }

    public function getUser()
    {
        return $this->success(new PlayerResource(Auth::user()),'User Success');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $player = Auth::user();
        if(Hash::check($request->current_password, $player->password)) {
             $player->update([
                'password' => $request->password
             ]);
        }else{
             return $this->error('','Old Passowrd is incorrect',401);
        }
        return $this->success($player,'Password has been changed successfully.');
    }

    public function profile(ProfileRequest $request)
    {
        
        $player = Auth::user();
        $player->update([
            'name' => $request->name,
            'phone' => $request->phone
        ]);
     
        return $this->success(new PlayerResource($player),'Update profile');
    }
    
}