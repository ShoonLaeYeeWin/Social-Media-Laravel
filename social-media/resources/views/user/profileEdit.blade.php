@extends('layouts')
<title>Profile Edit | User</title>
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
                            <li><a class="dropdown-item" href="{{ url('/user/profile') }}">
                                    <i class="fa-solid fa-user me-3"></i>Profile</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ url('user/list/post') }}">
                                    <i class="fa-solid fa-pen-to-square me-3"></i>My Post</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ url('/auth/logout') }}">
                                    <i class="fa-solid fa-right-from-bracket me-3"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container admin-profile-blk py-3 px-5  w-50 border border-dark rounded-2">
        <a href="{{ url('/user/profile') }}"><i class="fa-solid fa-arrow-left"></i></a>
        <h2 class="ttl">Profile Edit</h2>
        <form action="{{ url('user/update/profile', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-gp">
                <label for="">Name:</label>
                <input type="text" name="editName" id="" value="{{ old('name', $user->name) }}"
                    placeholder="Enter Your Name...">
                @error('editName')
                    <span class="text-danger text-sm"><b>{{ $message }}</b></span>
                @enderror
            </div>
            <div class="input-gp">
                <label for="">Email:</label>
                <input type="email" name="editEmail" id="" value="{{ old('email', $user->email) }}"
                    placeholder="Enter Your Email...">
                @error('editEmail')
                    <span class="text-danger text-sm"><b>{{ $message }}</b></span>
                @enderror
            </div>
            <div class="input-gp">
                <label for="">Address:</label>
                <textarea name="editAddress" id="" rows="5" placeholder="Enter Your Address...">{{ old('address', $user->address) }}</textarea>
                @error('editAddress')
                    <span class="text-danger text-sm"><b>{{ $message }}</b></span>
                @enderror
            </div>
            <div class="input-gp">
                <label for="">Date Of Birth:</label>
                <input type="date" name="editDob" id="" value="{{ old('dob', $user->dob) }}">
                @error('editDob')
                    <span class="text-danger text-sm"><b>{{ $message }}</b></span>
                @enderror
            </div>
            <div class="input-gp">
                <label for="">Phone Number:</label>
                <input type="text" name="editPhone" id="" placeholder="Enter Your Phone Number..."
                    value="{{ old('phone', $user->phone) }}">
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
