@extends('layouts')
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
@section('head')
<div class="wrapper d-flex justify-content-center align-items-center vh-100">
    <div class="profile-blk shadow-lg pb-5 border border-dark w-50">
        @if (session('updateSuccess'))
        <div class="alert alert-success alert-dismissible fade show mt-5 mb-3 m-auto w-75 text-center" role="alert">
            <strong>{{ session('updateSuccess') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <i class="fa-sharp fa-solid fa-xmark"></i>
            </button>
          </div>
        @endif
        <div class="row d-flex justify-content-center">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{url('/user/dashboard')}}" class="m-3"><i class="fa-solid fa-arrow-left ps-4"></i></a>
                <a href="{{url('/user/edit/profile',$user->id)}}"><i class="fa-solid fa-user-pen pe-4"></i></a>
            </div>
            <h2 class="text-center mt-4 ttl">User Profile</h2>

<div class="info-blk w-75 d-flex flex-column justify-content-center">
    <div class="mt-5 d-flex justify-content-between">
        <h5>Name:</h5>
        <p>{{$user->name}}</p>
    </div>
    <div class="mt-2 d-flex justify-content-between">
        <h5>Email:</h5>
        <p>{{$user->email}}</p>
    </div>
    <div class="mt-2 d-flex justify-content-between">
        <h5>Address:</h5>
        <p>{{$user->address}}</p>
    </div>
    <div class="mt-2 d-flex justify-content-between">
        <h5>Phone Number:</h5>
        <p>{{$user->phone}}</p>
    </div>
    <div class="mt-2 d-flex justify-content-between">
        <h5>Date Of Birth:</h5>
        <p>{{$user->dob}}</p>
    </div>
    <div class="mt-2 d-flex justify-content-between">
        <h5>Photo:</h5>
        @if ($user['photo'] == NULL)
        <img src="{{asset('img/img_emptyProfile.png')}}" alt="" style="max-width: 100px;height: 100px;object-fit: cover;">
        @else
        <img src="{{asset('storage/'.$user['photo'])}}" alt="" style="max-width: 100px;height: 100px;object-fit: cover;">
        @endif
    </div>
</div>
        </div>
    </div>
</div>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
@endsection
