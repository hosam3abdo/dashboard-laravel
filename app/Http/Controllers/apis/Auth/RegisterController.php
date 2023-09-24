<?php

namespace App\Http\Controllers\apis\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\traits\ApiTrait;

class RegisterController extends Controller
{
    use ApiTrait;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterRequest $request)
    {
        $data = $request->except('password','password_confirmation');
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        $user->token = "Bearer ".$user->createToken($request->device_name)->plainTextToken;
        return $this->Data(compact('user'),"Register Compleleted Successfully");
    }
}
