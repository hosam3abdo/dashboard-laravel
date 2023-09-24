<?php

namespace App\Http\Controllers\apis\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\traits\ApiTrait;

class ProfileController extends Controller
{
    use ApiTrait;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $token = $request->header('Authorization');
        $user->token = $token;
        return $this->Data(compact('user'));
    }
}
