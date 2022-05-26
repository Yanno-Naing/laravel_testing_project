<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('home', function(){
//     return response()->json(['status'=>'OK','success'=>true], 200);
// })->middleware('checkage');

// Route::middleware('checkage','checkgender')->group(function (){

//     Route::get('home', function(){
//         return response()->json(['status'=>'OK','success'=>true], 200);
//     });
//     Route::get('contact', function(){
//         return response()->json(['status'=>'OK','success'=>true], 200);
//     });

// });


Route::middleware('userlogin')->group(function(){
    Route::get('home', function(){
        return response()->json(['status'=>'OK','success'=>true], 200);
    });
    Route::get('product_detail', function(){
        return response()->json(['status'=>'OK','success'=>true], 200);
    });
});

Route::middleware('useracc')->group(function (){
    Route::get('view', function(){
        return response()->json(['status'=>'OK','success'=>true], 200);
    });
    Route::get('edit', function(){
        return response()->json(['status'=>'OK','success'=>true], 200);
    });
    Route::get('delete', function(){
        return response()->json(['status'=>'OK','success'=>true], 200);
    });

});

Route::post('products/create', 'API\ProductController@create');

Route::get('products/index', 'API\ProductController@index');