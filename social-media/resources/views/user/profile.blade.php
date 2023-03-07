@extends('layouts')
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
@section('head')
    <!-- ======= Navbar ======= -->
    <nav class="navbar navbar-expand-lg bg-white border-bottom fixed-top">
        <div class="container-fluid me-5 ms-3">
            <a class="navbar-brand" href="#"><i class="fa-solid fa-circle"></i> <i class="fa-solid fa-circle me-3"></i>
                Admin
                Logo</a>
            <div class="collapse navbar-collapse d-flex justify-content-end align-items-center mx-3"
                id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-content-between align-items-center w-100">
                    <li class="nav-item w-100">
                        <h4 class="pt-1">{{ Auth::user()->name }}</h4>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            @if (Auth::user()->photo == null)
                                <img src="{{ asset('img/img_emptyProfile.png') }}" alt="Profile"
                                    class="rounded-circle mw-100" style="width: 25px; height: 25px; object-fit: cover;">
                            @else
                                <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Profile"
                                    class="rounded-circle mw-100" style="width: 25px; height: 25px; object-fit: cover;">
                            @endif
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('/user/profile') }}"><i
                                        class="fa-solid fa-user me-3"></i>
                                    Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ url('user/list/post') }}"><i
                                        class="fa-solid fa-pen-to-square me-3"></i>
                                    My Post</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ url('/auth/logout') }}"><i
                                        class="fa-solid fa-right-from-bracket me-3"></i> Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
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
                <a href="{{url('/user/edit/profile',Auth::user()->id)}}"><i class="fa-solid fa-user-pen pe-4"></i></a>
            </div>
            <h2 class="text-center mt-4 ttl">User Profile</h2>

<div class="info-blk w-75 d-flex flex-column justify-content-center">
    <div class="mt-5 d-flex justify-content-between">
        <h5>Name:</h5>
        <p>{{Auth::user()->name}}</p>
    </div>
    <div class="mt-2 d-flex justify-content-between">
        <h5>Email:</h5>
        <p>{{Auth::user()->email}}</p>
    </div>
    <div class="mt-2 d-flex justify-content-between">
        <h5>Address:</h5>
        <p>{{Auth::user()->address}}</p>
    </div>
    <div class="mt-2 d-flex justify-content-between">
        <h5>Phone Number:</h5>
        <p>{{Auth::user()->phone}}</p>
    </div>
    <div class="mt-2 d-flex justify-content-between">
        <h5>Date Of Birth:</h5>
        <p>{{Auth::user()->dob}}</p>
    </div>
    <div class="mt-2 d-flex justify-content-between">
        <h5>Photo:</h5>
        @if (Auth::user()->photo == NULL)
        <img src="{{asset('img/img_emptyProfile.png')}}" alt="" style="max-width: 100px;height: 100px;object-fit: cover;">
        @else
        <img src="{{asset('storage/'.Auth::user()->photo)}}" alt="" style="max-width: 100px;height: 100px;object-fit: cover;">
        @endif
    </div>
</div>
        </div>
    </div>
</div>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
@endsection
