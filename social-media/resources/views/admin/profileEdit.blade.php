@extends('layouts')
<title>ProfileEdit | Admin</title>
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@section('head')
<!-- ======= Navbar ======= -->
<nav class="navbar navbar-expand-lg bg-white border-bottom fixed-top">
  <div class="container-fluid me-5 ms-3">
    <a class="navbar-brand" href="#"><i class="fa-solid fa-circle"></i> <i class="fa-solid fa-circle me-3"></i>
      Admin Logo</a>
    <div class="collapse navbar-collapse d-flex justify-content-end align-items-center mx-3"
      id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-content-between align-items-center w-100">
        <li class="nav-item w-25">
          <a class="nav-link nav-icon" href="{{ route('admin.dashboard') }}">
            <i class="fa-solid fa-bell"></i>
            <span class="badge bg-primary badge-number">{{ $user['userCount'] }}</span>
          </a>
        </li>
        <li class="nav-item w-50">
          <h4 class="pt-1">{{ Auth::guard('admin')->user()->name }}</h4>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            @if (Auth::guard('admin')->user()->photo == null)
            <img src="{{ asset('img/img_emptyProfile.png') }}" alt="Profile" class="rounded-circle mw-100"
              style="width: 25px; height: 25px; object-fit: cover;">
            @else
            <img src="{{ asset('storage/' . Auth::guard('admin')->user()->photo) }}" alt="Profile"
              class="rounded-circle mw-100" style="width: 25px; height: 25px; object-fit: cover;">
            @endif
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="fa-solid fa-user me-3"></i>
                Profile</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="{{ route('admin.logout') }}"><i class="fa-solid fa-right-from-bracket me-3"></i>
                Log Out</a></li>
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
      <a class="nav-link collapsed {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
        href="{{ route('admin.dashboard') }}">
        <i class="fa-solid fa-grip"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed {{ request()->routeIs('admin.userlist') ? 'active' : '' }}" data-bs-target="#tables-nav"
        data-bs-toggle="collapse" href="{{ route('admin.userlist') }}">
        <i class="fa-solid fa-users"></i><span>User List</span><i class="fa-solid fa-angle-right ms-auto"></i>
      </a>
      <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('admin.userlist') }}">
            <i class="fa-regular fa-circle"></i><span>User List</span>
          </a>
        </li>
      </ul>
    </li>
  </ul>
</aside>
<div class="container admin-profile-blk px-5 py-3 w-50 border border-dark rounded-2">
  <a href="{{ route('admin.profile') }}"><i class="fa-solid fa-arrow-left"></i></a>
  <h2 class="ttl">Profile Edit</h2>
  <form action="{{ route('admin.profileUpdate', $user['user']->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="input-gp">
      <label for="">Name:</label>
      <input type="text" name="editName" id="" value="{{ old('name', $user['user']->name) }}" placeholder="Enter Your Name...">
      @error('editName')
      <span class="text-danger text-sm"><b>{{ $message }}</b></span>
      @enderror
    </div>
    <div class="input-gp">
      <label for="">Email:</label>
      <input type="email" name="editEmail" id="" value="{{ old('email', $user['user']->email) }}"
        placeholder="Enter Your Email...">
      @error('editEmail')
      <span class="text-danger text-sm"><b>{{ $message }}</b></span>
      @enderror
    </div>
    <div class="input-gp">
      <label for="">Address:</label>
      <textarea name="editAddress" id="" rows="5"
        placeholder="Enter Your Address...">{{ old('address', $user['user']->address) }}</textarea>
      @error('editAddress')
      <span class="text-danger text-sm"><b>{{ $message }}</b></span>
      @enderror
    </div>
    <div class="input-gp">
      <label for="">Date Of Birth:</label>
      <input type="date" name="editDob" id="" value="{{ old('dob', $user['user']->dob) }}">
      @error('editDob')
      <span class="text-danger text-sm"><b>{{ $message }}</b></span>
      @enderror
    </div>
    <div class="input-gp">
      <label for="">Phone Number:</label>
      <input type="text" name="editPhone" id="" placeholder="Enter Your Phone Number..."
        value="{{ old('phone', $user['user']->phone) }}">
      @error('editPhone')
      <span class="text-danger text-sm"><b>{{ $message }}</b></span>
      @enderror
    </div>
    <div class="input-gp">
      <label for="">Profile Photo:</label>
      <input type="file" name="editPhoto" id="image" class="custom-file-input">
      @error('editPhoto')
      <span class="text-danger text-sm"><b>{{ $message }}</b></span>
      @enderror
    </div>
    <button type="submit" class="reg-btn mt-5">Update</button>
  </form>
</div>
@endsection
