@extends('tour_booking.layout')

@section('style')

@endsection

@section('content')
        <h1>Your Booking Result</h1>
        <p>Confirm your data back.</p>
        <div class="content-container">
            <h4>Name: </h4>
            <p>{{ $userData['name'] }}</p>
            <h4>Email: </h4>
            <p>{{ $userData['email'] }}</p>
            <h4>Phone: </h4>
            <p>{{ $userData['phone_no'] }}</p>
            <h4>Travel Date: </h4>
            <p>{{ $userData['from_date'] }} - {{ $userData['to_date'] }}</p>
            <h4>Number of People: </h4>
            <p>{{ $userData['num_of_ppl'] }}</p>
            <h4>Interested Tour and Event: </h4>
            <p>{{ $userData['tour'] }}</p>
            <h4>Contact: </h4>
            <p>
                @foreach($userData['contact'] as $contact)
                    {{$contact}}
                @endforeach
            </p>
            <?php  $file = $userData['tour_image']->getClientOriginalName(); ?>
            <img src="{{ asset('storage/TourBookingFiles/'.$file) }}" alt=""><br>
            <a href="{{ url('/tour-index') }}" class="btn btn-primary" role="button">Back</a>
        </div>
        
@endsection