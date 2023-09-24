<?php

namespace App\Http\Controllers\apis\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\traits\ApiTrait;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use ApiTrait;
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return $this->ErrorMessage(['email'=>'The provided credentials are incorrect.'],"Failed Attempt");
        }
        $user->token =  'Bearer '.$user->createToken($request->device_name)->plainTextToken;
        if(is_null($user->email_verified_at)){
            return $this->Data(compact('user'),"User Not Verified",401);
        }
        return $this->Data(compact('user'));
    }

    public function logout(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $token = $request->header('Authorization');
        $tokenArray = explode('|',$token);
        $tokenId = str_replace('Bearer ','',$tokenArray[0]);
        $user->tokens()->where('id', $tokenId)->delete();
        return $this->SuccessMessage("User Has Been Logged Out Successfully");
    }


    public function logoutAll(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $user->tokens()->delete();
        return $this->SuccessMessage("User Has Been Logged Out Successfully From All Devices");
    }


}
