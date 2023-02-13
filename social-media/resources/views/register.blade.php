@extends('layouts')
<title>Register | Social Media</title>
@section('header')
<div class="container con-reg">
    <i class="fa-solid fa-arrow-left"></i>
    <h2 class="ttl">Register</h2>
    <form action="">
        <div class="input-gp">
            <label for="">Name:</label>
            <input type="text" name="" id="">
        </div>
        <div class="input-gp">
            <label for="">Email:</label>
            <input type="email" name="" id="">
        </div>
        <div class="input-gp">
            <label for="">Password:</label>
            <input type="password" name="" id="">
        </div>
        <div class="input-gp">
            <label for="">Confirm Password:</label>
            <input type="cpassword" name="" id="">
        </div>
        <button type="submit" class="reg-btn">Register</button>
    </form>
</div>
@endsection