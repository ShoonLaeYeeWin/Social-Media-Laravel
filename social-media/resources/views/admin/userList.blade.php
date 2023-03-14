@extends('layouts')
<title>UserList | Admin</title>
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
            <span class="badge bg-primary badge-number">{{ $userCount }}</span>
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
<div class="container list-profile-blk user-list shadow-lg pb-5">
  @if (session('deleteSuccess'))
  <div class="alert alert-success alert-dismissible fade show mt-5 mb-3 m-auto w-75 text-center" role="alert">
    <strong>{{ session('deleteSuccess') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <i class="fa-sharp fa-solid fa-xmark"></i>
    </button>
  </div>
  @endif
  <div class="row">
    <h5 class="text-center my-3">User List</h5>
    <div class="d-flex justify-content-center align-items-center">
      <form action="" method="GET">
        <div class="d-flex">
          <input type="search" id="searchName" class="me-3" value="{{ request('name') }}" placeholder="Search  name"
            name="name">
          <input type="search" id="searchEmail" class="me-3" value="{{ request('email') }}" placeholder="Search  email"
            name="email">
          <select name="userStatus" class="me-3 shadow-none pe-2 text-muted w-50" id="searchSelect">
            @if (request('userStatus') == null)
            <option value="" selected>Status</option>
            <option value="0">Inactive</option>
            <option value="1">Active</option>
            @elseif(request('userStatus') == 0)
            <option value="">Status</option>
            <option value="0" selected>Inactive</option>
            <option value="1">Active</option>
            @else
            <option value="">Status</option>
            <option value="0">Inactive</option>
            <option value="1" selected>Active</option>
            @endif
          </select>
          <button class="m-0 text-white btn bg-primary" id="searchBtn" style="display:none">Search</button>
          <a href="{{ route('admin.userlist') }}" class="ms-3 text-white btn bg-danger" id="cancelBtn"
            style="display:none">Cancel</a>
        </div>
      </form>
      <button class="download-btn text-center"><a href="{{ route('admin.export') }}">CSV Download</a></button>
    </div>
    <div class="col-md-6 mt-2 w-100">
      @if (count($users) != 0)
      <table class="table table-striped table-bordered">
        <thead class="thead-dark text-center">
          <tr>
            <th scope="col" class="th-sm">#</th>
            <th scope="col" class="th-md-user">User Name</th>
            <th scope="col" class="th-md-user">User Email</th>
            <th scope="col" class="th-md-user">Address</th>
            <th scope="col" class="th-lg-user">User Profile</th>
            <th scope="col" class="th-md-user">Phone Number</th>
            <th scope="col" class="th-lg-user">Date Of Birthday</th>
            <th scope="col" class="th-md-user">Activate/Deactivate</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
          <tr class="post{{ $user->status == 0 ? ' post-active' : '' }}">
            <td class="text-center">{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td class="text-truncate" style="max-width: 150px;">{{ $user->email }}</td>
            <td>{{ $user->address }}</td>
            <td class="text-center">
              @if ($user->photo == null)
              <img src="{{ asset('img/img_emptyProfile.png') }}" alt="Profile" class="rounded-circle mw-100"
                style="width: 50px; height: 50px; object-fit: cover;">
              @else
              <img src="{{ asset('storage/' . $user->photo) }}" alt="Profile" class="rounded-circle mw-100"
                style="width: 50px; height: 50px; object-fit: cover;">
              @endif
            </td>
            <td>{{ $user->phone }}</td>
            <td>{{ \Carbon\Carbon::parse($user->dob)->format('d-M-Y') }}</td>
            <td>
              <div class="d-flex justify-content-center">
                @if ($user->deleted_at == null)
                @if ($user['status'] == 1)
                <a href="{{ route('admin.status', $user->id) }}" class="btn btn-success">Activate</a>
                @else
                <a href="{{ route('admin.status', $user->id) }}" class="btn btn-danger">Deactivate</a>
                @endif
                @else
                <a href="#" class="btn btn-danger">Deactivate</a>
                @endif
              </div>
            </td>
            <td class="text-center" style="width: 40%;">
              @if ($user->deleted_at == null)
              <button class="delete"><a href="{{ route('admin.userDelete', $user->id) }}"><i
                    class="fa-solid fa-trash"></i> Delete</a></button>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @else
      <h2 class="text-center text-danger">There is no data.</h2>
      @endif
    </div>
  </div>
  <div class="mt-3 pagniation d-flex justify-content-center">
    {{ $users->appends(request()->except('page'))->links() }}
  </div>
</div>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
@endsection
