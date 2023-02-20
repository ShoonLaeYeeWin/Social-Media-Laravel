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
    <a href="{{url('/user/dashboard')}}" class="me-5"><i class="fa-solid fa-arrow-left"></i></a>
    <button class="create"><a href="{{asset('/user/post')}}"><i class="fa-solid fa-square-plus"></i> Create</a></button>
    <div class="row">
        <h5 class="text-center mt-3">Post List</h5>
        <div class="col-md-6 mt-2 w-100">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark text-center">
                  <tr>
                    <th scope="col" class="th-sm">#</th>
                    <th scope="col" class="th-md">Post Title</th>
                    <th scope="col">Post Content</th>
                    <th scope="col" class="th-lg">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($posts as $post)
                      <tr>
                        <td class="text-center">{{$post->id}}</td>
                        <td>{{$post->title}}</td>
                        <td class="text-truncate" style="max-width: 150px;">{{$post->content}}</td>
                        <td class="text-center">
                            <button class="edit"><a href="{{url('/user/edit/post',$post->id)}}"><i class="fa-solid fa-pen-to-square"></i> Edit</a></button>
                            <button class="delete"><a href="{{url('/user/delete/post',$post->id)}}"><i class="fa-solid fa-trash"></i> Delete</a></button>
                        </td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
@endsection