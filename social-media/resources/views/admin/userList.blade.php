@extends('admin.dashboard')
<title>UserList | Admin</title>
@section('dashboard')
<div class="container profile-blk user-list shadow-lg pb-5">
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
        <div class="d-flex justify-content-center">
        <form action="" method="GET">
          <div class="d-flex mb-3">
            <input type="search" class="me-3" value="{{ request('name') }}" placeholder="Search  name" name="name">
          </div>
        </form>
        <form action="" method="GET">
          <div class="d-flex mb-3">
            <input type="search" value="{{ request('email') }}" placeholder="Search  email" name="email">
          </div>
        </form>
        <a href="{{route('list.user')}}" class="ms-3 text-white btn bg-danger">Cancel</a>
        <button class="download-btn text-center"><a href="{{ route('user.export') }}">CSV Download</a></button>
        </div>
        <div class="col-md-6 mt-2 w-100">
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
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                      <tr>
                        <td class="text-center">{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td class="text-truncate" style="max-width: 150px;">{{$user->email}}</td>
                        <td>{{$user->address}}</td>
                        <td class="text-center">
                            @if ($user->photo == NULL)
                            <img src="{{asset('img/img_emptyProfile.png')}}" alt="Profile" class="rounded-circle mw-100"
                              style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                            <img src="{{asset('storage/'.$user->photo)}}" alt="Profile" class="rounded-circle mw-100"
                              style="width: 50px; height: 50px; object-fit: cover;">
                            @endif
                        </td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->dob}}</td>
                        <td class="text-center" style="width: 40%;">
                            <button class="delete"><a href="{{url('/admin/delete/user',$user->id)}}"><i class="fa-solid fa-trash"></i> Delete</a></button>
                        </td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
    </div>
    {{-- <div class="mt-3 pagniation d-flex justify-content-center">
        {{ $users->links() }}
    </div> --}}
</div>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
@endsection
