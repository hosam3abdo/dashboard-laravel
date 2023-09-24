<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\traits\ApiTrait;
class VerifiedApi
{
    use ApiTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // check if user verifid or not
        if(! Auth::guard('sanctum')->check() || is_null(Auth::guard('sanctum')->user()->email_verified_at)){
            return $this->ErrorMessage(['User'=>'Unauthourized'],"Failed Attempt",401);
        }

        return $next($request);
    }
}
