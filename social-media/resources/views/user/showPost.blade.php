@extends('layouts')
<title>Show Post | User</title>
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" href="{{ asset('css/user.css') }}">
@section('head')
<!-- ======= Navbar ======= -->
<nav class="navbar navbar-expand-lg bg-white border-bottom fixed-top">
  <div class="container-fluid me-5 ms-3">
    <a class="navbar-brand" href="#"><i class="fa-solid fa-circle"></i> <i class="fa-solid fa-circle me-3"></i>
      Admin Logo</a>
    <div class="collapse navbar-collapse d-flex justify-content-end align-items-center mx-3"
      id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-content-between align-items-center w-100">
        <li class="nav-item w-50">
          <h4 class="pt-1">{{ Auth::user()->name }}</h4>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            @if (Auth::user()->photo == null)
            <img src="{{ asset('img/img_emptyProfile.png') }}" alt="Profile" class="rounded-circle mw-100"
              style="width: 25px; height: 25px; object-fit: cover;">
            @else
            <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Profile" class="rounded-circle mw-100"
              style="width: 25px; height: 25px; object-fit: cover;">
            @endif
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('user.profile') }}"><i class="fa-solid fa-user me-3"></i>
                Profile</a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="{{ route('post.listPost') }}"><i
                  class="fa-solid fa-pen-to-square me-3"></i>
                My Post</a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="{{ route('user.logout') }}"><i
                  class="fa-solid fa-right-from-bracket me-3"></i> Log Out</a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container-fluid mt-5">
  <div class="row d-flex justify-content-center">
    <div class="col-md-8 mb-3 mt-5">
      <a href="{{ route('user.dashboard') }}"><i class="fa-solid fa-arrow-left mb-3"></i></a>
      <div class="p-5 post-detail rounded-3">
        <div class="card-body">
          <div class="d-flex justify-content-center align-items-center mb-3">
            <h5 class="card-title">{{ $post->title }}</h5>
          </div>
          <p class="mb-4">{{ $post->content }}</p>
        </div>
        <div class="card-footer">
          <div class="post-time d-flex text-sm">
            <time datetime="{{ $post->created_at }}">
              {{ $post->created_at->diffForHumans() }}
            </time>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row d-flex justify-content-center">
    <div class="col-md-6 mb-3 mt-3">
      <div class="card-body">
        <form action="{{ route('comment.createComment',$post->id) }}" method="POST"
          class="d-flex justify-content-between align-items-center">
          @csrf
          <input type="text" name="comment" id="" placeholder="Enter Comment Here! ..." value="{{ old('comment') }}"
            class="shadow-none">
          <input type="hidden" name="post_id" value="{{ $post->id }}">
          <button type="submit" class="cmt-btn ms-3 p-2 border border-0">Comment</button>
        </form>
        @error('comment')
        <span class="text-danger text-sm ms-3"><b>{{ $message }}</b></span>
        @enderror
      </div>
      @foreach ($comments as $comment)
      <div class="cmt-section mt-4 p-4 rounded-3">
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="me-3 text-primary">{{ $comment->name }}</h5>
          @if ($comment->photo == null)
          <img src="{{ asset('img/img_emptyProfile.png') }}" alt="Profile" class="rounded-circle mw-100"
            style="width: 25px; height: 25px; object-fit: cover;">
          @else
          <img src="{{ asset('storage/' . $comment->photo) }}" alt="Profile" class="rounded-circle mw-100"
            style="width: 25px; height: 25px; object-fit: cover;">
          @endif
        </div>
        <div class="my-3">
          <p class="cmt-txt">{{ $comment->comment }}</p>
        </div>
        <span class="comment-time d-block ms-auto">{{ $comment->created_at }}</span>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
