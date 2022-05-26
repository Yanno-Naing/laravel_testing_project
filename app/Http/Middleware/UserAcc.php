<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class UserAcc
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
        //Log::alert($request);
        $arr = [];
        $error = false;
        if( $request->product_id == null || (!is_numeric($request->product_id))){
            $error = true;
            array_push($arr,'Invalid Product ID');
        }
        if($request->vouncher_id == null || (!is_numeric($request->vouncher_id))){
            //Log::alert("true");
            $error = true;
            array_push($arr,'Invalid Vouncher ID');
            //Log::info($arr);
        }
        //Log::alert($arr);
        if($error){
            return response()->json(['status'=>'NG','message'=>$arr],200);
        }
        return $next($request);
    }
}
