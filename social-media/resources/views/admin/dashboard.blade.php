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
            <a class="nav-link nav-icon" href="#">
              <i class="fa-solid fa-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
            </a>
          </li>
          <li class="nav-item w-50">
            <h4 class="pt-1">Susan</h4>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="{{asset('img/img_profile.jpeg')}}" alt="Profile" class="rounded-circle mw-100" style="width: 25px; height: 25px;">
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{url('/admin/profile')}}"><i class="fa-solid fa-user me-3"></i> Profile</a></li>
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
        <a class="nav-link " href="">
          <i class="fa-solid fa-grip"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="fa-solid fa-users"></i><span>User Lists</span><i class="fa-solid fa-angle-right ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('/admin/list/post')}}">
              <i class="fa-regular fa-circle"></i><span>User List</span>
            </a>
          </li>
          <li>
            <a href="">
              <i class="fa-regular fa-circle"></i><span>Accordion</span>
            </a>
          </li>
          <li>
            <a href="">
              <i class="fa-regular fa-circle"></i><span>Badges</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="fa-solid fa-clipboard-list"></i><span>Tables</span><i class="fa-solid fa-angle-right ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="">
              <i class="fa-regular fa-circle"></i><span>General Tables</span>
            </a>
          </li>
          <li>
            <a href="">
              <i class="fa-regular fa-circle"></i><span>Data Tables</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="">
          <i class="fa-solid fa-clipboard-list"></i>
          <span>F.A.Q</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="">
          <i class="fa-solid fa-clipboard-list"></i>
          <span>Contact</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="">
          <i class="fa-solid fa-clipboard-list"></i>
          <span>Register</span>
        </a>
      </li>
    </ul>
</aside>
@yield('dashboard')
@endsection
