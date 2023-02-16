@extends('layouts')
<title>PostList | Social Media</title>
@section('head')
<div class="container">
    <div class="row d-flex justify-content-center align-items-center">
        <h5 class="text-center mt-5">User List</h5>
        <div class="col-md-5 mt-2">
            <div class="data-table">
                <table id="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>dob</th>
                            <th>phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                        <tr>
                            <td>
                                {{ $post->title}}
                            </td>
                            <td>
                                {{ $user->content}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection