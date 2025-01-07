@extends('auth.layouts')

@sectin('content')
<h1>Register</h1>
<a href="{{ route('login') }}>login</a>
<br><br>
<form action="{{ route('store') }} method="POST">

@csrf
<label>Nama Lengkap</label><br>
<input type="text" id="name" name="name" value="{{ old('name') }}"><br>

@if($errors->has('name'))
<span class="text-danger">{{ $errors->firdt('name') }}</span>
@endif

<br>
<label>Email Address</label><br>
<input type="email" id="email" name="email" value="{{ old('email') }}"><br>

@if  ($errors->has('email'))
<span class="tex-danger">{{ $errors->first('email') }}</span>
@endif

<br>
<label>password <label><br>
<input type="password" id="password" name="pasword"><br>

@if ($errors->has('pasword'))
<span class="text-denger">{{ $errors->first('password') }}</span>
@endif

<br>
<lab for="password_ confirmation" class="col-md-4 col-form-label text-md-end text-start">comfirmation">
    <div class="col-md-6">
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>
        <input type="submit" value="Register">
</form>
@endsection