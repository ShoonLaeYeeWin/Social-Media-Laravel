@extends('layouts')
<title>Register | User </title>
@section('head')
<div class="container inner con-reg">
  <a href="{{ url('/') }}"><i class="fa-solid fa-arrow-left"></i></a>
  <h2 class="ttl text-white">Register</h2>
  <form action="{{ route('user.actionRegister') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="input-gp">
      <label for="">Name:</label>
      <input type="text" name="name" id="" value="{{ old('name') }}" placeholder="Enter Your Name...">
      @error('name')
      <span class="text-danger text-sm"><b>{{ $message }}</b></span>
      @enderror
    </div>
    <div class="input-gp">
      <label for="">Email:</label>
      <input type="email" name="email" id="" value="{{ old('email') }}" placeholder="Enter Your Email...">
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
    <div class="input-gp">
      <label for="">Confirm Password:</label>
      <input type="password" name="confirm_password" value="{{ old('confirm_password') }}" id=""
        placeholder="Enter Your Confirm Password...">
      @error('confirm_password')
      <span class="text-danger text-sm"><b>{{ $message }}</b></span>
      @enderror
    </div>
    <div class="input-gp">
      <label for="">Address:</label>
      <textarea name="address" id="" rows="5" placeholder="Enter Your Address...">{{ old('address') }}</textarea>
      @error('address')
      <span class="text-danger text-sm"><b>{{ $message }}</b></span>
      @enderror
    </div>
    <div class="input-gp">
      <label for="">Date Of Birth:</label>
      <input type="date" name="dob" id="" value="{{ old('dob') }}">
      @error('dob')
      <span class="text-danger text-sm"><b>{{ $message }}</b></span>
      @enderror
    </div>
    <div class="input-gp">
      <label for="">Phone Number:</label>
      <input type="text" name="phone" id="" placeholder="Enter Your Phone Number..." value="{{ old('phone') }}">
      @error('phone')
      <span class="text-danger text-sm"><b>{{ $message }}</b></span>
      @enderror
    </div>
    <div class="input-gp">
      <label for="">Profile Photo:</label>
      <input type="file" name="photo" id="image" class="custom-file-input">
      @error('photo')
      <span class="text-danger text-sm"><b>{{ $message }}</b></span>
      @enderror
    </div>
    <label for="">preview image</label><br>
    <img id="preview-image" src="" style="max-height: 150px;">
    <button type="submit" class="reg-btn mt-5">Register</button>
  </form>
</div>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
@endsection
