

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>User Registration Form</h1>
    @if ($errors->any())
    <div style="color:red">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('message'))
    <div style="color:blue">
        <ul>
                <li>{{ session('message') }}</li>
        </ul>
    </div>
    @endif

    
    <form action="{{ url('user-custom-register') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ request()->input('name',old('name')) }}">
        <br><br>
        <label for="ftname">Father Name:</label>
        <input type="text" name="father_name" id="ftname" value="{{ request()->input('father_name',old('father_name')) }}">
        <br><br>
        <label for="nrc">NRC:</label>
        <input type="text" name="NRC" id="nrc" value="{{ request()->input('NRC',old('NRC')) }}">
        <br><br>
        <label for="phno">Phone Number:</label>
        <input type="number" name="phone_no" id="phno" value="{{ request()->input('phone_no',old('phone_no')) }}">
        <br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ request()->input('email',old('email')) }}">
        <br><br>
        <label for="address">Address:</label>
        <textarea name="address" id="address" cols="30" rows="7">{{ request()->input('address',old('address')) }}</textarea>
        <br><br>
        <label for="gender">Gender:</label>
        
        Male<input type="radio" name="gender" id="gender" value="1" >
        
        Female<input type="radio" name="gender" id="gender" value="2">
        <br><br>
        <label for="birthday">Birthday:</label>
        <input type="date" id="birthday" name="birthday" value="{{ request()->input('birthday',old('birthday')) }}">
        <br><br>
        <label for="image">Add Photo:</label>
        <input type="file" id="image" name="image">
        <br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>