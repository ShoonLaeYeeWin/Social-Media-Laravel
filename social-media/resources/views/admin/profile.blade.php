@extends('admin.dashboard')
<title>Profile | Admin</title>
@section('dashboard')
<div class="container profile-blk shadow-lg pb-5">
    <div class="row">
        <h2 class="text-center mt-4 ttl">Admin Profile</h2>
        <a href="{{url('/admin/edit/profile')}}"><i class="fa-solid fa-user-pen"></i></a>
        <div class="mt-5 d-flex justify-content-around">
            <h5>Name:</h5>
            <p>{{$user->name}}</p>
        </div>
        <div class="mt-2 d-flex justify-content-around">
            <h5>Email:</h5>
            <p>{{$user->email}}</p>
        </div>
        <div class="mt-2 d-flex justify-content-around">
            <h5>Address:</h5>
            <p>{{$user->address}}</p>
        </div>
        <div class="mt-2 d-flex justify-content-around">
            <h5>Phone Number:</h5>
            <p>{{$user->phone}}</p>
        </div>
        <div class="mt-2 d-flex justify-content-around">
            <h5>Date Of Birth:</h5>
            <p>{{$user->dob}}</p>
        </div>
    </div>
</div>
@endsection