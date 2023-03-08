@extends('layouts')
<title>Dashboard | Admin</title>
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
@section('head')
<!-- ======= Navbar ======= -->
<nav class="navbar navbar-expand-lg bg-white border-bottom fixed-top">
    <div class="container-fluid me-5 ms-3">
      <a class="navbar-brand" href="#"><i class="fa-solid fa-circle"></i> <i class="fa-solid fa-circle me-3"></i> Admin Logo</a>
      <div class="collapse navbar-collapse d-flex justify-content-end align-items-center mx-3" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-content-between align-items-center w-100">
          <li class="nav-item w-25">
            <a class="nav-link nav-icon" href="{{ route('admin.dashboard')}}">
              <i class="fa-solid fa-bell"></i>
            <span class="badge bg-primary badge-number">{{$userCount}}</span>
            </a>
          </li>
          <li class="nav-item w-50">
            <h4 class="pt-1">{{Auth::guard('admin')->user()->name}}</h4>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              @if (Auth::guard('admin')->user()->photo == NULL)
              <img src="{{asset('img/img_emptyProfile.png')}}"  alt="Profile" class="rounded-circle mw-100" style="width: 25px; height: 25px; object-fit: cover;" >
              @else
              <img src="{{asset('storage/'.Auth::guard('admin')->user()->photo)}}" alt="Profile" class="rounded-circle mw-100" style="width: 25px; height: 25px; object-fit: cover;">
              @endif
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{url('admin/profile')}}"><i class="fa-solid fa-user me-3"></i> Profile</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="{{url('/logout')}}"><i class="fa-solid fa-right-from-bracket me-3"></i> Log Out</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
</nav>
<!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link collapsed {{ request()->routeIs('admin.dashboard') ? 'active':'' }}" href="{{route('admin.dashboard')}}">
          <i class="fa-solid fa-grip"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed {{ request()->routeIs('list.user') ? 'active':'' }}" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="{{route('list.user')}}">
          <i class="fa-solid fa-users"></i><span>User List</span><i class="fa-solid fa-angle-right ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('admin/list/user')}}">
              <i class="fa-regular fa-circle"></i><span>User List</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>
</aside>
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
            <div class="d-flex align-items-center w-50 justify-content-between">
                <h2 class="text-center mt-2 ttl">Admin Profile</h2>
            <a href="{{url('/admin/edit/profile',Auth::guard('admin')->user()->id)}}"><i class="fa-solid fa-user-pen"></i></a>
            </div>
<div class="info-blk w-75 d-flex flex-column justify-content-center">
    <div class="mt-5 d-flex justify-content-between">
        <h5>Name:</h5>
        <p>{{Auth::guard('admin')->user()->name}}</p>
    </div>
    <div class="mt-2 d-flex justify-content-between">
        <h5>Email:</h5>
        <p>{{Auth::guard('admin')->user()->email}}</p>
    </div>
    <div class="mt-2 d-flex justify-content-between">
        <h5>Address:</h5>
        <p>{{Auth::guard('admin')->user()->address}}</p>
    </div>
    <div class="mt-2 d-flex justify-content-between">
        <h5>Phone Number:</h5>
        <p>{{Auth::guard('admin')->user()->phone}}</p>
    </div>
    <div class="mt-2 d-flex justify-content-between">
        <h5>Date Of Birth:</h5>
        <p>{{ \Carbon\Carbon::parse(Auth::guard('admin')->user()->dob)->format('d-M-Y')}}</p>
    </div>
    <div class="mt-2 d-flex justify-content-between">
        <h5>Photo:</h5>
        @if (Auth::guard('admin')->user()->photo == NULL)
        <img src="{{asset('img/img_emptyProfile.png')}}" alt="" style="max-width: 100px;height: 100px;object-fit: cover;">
        @else
        <img src="{{asset('storage/'.Auth::guard('admin')->user()->photo)}}" alt="" style="max-width: 100px;height: 100px;object-fit: cover;">
        @endif
    </div>

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
@endsection
