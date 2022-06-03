<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class TestRequestController extends Controller
{
    public function index($name){
        // Log::info(request());

        // Log::info(request()->url());

        // Log::info(request()->path());

        // Log::info(request()->method());

        // if(request()->isMethod('GET')){
        //     echo 'GET Method';
        // }

        // if(request()->has('name')){
        //     echo ' has name';
        // }else{
        //     echo 'no name';
        // }

        if(request()->hasAny('name','age')){
            echo ' has name or age';
        }
        if(request()->missing('name')){
            echo ' has no name';
        }
    }

    public function apiRequest(){
        if(request()->hasAny('name','age')){
            echo request();
        }
    }

    public function apiResponse(){
        return response('Hello World', 200)
                  ->header('Content-Type', 'text/plain');
    }

    public function redirect(){
        return view('test', ['message'=>'Hello Testing']);
    }

    public function fileDownload(){

        $tmpFileName = 'Laravel_Routing_NweniWin.pdf';
        $path = storage_path().'/app/'.$tmpFileName;

        $headers = [
            'Access-Control-Allow-Origin' => '*',
            'Content-Description' => 'File Transfer',
            'Content-Disposition' => 'attachment;filename=' . $tmpFileName,
            'Access-Control-Expose-Headers' => 'Content-Disposition,X-Suggested-Filename'
        ];
        return response()->download($path, $tmpFileName, $headers)->deleteFileAfterSend();

    }

    public function fileUpload(Request $request){
        //return $request->file;
        //$path = $request->file('file')->store('avatars');

        $fileName = $request->file->getClientOriginalName();  
        $contents = file_get_contents($request->file);
        //return $contents;

        Storage::put($fileName, $contents);
        //$request->file->move(storage_path('app'), $fileName);

        $path = storage_path().'/app/'.$fileName;

        $img = Image::make($path)->resize(400, 240)->save();

        // $img1 = storage_path().'/app/sample.jpg';
        // Image::canvas(800, 600, '#ccc')->save($img1);

        $headers = [
            'Access-Control-Allow-Origin' => '*',
            'Content-Description' => 'File Transfer',
            'Content-Disposition' => 'attachment;filename=' . $fileName,
            'Access-Control-Expose-Headers' => 'Content-Disposition,X-Suggested-Filename'
        ];
        return response()->download($path, $fileName, $headers);
        
    }
}
