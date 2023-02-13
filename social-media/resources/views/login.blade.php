@extends('layouts')
<title>Login | Social Media</title>
@section('header')
<div class="container">
    <h2 class="ttl">Login</h2>
    <form action="">
        <div class="input-gp">
            <label for="">Email:</label>
            <input type="email" name="" id="">
        </div>
        <div class="input-gp">
            <label for="">Password:</label>
            <input type="password" name="" id="">
        </div>
        <button type="submit" class="login">Login</button>
    </form>
    <p class="register-link">Don't have an account?<a href="{{ url('/register')}}" class="reg-route"> Register Here!</a></p>
</div>
@endsection