<?php

namespace App\Http\Middleware;

use Closure;

class CheckGender
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->gender !== 'male'){
            return response()->json(['status'=>'NG','message'=>'You are not male!'],200);
        }
        return $next($request);
    }
}
