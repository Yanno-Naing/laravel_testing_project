<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

/**
 * To handle category data
 * 
 * @author yannaingaung
 * @create 26/05/2022
 */
class CategoryController extends Controller
{
    /**
     * Display a listing of the category.
     *
     * @author yannaingaung
     * @create 26/05/2022
     * @return Response object
     */
    public function index()
    {
        # get all data from `products` table
        $categories = Category::whereNull('deleted_at')->get();
        Log::info($categories);

        # check products is exists or not
        if ($categories->isNotEmpty()) {            //* isNotEmpty() to check object  - laravel object method
            return response()->json(['status'=>'OK', 'data'=>$categories],200);
        } else {
            return response()->json(['status'=>'NG','message'=>'Data is not found!'],200);
        }
    }

    /**
     * Store a newly created category in storage.
     *
     * @author yannaingaung
     * @create 26/05/2022
     * @param  Request  $request
     * @return Response object
     */
    public function store(Request $request)
    {
        $category_name = $request->category_name;

        # checking whether inserted category is exist or not
        $checkcat = Category::where('category_name',$category_name)->exists(); 
        
        if(!$checkcat){
            $insert = [
                'category_name'=>$request->category_name,
                'created_emp'=>$request->login_id,
                'updated_emp'=>$request->login_id,
                'created_at'=>now(),
                'updated_at'=>now(),
            ];

            DB::beginTransaction();
            try{
                Category::insert($insert);
                DB::commit();
                return response()->json(['status'=>'OK', 'message'=>'Created Successfully!'],200);
            }catch(Exception $e){
                DB::rollBack();
                Log::debug($e->getMessage());
                return response()->json(['status'=>'NG','message'=>'Fail to save!'],200);
            }
        }else{
            return response()->json(['status'=>'NG','message'=>'Category already exist!'],200);
        }

        
    }

    /**
     * Display category detail.
     *
     * @author yannaingaung
     * @create 26/05/2022
     * @param  int  $id
     * @return Response object
     */
    public function show($id)
    {
        $category = Category::where('id',$id)->get();

        if($category->isNotEmpty()){
            return response()->json(['status'=>'OK', 'data'=>$category],200);
        }else{
            return response()->json(['status'=>'NG','message'=>'Data is not found!'],200);
        }
    }

    /**
     * Update a category item in storage.
     *
     * @author yannaingaung
     * @create 26/05/2022
     * @param  Request  $request
     * @param  int  $id
     * @return Response object
     */
    public function update(Request $request, $id)
    {
        $checkid = Category::where('id',$id)->exists();

        if($checkid){

            $category_name = $request->category_name;

            $checkcat = Category::where('category_name',$category_name)->exists(); 

            if(!$checkcat){
                $updates = [
                    'category_name'=>$request->category_name,
                    'updated_emp'=>$request->login_id,
                    'updated_at'=>now(),
                ];
    
                DB::beginTransaction();
                try{
                    Category::where('id',$id)->update($updates);
                    DB::commit();
                    return response()->json(['status'=>'OK','message'=>'Updated Successfully!'],200);
                }catch( Exception $e ){
                    DB::rollBack();
                    Log::debug($e->getMessage());
                    return response()->json(['status'=>'NG','message'=>'Fail to update!'],200);
                }
            }else{
                return response()->json(['status'=>'NG','message'=>'Category already exist!'],200);
            }

        }else{
            return response()->json(['status'=>'NG','message'=>'Category does not exist!'],200);
        }
        
    }

    /**
     * Remove a category item from storage.
     *
     * @author yannaingaung
     * @create 26/05/2022
     * @param  int  $id
     * @return Response object
     */
    public function destroy($id)
    {
        $check_query = Category::where('id',$id)->exists();

        if($check_query){
            DB::beginTransaction();
            try{
                Category::where('id',$id)->delete();
                DB::commit();
                return response()->json(['status'=>'OK','message'=>'Deleted Successfully!'],200);
            }catch( Exception $e ){
                DB::rollBack();
                Log::debug($e->getMessage());
                return response()->json(['status'=>'NG','message'=>'Fail to delete!'],200);
            }
        }else{
            return response()->json(['status'=>'NG','message'=>'Category does not exist!'],200);
        }
        
    }
}
