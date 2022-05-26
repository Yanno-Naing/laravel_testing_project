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
    
        $code = $request->code;
        $name = $request->name;

        # checking whether inserted category is exist or not
        $checkproduct = Product::where('code',$code)->where('name',$name)->exists(); 
        
        if(!$checkproduct){
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
        }else{
            return response()->json(['status'=>'NG','message'=>'Product already exist!'],200);
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

    public function update(Request $request, $id)
    {
        $checkid = Product::where('id',$id)->exists();

        if($checkid){

            $code = $request->code;
            $name = $request->name;

            $checkproduct = Product::where('code',$code)->where('name',$name)->exists(); 
        
            if(!$checkproduct){
                $updates = [
                    'name'=>$request->name,
                    'code'=>$request->code,
                    'description'=>$request->description,
                    'updated_emp'=>$request->login_id,
                    'updated_at'=>now(),
                ];
                //dd($updates);
                DB::beginTransaction();
                try {
                    Product::where('id',$id)->update($updates);
                    DB::commit();
                    return response()->json(['status'=>'OK', 'message'=>'Updated Successfully!'],200);
                } catch(Exception $e){
                    DB::rollBack();
                    Log::debug($e->getMessage());
                    return response()->json(['status'=>'NG','message'=>'Fail to update!'],200);
                }
            }else{
                return response()->json(['status'=>'NG','message'=>'Updated Product already exist!'],200);
            }

        }else{
            return response()->json(['status'=>'NG','message'=>'Product does not exist!'],200);
        }

    }

    public function delete($id)
    {
        $check_query = Product::where('id',$id)->exists();

        if($check_query){

            DB::beginTransaction();
            try {
                Product::where('id', $id)->delete();
                DB::commit();
                return response()->json(['status'=>'OK', 'message'=>'Deleted Successfully!'],200);
            } catch (Exception $e){
                DB::rollBack();
                Log::debug($e->getMessage());
                return response()->json(['status'=>'NG','message'=>'Fail to delete!'],200);
            }
        }else{
            return response()->json(['status'=>'NG','message'=>'Product does not exist!'],200);
        }
    }
}
