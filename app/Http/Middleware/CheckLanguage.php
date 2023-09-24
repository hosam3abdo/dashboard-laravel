<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\traits\ApiTrait;
use Illuminate\Support\Facades\App;

class CheckLanguage
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
        $lang = $request->header('accept-language');
        if(is_null($lang)){
            return $this->ErrorMessage(['language'=>'Language Key Is Missed'],"You Must Send Request Language");
        }
        $supportedLanguage = ['en','ar'];
        if(! in_array($lang,$supportedLanguage)){
            return $this->ErrorMessage(['language'=>'This Language Is not Supported'],"You Must Send Correct Language Key");
        }
        App::setLocale($lang);
        return $next($request);
    }
}
