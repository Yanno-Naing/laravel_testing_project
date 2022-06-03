<?php

namespace App\Http\Controllers\TourBooking;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\TourBookingRequest;

class TourBookingController extends Controller
{
    public function index()
    {
        return view('tour_booking.tour-index');
    }

    public function save(TourBookingRequest $request)
    {
        //Log::info($request->validated());
        

        $fileName = $request->tour_image->getClientOriginalName();  
        $request->tour_image->move(storage_path('app/public/TourBookingFiles'), $fileName);
       
        $path = storage_path().'/app/public/TourBookingFiles/'.$fileName;
        // Log::info($path); 
        $img = Image::make($path)->resize(400, 240)->save();

        return view('tour_booking.tour-show',['userData'=>$request->all()])->with('message','Data Recorded Successfully.');
    }

    public function show()
    {
        return view('tour_booking.tour-show');
    }

}
