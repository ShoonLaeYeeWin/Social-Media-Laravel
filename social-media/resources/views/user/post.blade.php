@extends('layouts')
<title>Post | Social Media</title>
@section('head')
<div class="container  inner con-reg">
    @if (session('registerSuccess'))
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
        <strong>{{ session('registerSuccess') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <i class="fa-sharp fa-solid fa-xmark"></i>
        </button>
      </div>
    @endif
    <a href="{{url('/user/profile')}}"><i class="fa-solid fa-arrow-left"></i></a>
    <h2 class="ttl">Post Create</h2>
    <form action="{{url('user/create/post')}}" method="POST">  
        @csrf
        <div class="input-gp">
            <label for="">Post Title:</label>
            <input type="text" name="title" id="" value="{{old('title')}}" placeholder="Enter Your Post Title...">
            @error('title')
            <span class="text-danger text-sm"><b>{{$message}}</b></span>
            @enderror
        </div>
        <div class="input-gp">
            <label for="">Post Content:</label>
            <textarea name="content" id="" rows="5" placeholder="Enter Your Post  Content...">{{old('content')}}</textarea>
            @error('content')
            <span class="text-danger text-sm"><b>{{$message}}</b></span>
            @enderror
        </div>
        <button type="submit" class="reg-btn mt-5">Create</button>
    </form>
</div>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
@endsection