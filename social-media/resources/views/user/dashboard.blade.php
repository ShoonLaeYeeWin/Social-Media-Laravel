@extends('layouts')
<title>Dashboard | User</title>
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" href="{{ asset('css/user.css') }}">
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
                    <li class="nav-item w-25">
                        <a class="nav-link nav-icon" href="#">
                            <i class="fa-solid fa-bell"></i>
                            <span class="badge bg-primary badge-number">4</span>
                        </a>
                    </li>
                    <li class="nav-item w-50">
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
    <div class="container-fluid create-post">
        <div class="row">
            <div class="col-md-3 px-4 rounded">
                <h3 class="ms-4 my-3">Create Post</h3>
                <form action="{{ url('user/create/post') }}" method="POST">
                    @csrf
                    <div class="input-gp">
                        <label for="">Post Title:</label>
                        <input type="text" name="title" id="" value="{{ old('title') }}"
                            placeholder="Enter Your Post Title...">
                        @error('title')
                            <span class="text-danger text-sm"><b>{{ $message }}</b></span>
                        @enderror
                    </div>
                    <div class="input-gp">
                        <label for="">Post Content:</label>
                        <textarea name="content" id="" rows="5" placeholder="Enter Your Post  Content...">{{ old('content') }}</textarea>
                        @error('content')
                            <span class="text-danger text-sm"><b>{{ $message }}</b></span>
                        @enderror
                    </div>
                    <button type="submit" class="reg-btn my-5">Create</button>
                </form>
            </div>
            <div class="col-md-9">
                <div class="row d-flex flex-wrap">
                    @if (count($posts) != 0)
                        @foreach ($posts as $post)
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="{{url('/user/posts',$post->id)}}">
                                            <h3 class="card-title text-success mb-3">{{ $post->title }}</h3>
                                        </a>
                                        <p class="card-text">
                                            {{ Str::limit($post->content, 150) }}
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="gp d-flex justify-content-start align-items-center">
                                            <p class="me-3 fw-bold">{{ $post->name }}</p>
                                            @if ($post->photo == null)
                                                <img src="{{ asset('img/img_emptyProfile.png') }}" alt="Profile"
                                                    class="rounded-circle mw-100"
                                                    style="width: 25px; height: 25px; object-fit: cover;">
                                            @else
                                                <img src="{{ asset('storage/' . $post->photo) }}" alt="Profile"
                                                    class="rounded-circle mw-100"
                                                    style="width: 25px; height: 25px; object-fit: cover;">
                                            @endif
                                        </div>
                                        <div class="d-flex text-sm">
                                            <time datetime="{{ $post->created_at }}">
                                                {{ $post->created_at->diffForHumans() }}
                                            </time>
                                            <span class="text-warning">&middot;</span>
                                            <span>{{ ceil(strlen($post->cotent) / 863) }} min read</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h2 class="text-center text-danger">There is no data.</h2>
                    @endif
                </div>
                <div class="mt-3 pagniation">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
