@extends('auth.layouts')

@section('content')

<h1>login</h1>
<form action="{{  route('authenticate') }}" method="POST">
<br><br>
@csrf
    <label>Email Address</label>label><br>
    <input type="email" id="email" name="email" value="{{ old('email') }}"><br><br>
    <label>password</label><br>
    <input type="password" id="password" nam="password"><br>
    <input type="submit" value="Login">
    </form>

    @endsection 