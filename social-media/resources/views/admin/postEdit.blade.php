@extends('admin.dashboard')
<title>PostEdit | Admin</title>
@section('dashboard')
<div class="container profile-blk shadow-lg pb-5">
    <a href="{{url('admin/list/post')}}"><i class="fa-solid fa-arrow-left"></i></a>
    <h2 class="ttl">Post Edit</h2>
    <form action="{{url('admin/update/post',$post->id)}}" method="POST">
        @csrf
        <div class="input-gp">
            <label for="">Post Title:</label>
            <input type="text" name="title" id="" value="{{old('title',$post->title)}}" placeholder="Enter Your Post Title...">
            @error('title')
            <span class="text-danger text-sm"><b>{{$message}}</b></span>
            @enderror
        </div>
        <div class="input-gp">
            <label for="">Post Content:</label>
            <textarea name="content" id="" rows="5" placeholder="Enter Your Post  Content...">{{old('content',$post->content)}}</textarea>
            @error('content')
            <span class="text-danger text-sm"><b>{{$message}}</b></span>
            @enderror
        </div>
        <button type="submit" class="reg-btn mt-5">Update</button>
    </form>
</div>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
@endsection
