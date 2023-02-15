@extends('auth.layouts')
<title>Register | User |Social Media</title>
@section('header')
<div class="container con-reg">
    <a href="{{url('/login')}}"><i class="fa-solid fa-arrow-left"></i></a>
    <h2 class="ttl">Register</h2>
    <form action="{{ url('auth/create/register')}}" method="POST">
        @csrf
        <div class="input-gp">
            <label for="">Name:</label>
            <input type="text" name="name" id="" value="{{old('name')}}" placeholder="Enter Your Name...">
            @error('name')
            <span class="text-danger text-sm"><b>{{$message}}</b></span>
            @enderror
        </div>
        <div class="input-gp">
            <label for="">Email:</label>
            <input type="text" name="email" id="" value="{{old('email')}}" placeholder="Enter Your Email...">
            @error('email')
            <span class="text-danger text-sm"><b>{{$message}}</b></span>
            @enderror
        </div>
        <div class="input-gp">
            <label for="">Password:</label>
            <input type="password" name="password" value="{{old('password')}}" id="" placeholder="Enter Your Password...">
            @error('password')
            <span class="text-danger text-sm"><b>{{$message}}</b></span>
            @enderror
        </div>
        <div class="input-gp">
            <label for="">Confirm Password:</label>
            <input type="password" name="confirm_password" value="{{old('confirm_password')}}" id="" placeholder="Enter Your Confirm Password...">
            @error('confirm_password')
            <span class="text-danger text-sm"><b>{{$message}}</b></span>
            @enderror
        </div>
        <button type="submit" class="reg-btn">Register</button>
    </form>
</div>
@endsection