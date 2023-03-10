@extends('layouts')
<title>Login | Admin </title>
@section('head')
<div class="container inner">
  @if (session('loginError'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ session('loginError') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <i class="fa-sharp fa-solid fa-xmark"></i>
    </button>
  </div>
  @endif
  <a href="{{ url('/') }}"><i class="fa-solid fa-arrow-left"></i></a>
  <h2 class="ttl">Admin Login</h2>
  <form action="{{ route('admin.actionLogin') }}" method="POST">
    @csrf
    <div class="input-gp">
      <label for="">Email:</label>
      <input type="text" name="email" id="" value="{{ old('email') }}" placeholder="Enter Your Email...">
      @error('email')
      <span class="text-danger text-sm"><b>{{ $message }}</b></span>
      @enderror
    </div>
    <div class="input-gp">
      <label for="">Password:</label>
      <input type="password" name="password" value="{{ old('password') }}" id="" placeholder="Enter Your Password...">
      @error('password')
      <span class="text-danger text-sm"><b>{{ $message }}</b></span>
      @enderror
    </div>
    <button type="submit" class="login">Login</button>
  </form>
</div>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
@endsection
