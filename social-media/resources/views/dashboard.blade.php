@extends('layouts')
@section('header')
<h1 class="main-ttl">Social Media Project</h1>
<div class="auth">
    <button><i class="fa-solid fa-arrow-right-to-bracket"></i> <a href="{{url('/login')}}">Login</a></button>
    <button class="register"><i class="fa-solid fa-registered"></i> <a href="{{url('/register')}}">Register</a></button>
</div>
<img src="{{ asset('img/img_dashboardView.png') }}" alt="Dashboard View" class="dashboard-img">
@endsection