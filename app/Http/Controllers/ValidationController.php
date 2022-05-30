<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TestRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ValidationController extends Controller
{
    
    public function register (Request $request)
    {
        // $validator = Validator::make($request->all(),[
        //     'name'=>'required',
        //     'age' => ['required','integer']
        // ]);

        // if ($validator->fails()) {
        //     return response()->json($validator->errors()->all(), 422);
        //     return response()->json($validator->errors()->first(), 422);
        //     return response()->json($validator->errors()->get('name'), 422);
        // }

        
        $rules = [
            'name'=>'required',
            'age' => ['required','integer']
        ];

        $customMessages = [
            'name.required' => 'The :attribute field needed.',
            'age.required' => 'The :attribute field needed.',
            'age.integer' => 'The :attribute is not integer.'
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return response()->json($validator->errors()->all(), 422);
            // return response()->json($validator->errors()->first(), 422);
            // return response()->json($validator->errors()->get('name'), 422);
        }
    }

    public function customRequest (TestRequest $request)
    {
        // $rules = [
        //     'name' => 'required|alpha',
        //     'father_name' => 'nullable',
        //     'NRC' => ['required','regex:/(^([0-9]{1,2})\/([A-Z][a-z]|[A-Z][a-z][a-z])([A-Z][a-z]|[A-Z][a-z][a-z])([A-Z][a-z]|[A-Z][a-z][a-z])\([N,P,E]\)[0-9]{6}$)/u'],
        //     'phone_no' => 'bail|required|regex:/^([0-9]*)$/|digits:11',
        //     'email' => 'required|email:rfc,dns',
        //     'address' => 'nullable',
        //     'gender' => 'required|numeric|between:1,2',
        //     'birthday' => 'required|date',    // d-m-y
        //     'image' => 'required|image|mimes:jpeg,jpg,png|max:10240',
        // ];


        // $validator = Validator::make($request->all(), $rules);

        // if ($validator->fails()) {
        //     return response()->json($validator->errors()->all(), 422);
        // } else {
        //     return response()->json(['status'=>'OK','message'=>'success'], 200);
        // }

        // return response()->json(['status'=>'OK','data'=>$request->all()], 200);
        Log::info($request->all()); 
        
        //  return Redirect::back()->with('message','Data submitted successfully.');

        return redirect('success')->with('message','Data submitted successfully.');
    }

    public function userRegister(){
        return view('registration_form.register');
    }
}
