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


Route::prefix('products')->group(function (){

    Route::post('create', 'API\ProductController@create');

    Route::get('index', 'API\ProductController@index');

    Route::put('update/{id}', 'API\ProductController@update');

    Route::delete('delete/{id}', 'API\ProductController@delete');
});

Route::apiResource('categories', 'API\CategoryController');


#Request & Response

Route::any('/test-request/{name}','TestRequestController@apiRequest');

Route::any('/test-response','TestRequestController@apiResponse');

Route::post('/file-upload','TestRequestController@fileUpload');


# Validation

Route::post('/user-register', 'ValidationController@register');

Route::post('/user-custom-register', 'ValidationController@customRequest');