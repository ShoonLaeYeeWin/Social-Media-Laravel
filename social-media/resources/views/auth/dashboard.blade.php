@extends('layouts')
<title>Dashboard View</title>
@section('head')
<h1 class="main-ttl">Social Media Project</h1>
<div class="auth">
    <button class="auth-login" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-arrow-right-to-bracket"></i> Login</button>
    <button class="register"><i class="fa-solid fa-registered"></i> <a href="{{url('/auth/register')}}">Register</a></button>
</div>
<img src="{{ asset('img/img_dashboardView.png') }}" alt="Dashboard View" class="dashboard-img">
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Do You Want To Login?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary"><i class="fa-solid fa-circle-user"></i> <a href="{{url('/login')}}"> Admin</a></button>
          <button type="button" class="btn btn-primary"><i class="fa-solid fa-user"></i> <a href="{{url('/auth/login')}}"> User</a></button>
        </div>
      </div>
    </div>
</div>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
@endsection