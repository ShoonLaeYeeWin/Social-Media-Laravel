@extends('layouts')
<title>PostCreate | User</title>
@section('head')
<div class="container  inner con-reg">
  <a href="{{ route('post.listPost') }}"><i class="fa-solid fa-arrow-left"></i></a>
  <h2 class="ttl text-white">Post Create</h2>
  <form action="{{ route('post.createPost') }}" method="POST">
    @csrf
    <div class="input-gp">
      <label for="">Post Title:</label>
      <input type="text" name="title" id="" value="{{ old('title') }}" placeholder="Enter Your Post Title...">
      @error('title')
      <span class="text-danger text-sm"><b>{{ $message }}</b></span>
      @enderror
    </div>
    <div class="input-gp">
      <label for="">Post Content:</label>
      <textarea name="content" id="" rows="5" placeholder="Enter Your Post  Content...">{{ old('content') }}</textarea>
      @error('content')
      <span class="text-danger text-sm"><b>{{ $message }}</b></span>
      @enderror
    </div>
    <button type="submit" class="reg-btn mt-5">Create</button>
  </form>
</div>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
@endsection
