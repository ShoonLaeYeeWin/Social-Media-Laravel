@extends('layouts')
@section('head')
<div class="row">
    <h5 class="text-center mt-3">Comment List</h5>
    <div class="col-md-6 mt-2 w-100">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark text-center">
              <tr>
                <th scope="col" class="th-sm">#</th>
                <th scope="col" class="th-md">Post Title</th>
                <th scope="col">Post Comment</th>
                <th scope="col" class="th-lg">User</th>
              </tr>
            </thead>
            @foreach ($comments as $comment)
            <tbody>
              <tr>
                <td>{{$comment->id}}</td>
                <td>{{$comment->title}}</td>
                <td>{{$comment->comment}}</td>
                <td>{{$comment->name}}</td>
              </tr>
            </tbody>
            @endforeach
    </div>
</div>
@endsection