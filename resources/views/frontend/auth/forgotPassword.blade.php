@extends('layouts.frontend.auth')
@section('title', 'Forgot Password')
@section('body')
<div class="col-xl-5 col-xxl-4">
    <div class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
        <div class="col-sm-8 col-md-6 col-xl-9">
            @if(session('error'))
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <span class="alert-icon text-danger me-2">
                    <i class="ti ti-ban ti-xs"></i>
                </span>
                {{ session('error') }}
            </div>
            @endif
            @if($errors->any())
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <span class="alert-icon text-danger me-2">
                    <i class="ti ti-ban ti-xs"></i>
                </span>
                @foreach ($errors->all() as $error)
                {{ $error }}
                @endforeach
            </div>
            @endif
            <div class="mb-5">
                <h2 class="fw-bolder fs-7 mb-3">Forgot your password?</h2>
                <p class="mb-0 ">
                  Please enter the email address associated with your account and We will email you a link to reset your password.
                </p>
              </div>
            <form method="POST" action="{{ route('member.forgotPasswordAuth') }}">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email or Phone</label>
                    <input type="text" name="emailOrPhone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email or Phone">
                  </div>
                <button class="btn btn-primary w-100 py-8 mb-3">Forgot Password</button>
                <a href="{{ route('member.login') }}" class="btn btn-light-primary text-primary w-100 py-8">Back to Login</a>
              </form>
        </div>
    </div>
</div>
{{-- new page --}}



@endsection
