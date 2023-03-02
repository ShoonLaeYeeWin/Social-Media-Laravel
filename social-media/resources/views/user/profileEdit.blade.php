@extends('layouts')
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
@section('head')
<div class="container profile-blk py-3 px-5 mt-5 w-50 border border-dark rounded-2">
    <a href="{{url('/user/profile')}}"><i class="fa-solid fa-arrow-left"></i></a>
    <h2 class="ttl">Profile Edit</h2>
    <form action="{{url('user/update/profile',$user->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="input-gp">
            <label for="">Name:</label>
            <input type="text" name="editName" id="" value="{{old('name',$user->name)}}" placeholder="Enter Your Name...">
            @error('editName')
            <span class="text-danger text-sm"><b>{{$message}}</b></span>
            @enderror
        </div>
        <div class="input-gp">
            <label for="">Email:</label>
            <input type="email" name="editEmail" id="" value="{{old('email',$user->email)}}" placeholder="Enter Your Email...">
            @error('editEmail')
            <span class="text-danger text-sm"><b>{{$message}}</b></span>
            @enderror
        </div>
        <div class="input-gp">
            <label for="">Address:</label>
            <textarea name="editAddress" id="" rows="5" placeholder="Enter Your Address...">{{old('address',$user->address)}}</textarea>
            @error('editAddress')
            <span class="text-danger text-sm"><b>{{$message}}</b></span>
            @enderror
        </div>
        <div class="input-gp">
            <label for="">Date Of Birth:</label>
            <input type="date" name="editDob" id="" value="{{old('dob',$user->dob)}}">
            @error('editDob')
            <span class="text-danger text-sm"><b>{{$message}}</b></span>
            @enderror
        </div>
        <div class="input-gp">
            <label for="">Phone Number:</label>
            <input type="text" name="editPhone" id="" placeholder="Enter Your Phone Number..." value="{{old('phone',$user->phone)}}">
            @error('editPhone')
            <span class="text-danger text-sm"><b>{{$message}}</b></span>
            @enderror
        </div>
        <div class="input-gp">
            <label for="">Profile Photo:</label>
            <input type="file" name="editPhoto" id="image" class="custom-file-input">
            @error('editPhoto')
            <span class="text-danger text-sm"><b>{{$message}}</b></span>
            @enderror
       </div>
        <button type="submit" class="reg-btn mt-5">Update</button>
    </form>
</div>
@endsection
