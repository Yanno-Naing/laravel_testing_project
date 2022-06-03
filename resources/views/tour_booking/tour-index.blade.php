@extends('tour_booking.layout')

@section('style')
<style>
        h1{
            text-align:center;
        }
        .text-red{
            color:red;
        }
    </style>
@endsection

@section('content')
    <h1>Tour Booking Form</h1>
        <form action="{{ url('tour-save') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name*</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Name"
                    value="{{ request()->input('address',old('address')) }}">
                @if($errors->has('name'))
                    <div id="name" class="form-text text-red">{{ $errors->first('name') }}</div>
                @endif
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email*</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ request()->input('email',old('email')) }}">
                @if($errors->has('email'))
                    <div class="form-text text-red">{{ $errors->first('email') }}</div>
                @endif
            </div>

            <div class="mb-3">
                <label for="phno" class="form-label">Phone*</label>
                <input type="number" name="phone_no" class="form-control" id="phno" value="{{ request()->input('phone_no',old('phone_no')) }}">
                 @if($errors->has('phone_no'))
                    <div class="form-text text-red">{{ $errors->first('phone_no') }}</div>
                @endif
            </div>

            <div class="mb-3">
                <label for="tour_date" class="form-label">When are you planning to visit? (From ~ To)*</label>
                <input type="date" id="tour_date" class="form-control" name="from_date" value="{{ request()->input('address',old('address')) }}">
                <input type="date" id="tour_date" class="form-control"  name="to_date" value="{{ request()->input('address',old('address')) }}">
                @if($errors->has('to_date'))
                    <div class="form-text text-red">{{ $errors->first('to_date') }}</div>
                @endif
            </div>

            <div class="mb-3">
                <label for="num_of_ppl" class="form-label">How many people are in your group?*</label>
                <input type="number" name="num_of_ppl" class="form-control" id="num_of_ppl" min="0" max="20" value="{{ request()->input('address',old('address')) }}">
                 @if($errors->has('num_of_ppl'))
                    <div class="form-text text-red">{{ $errors->first('num_of_ppl') }}</div>
                @endif
            </div>

            <div class="mb-3">
                <label for="tour" class="form-label">Which tours or events are you interested in?*</label>
                <input type="text" name="tour" class="form-control" id="tour" value="{{ request()->input('address',old('address')) }}">
            </div>
        
            <div class="mb-3">
                <label for="flexCheckDefault" class="form-label">What is the best way to contact you?*</label>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" name="contact[]" value="phone" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault"> Phone</label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" name="contact[]" value="email" id="flexCheckChecked">
                <label class="form-check-label" for="flexCheckChecked"> Email</label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" name="contact[]" value="other" id="flexCheckChecked">
                <label class="form-check-label" for="flexCheckChecked"> Other</label>
                </div>
                 @if($errors->has('contact'))
                    <div class="form-text text-red">{{ $errors->first('contact') }}</div>
                @endif
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Attach File*</label>
                <input type="file" id="image" class="form-control" name="tour_image">
                 @if($errors->has('tour_image'))
                    <div class="form-text text-red">{{ $errors->first('tour_image') }}</div>
                @endif
            </div>  
            <input type="submit" class="btn btn-primary" value="Submit">
        </form>
@endsection
