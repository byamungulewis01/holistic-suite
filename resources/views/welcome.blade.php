@extends('layouts.auth')
@section('title', 'Login')
@section('body')
<form>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Username</label>
      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  placeholder="Enter Username">
    </div>
    <div class="mb-4">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="*************">
    </div>
    <div class="d-flex align-items-center justify-content-between mb-4">
      <div class="form-check">
        <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
        <label class="form-check-label text-dark" for="flexCheckChecked">
          Remeber this Device
        </label>
      </div>
      <a class="text-primary fw-medium" href="authentication-forgot-password.html">Forgot Password ?</a>
    </div>
    <a href="index.html" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Sign In</a>

</form>
@endsection
