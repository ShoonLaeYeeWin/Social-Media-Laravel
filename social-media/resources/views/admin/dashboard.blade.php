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
              <img src="{{asset('storage/'.Auth::Auth::guard('admin')->user()->photo)}}" alt="Profile" class="rounded-circle mw-100" style="width: 25px; height: 25px; object-fit: cover;">
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
<div class="container-fluid">
    <h2 class="page-ttl my-5">ホームページ</h2>
    <div class="wrapper pt-3">
        <div class="admin-count row row-cols-1 row-cols-md-5 justify-content-center align-items-center mt-5">
            <div class="col mb-12">
                <div class="card border border-dark rounded-0">
                    <div class="card-body gap-3 text-center">
                        <h5 class="card-title home-ttl">User Count</h5>
                        <p class="card-text home-count">{{$userCount}}<small>person</small></p>
                        <a href="{{route('list.user')}}" class="d-block text-primary font-bold link">User List Page</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@yield('dashboard')
@endsection
