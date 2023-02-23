@extends('admin.dashboard')
<title>Profile | Admin</title>
@section('dashboard')
<div class="container profile-blk shadow-lg pb-5">
    @if (session('updateSuccess'))
    <div class="alert alert-success alert-dismissible fade show mt-5 mb-3 m-auto w-75 text-center" role="alert">
        <strong>{{ session('updateSuccess') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <i class="fa-sharp fa-solid fa-xmark"></i>
        </button>
      </div>
    @endif
    <div class="row">
        <h2 class="text-center mt-4 ttl">Admin Profile</h2>
        <a href="{{url('/admin/edit/profile',$user->id)}}"><i class="fa-solid fa-user-pen"></i></a>
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
        <div class="mt-2 d-flex justify-content-around">
            <h5>Photo:</h5>
            @if ($user['photo'] == NULL)
            <img src="{{asset('img/img_emptyProfile.png')}}" alt="" style="max-width: 100px;height: 100px;object-fit: cover;">
            @else
            <img src="{{asset('storage/'.$user['photo'])}}" alt="" style="max-width: 100px;height: 100px;object-fit: cover;">
            @endif
        </div>
    </div>
</div>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
@endsection
