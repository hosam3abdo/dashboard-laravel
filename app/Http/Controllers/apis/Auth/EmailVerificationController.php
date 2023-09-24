<?php

namespace App\Http\Controllers\apis\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckCodeRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\traits\ApiTrait;
use App\Mail\SendCode;
use Illuminate\Support\Facades\Mail;
class EmailVerificationController extends Controller
{
    use ApiTrait;
    public function sendCode(Request $request)
    {
       $token = $request->header('authorization');
       $authenticatedUser = Auth::guard('sanctum')->user();
       $user = User::find($authenticatedUser->id);
       $user->code = rand(10000,99999);
       $user->save();
       // send mail with code
        Mail::to($user)->send(new SendCode($user));
       $user->token = $token;
        return $this->Data(compact('user'),'Mail Sent Successfully');
    }

    public function checkCode(CheckCodeRequest $request)
    {
        $token = $request->header('authorization');
        $user = Auth::guard('sanctum')->user();
        $user->token = $token;
        return $user->code == $request->code ? 
        $this->Data(compact('user'),"Correct Code") :
        $this->ErrorMessage(['code'=>'Invalid Code'],"Faild Attempt",401);
    }
    public function emailVerification(CheckCodeRequest $request)
    {
        $token = $request->header('authorization');
        $authenticatedUser = Auth::guard('sanctum')->user();
        $user = User::find($authenticatedUser->id);
        if($user->code == $request->code){
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->save();
            $user->token = $token;
            return $this->Data(compact('user'),'User Is Verified');
        }else{
            return $this->ErrorMessage(['code'=>'Invalid Code'],"Faild Attempt",401);
        }
        
    }
}


