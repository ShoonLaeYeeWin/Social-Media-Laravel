@extends('layouts')
<title>Dashboard | User</title>
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
<link rel="stylesheet" href="{{asset('css/user.css')}}">
@section('head')
<!-- ======= Navbar ======= -->
<nav class="navbar navbar-expand-lg bg-white border-bottom fixed-top">
  <div class="container-fluid me-5 ms-3">
    <a class="navbar-brand" href="#"><i class="fa-solid fa-circle"></i> <i class="fa-solid fa-circle me-3"></i> Admin
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
          <h4 class="pt-1">{{Auth::user()->name}}</h4>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            @if (Auth::user()->photo == NULL)
            <img src="{{asset('img/img_emptyProfile.png')}}" alt="Profile" class="rounded-circle mw-100"
              style="width: 25px; height: 25px; object-fit: cover;">
            @else
            <img src="{{asset('storage/'.Auth::user()->photo)}}" alt="Profile" class="rounded-circle mw-100"
              style="width: 25px; height: 25px; object-fit: cover;">
            @endif
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{url('/user/profile')}}"><i class="fa-solid fa-user me-3"></i>
                Profile</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="{{url('user/list/post')}}"><i class="fa-solid fa-pen-to-square me-3"></i>
                My Post</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="{{url('/auth/logout')}}"><i
                  class="fa-solid fa-right-from-bracket me-3"></i> Log Out</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container-fluid create-post">
  <div class="row">
    <div class="col-md-5 px-4 rounded">
      <h3 class="ms-4 my-3">Create Post</h3>
      <form action="{{url('user/create/post')}}" method="POST">
        @csrf
        <div class="input-gp">
          <label for="">Post Title:</label>
          <input type="text" name="title" id="" value="{{old('title')}}" placeholder="Enter Your Post Title...">
          @error('title')
          <span class="text-danger text-sm"><b>{{$message}}</b></span>
          @enderror
        </div>
        <div class="input-gp">
          <label for="">Post Content:</label>
          <textarea name="content" id="" rows="5"
            placeholder="Enter Your Post  Content...">{{old('content')}}</textarea>
          @error('content')
          <span class="text-danger text-sm"><b>{{$message}}</b></span>
          @enderror
        </div>
        <button type="submit" class="reg-btn my-5">Create</button>
      </form>
    </div>
    <div class="col-md-7">
      <div class="row">
        @if (count($posts) != 0)
        @foreach ($posts as $post)
        <div class="card border-info mb-5" style="max-width: 94%; margin-top: 3%; margin-left: 3%;">
          <div class="card-header fs-5 fw-bold d-flex justify-content-between align-items-center">
            <h3>{{$post->title}}</h3>
            <div class="gp d-flex justify-content-between align-items-center">
              <h5 class="me-3">{{$post->name}}</h5>
              @if ($post->photo == NULL)
              <img src="{{asset('img/img_emptyProfile.png')}}" alt="Profile" class="rounded-circle mw-100"
                style="width: 25px; height: 25px; object-fit: cover;">
              @else
              <img src="{{asset('storage/'.$post->photo)}}" alt="Profile" class="rounded-circle mw-100"
                style="width: 25px; height: 25px; object-fit: cover;">
              @endif
            </div>
          </div>
          <div class="card-body text-info">
            <input type="hidden" name="" value="{{$post->user_id}}">
            <p class="card-text">{{$post->content}}</p>
            <!-- Button trigger modal -->
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
              Comment
            </button>
          </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="card-body m-3">
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
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="mt-3 pagniation">
        {{ $posts->links() }}
      </div>
      @else
      <h2 class="text-center text-danger">There is no data.</h2>
      @endif
    </div>
  </div>
</div>
</div>
@endsection