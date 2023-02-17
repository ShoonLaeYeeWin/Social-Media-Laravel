@extends('admin.dashboard')
<title>ProfileEdit | Admin</title>
@section('dashboard')
<div class="container profile-blk p-5">
    @if (session('updateSuccess'))
    <div class="alert alert-success alert-dismissible fade show mt-5 mb-3 m-auto w-50 text-center" role="alert">
        <strong>{{ session('updateSuccess') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <i class="fa-sharp fa-solid fa-xmark"></i>
        </button>
      </div>
    @endif
    <a href="{{url('/admin/profile')}}"><i class="fa-solid fa-arrow-left"></i></a>
    <h2 class="ttl">Profile Edit</h2>
    <form action="{{url('/delete/profile',$user->id)}}" method="POST">  
        @csrf
        <div class="input-gp">
            <label for="">Name:</label>
            <input type="text" name="name" id="" value="{{old('name',$user->name)}}" placeholder="Enter Your Name...">
            @error('name')
            <span class="text-danger text-sm"><b>{{$message}}</b></span>
            @enderror
        </div>
        <div class="input-gp">
            <label for="">Email:</label>
            <input type="email" name="email" id="" value="{{old('email',$user->email)}}" placeholder="Enter Your Email...">
            @error('email')
            <span class="text-danger text-sm"><b>{{$message}}</b></span>
            @enderror
        </div>
        <div class="input-gp">
            <label for="">Address:</label>
            <textarea name="address" id="" rows="5" placeholder="Enter Your Address...">{{old('address',$user->address)}}</textarea>
            @error('address')
            <span class="text-danger text-sm"><b>{{$message}}</b></span>
            @enderror
        </div>
        <div class="input-gp">
            <label for="">Date Of Birth:</label>
            <input type="date" name="dob" id="" value="{{old('dob',$user->dob)}}">
            @error('dob')
            <span class="text-danger text-sm"><b>{{$message}}</b></span>
            @enderror
        </div>
        <div class="input-gp">
            <label for="">Phone Number:</label>
            <input type="text" name="phone" id="" placeholder="Enter Your Phone Number..." value="{{old('phone',$user->phone)}}">
            @error('phone')
            <span class="text-danger text-sm"><b>{{$message}}</b></span>
            @enderror
        </div>
        <button type="submit" class="reg-btn mt-5">Update</button>
    </form>
</div>
@endsection