<?php

namespace App\Http\Middleware;

use Closure;

class UserLogin
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
        $arr = [];
        $error = false;
        if(!is_numeric($request->login_id)){
            $error = true;
            array_push($arr,'Invalid login');
        }
        if(empty($request->user_name)){
            $error = true;
            array_push($arr,'Uncomplete Request.');
        }
        if($error){
            return response()->json(['status'=>'NG','message'=>$arr],200);
        }
        
        return $next($request);
    }
}
