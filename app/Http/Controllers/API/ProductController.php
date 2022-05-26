<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * To create product data
     * 
     * @author yannaingaung
     * @create 25/05/2022
     * @param Request $request
     * @return Response object
     */
    public function create(Request $request){
        $insert = [
            'name'=>$request->name,
            'code'=>$request->code,
            'description'=>$request->description,
            'created_emp'=>$request->login_id,
            'updated_emp'=>$request->login_id,
            'created_at'=>now(),
            'updated_at'=>now(),
        ];

        DB::beginTransaction();
        try{
            Product::insert($insert);

            DB::commit();
            return response()->json(['status'=>'OK', 'message'=>'Created Successfully!'],200);
        }catch(Exception $e){
            DB::rollBack();
            Log::debug($e->getMessage());
            return response()->json(['status'=>'NG','message'=>'Fail to save!'],200);
        }
    }

    /**
     * To create product data
     * 
     * @author yannaingaung
     * @create 25/05/2022
     * @return Response object
     */
    public function index()
    {
        # get all data from `products` table
        $products = Product::whereNull('deleted_at')->get();
        Log::info($products);

        # check products is exists or not
        if (!empty($products)) {
            return response()->json(['status'=>'OK', 'data'=>$products],200);
        } else {
            return response()->json(['status'=>'NG','message'=>'Data is not found!'],200);
        }
    }
}
