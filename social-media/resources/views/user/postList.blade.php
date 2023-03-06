@extends('layouts')
<title>PostList | Social Media</title>
<link rel="stylesheet" href="{{asset('css/user.css')}}">
@section('head')
<div class="container">
    @if (session('deleteSuccess'))
    <div class="alert alert-success alert-dismissible fade show mt-5 mb-3 m-auto w-50 text-center" role="alert">
        <strong>{{ session('deleteSuccess') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <i class="fa-sharp fa-solid fa-xmark"></i>
        </button>
      </div>
    @endif
    @if (session('updateSuccess'))
    <div class="alert alert-success alert-dismissible fade show mt-5 mb-3 m-auto w-50 text-center" role="alert">
        <strong>{{ session('updateSuccess') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <i class="fa-sharp fa-solid fa-xmark"></i>
        </button>
      </div>
    @endif
    @if (session('registerSuccess'))
    <div class="alert alert-success alert-dismissible fade show mt-5 mb-3 m-auto w-50 text-center" role="alert">
        <strong>{{ session('registerSuccess') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <i class="fa-sharp fa-solid fa-xmark"></i>
        </button>
      </div>
    @endif
    <a href="{{url('/user/dashboard')}}" class="me-5"><i class="fa-solid fa-arrow-left"></i></a>
    <button class="create border-0"><a href="{{asset('/user/post')}}"><i class="fa-solid fa-square-plus"></i> Create</a></button>
    <h3 class="text-center mt-3">Post List</h3>
    <div class="row">
      <div class="d-flex justify-content-between align-items-center mt-3">
        <button class="download-btn text-center me-3"><a href="{{ route('post.export', Auth::user()->id) }}">Post Download</a></button>
        <form action="" method="GET">
          <div class="d-flex align-items-center">
            <input type="search" id="searchName" class="me-3 shadow-none" value="{{ request('content') }}" placeholder="Search Content" name="content">
            <select name="postStatus" class="me-3 shadow-none pe-2 text-muted w-50"  id="searchEmail">
              <option value="" selected>Status</option>
              @if(request('postStatus') == 0 )
              <option value="0" selected>Inactive</option>
              <option value="1">Active</option>
              @elseif(request('postStatus') == 1 )
              <option value="0">Inactive</option>
              <option value="1" selected>Active</option>
              @else
              <option value="" selected>Status</option>
              @endif
                {{-- <option value="" selected>@if(request('postStatus') == null) Status @endif</option>
                <option value="0"> @if(request('postStatus') == 0) Inactive @endif</option>
                <option value="1"> @if(request('postStatus') == 1) Active @endif</option> --}}
            </select>
            <button class="m-0 text-white btn bg-primary" id="searchBtn" style="display:none">Search</button>
            <a href="{{route('list.post')}}" class="ms-3 text-white btn bg-danger" id="cancelBtn" style="display:none">Cancel</a>
          </div>
        </form>
        <form method="POST" action="{{ route('post.import') }}" enctype="multipart/form-data" class="d-flex justify-content-end">
            @csrf
            <div class="input-gp mb-0">
              <input type="file" name="csv_file" class="shadow-none">
              @error('csv_file')
              <span class="text-danger text-sm"><b>{{$message}}</b></span>
              @enderror
            </div>
            <button type="submit" class="upload-btn">Post Upload</button>
        </form>
      </div>

        <div class="col-md-6 mt-4 w-100">
          @if (count($posts) != 0)
            <table class="table table-striped table-bordered">
                <thead class="thead-dark text-center">
                  <tr>
                    <th scope="col" class="th-md">Post Title</th>
                    <th scope="col">Post Content</th>
                    <th scope="col" class="th-md">Active/Inactive</th>
                    <th scope="col" class="th-lg">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($posts as $post)
                      <tr class="post{{ $post->status == 0 ? ' post-active' : '' }}">
                        <td class="text-truncate">{{$post->title}}</td>
                        <td class="text-truncate" style="max-width: 150px;">{{$post->content}}</td>
                        <td>
                          <div class="d-flex justify-content-center">
                            @if($post->status == 1)
                            <a href="{{route('status.update',$post->id)}}" class="btn btn-success">Active</a>
                            @else
                            <a href="{{route('status.update',$post->id)}}" class="btn btn-danger">Inactive</a>
                            @endif
                          </div>
                        </td>
                        <td class="text-center">
                            <button class="edit"><a href="{{url('/user/edit/post',$post->id)}}"><i class="fa-solid fa-pen-to-square"></i> Edit</a></button>
                            <button class="delete"><a href="{{url('/user/delete/post',$post->id)}}"><i class="fa-solid fa-trash"></i> Delete</a></button>
                        </td>
                      </tr>
                  @endforeach
                </tbody>
            </table>
              {{-- <div class="mt-3 pagniation d-flex justify-content-center">
                {{ $posts->links() }}
              </div> --}}
          @else
              <h2 class="text-center text-danger">There is no data.</h2>
          @endif
        </div>
    </div>
</div>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
@endsection
