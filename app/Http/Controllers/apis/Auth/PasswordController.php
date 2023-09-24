<?php

namespace App\Http\Controllers\apis\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckEmailRequest;
use App\Http\Requests\SetNewPasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\traits\ApiTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    use ApiTrait;
    public function checkEmail(CheckEmailRequest $request)
    {
        $user = User::where('email',$request->email)->first();
        $user->token = "Bearer " . $user->createToken($request->device_name)->plainTextToken;
        return $this->Data(compact('user'));
    }

    public function setNewPassword(SetNewPasswordRequest $request)
    {
        $token = $request->header('Authorization');
        $authenticatedUser = Auth::guard('sanctum')->user();
        $user = User::find($authenticatedUser->id);
        $user->password = Hash::make($request->password);
        $user->save();
        $user->token = $token;
        return $this->Data(compact('user'),"password Changed Successfully");
    }
}
