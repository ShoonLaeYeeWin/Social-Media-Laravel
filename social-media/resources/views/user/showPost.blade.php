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
    <div class="container-fluid mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-4 mb-3 mt-5">
                <a href="{{ url('/user/dashboard') }}"><i class="fa-solid fa-arrow-left mb-3"></i></a>
                <div class="card">
                    @foreach ($comments as $comment)
                     <h2>{{$comment->name}}</h2>
                     @if (Auth::user()->photo == null)
                     <img src="{{ asset('img/img_emptyProfile.png') }}" alt="Profile"
                         class="rounded-circle mw-100" style="width: 25px; height: 25px; object-fit: cover;">
                 @else
                     <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Profile"
                         class="rounded-circle mw-100" style="width: 25px; height: 25px; object-fit: cover;">
                 @endif
                    @endforeach
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">
                            {{ Str::limit($post->content, 150) }}
                        </p>
                    </div>
                    <div class="card-footer">
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
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-4 mb-3 mt-3">
                <h2 class="text-center text-primary">Add Comments</h2>
                <div class="card-body m-3 ">
                    <form action="{{url('/user/create/comment')}}" method="POST"
                      class="d-flex justify-content-between align-items-center">
                      @csrf
                      <input type="text" name="comment" id="" placeholder="Enter Comment Here! ..." value="{{old('comment')}}">
                      <input type="hidden" name="post_id" value="{{$post->id}}">
                      <button type="submit" class="cmt-btn ms-3">Comment</button>
                    </form>
                    @error('comment')
                    <span class="text-danger text-sm ms-3"><b>{{$message}}</b></span>
                    @enderror
                </div>

                @foreach ($comments as $comment)
                    <div>
                        <h2>{{$comment->comment}}</h2>
                        <h2>{{$comment->name}}</h2>
                        @if (Auth::user()->photo == null)
                        <img src="{{ asset('img/img_emptyProfile.png') }}" alt="Profile"
                            class="rounded-circle mw-100" style="width: 25px; height: 25px; object-fit: cover;">
                    @else
                        <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Profile"
                            class="rounded-circle mw-100" style="width: 25px; height: 25px; object-fit: cover;">
                    @endif
                    <h2>{{$comment->created_at}}</h2>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
