@extends('auth.layouts')
<title>Login | Admin |Social Media</title>
@section('header')
<div class="container">
    <a href="{{url('/')}}"><i class="fa-solid fa-arrow-left"></i></a>
    <h2 class="ttl">Admin Login</h2>
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
</div>
@endsection