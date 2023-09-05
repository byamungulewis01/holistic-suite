@extends('layouts.frontend.auth')
@section('title', 'Register')
@section('body')
<div class="col-xl-5 col-xxl-4">
    <div class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
        <div class="col-sm-8 col-md-6 col-xl-9">
            <h2 class="mb-3 fs-7 fw-bolder">Welcome to ADEPR MIS</h2>
            <p class=" mb-9">Please sign up to your account and start the adventure</p>
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

            <form action="{{ route('member.register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Reg Number</label>
                    <input type="text" name="reg_no" class="form-control" id="exampleInputEmail1" autocomplete="off" autofocus placeholder="Enter your Reg Number">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email or Phone</label>
                    <input type="text" name="emailOrPhone" class="form-control" id="exampleInputEmail1" autocomplete="off" placeholder="Enter your Email or Phone">
                </div>
                <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                </div>
                <button class="btn btn-primary w-100 py-8 mb-4 rounded-2">Sign Up</button>
                <div class="d-flex align-items-center">
                    <p class="fs-4 mb-0 text-dark">Already have an Account?</p>
                    <a class="text-primary fw-medium ms-2" href="{{ route('member.login') }}">Sign In</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
