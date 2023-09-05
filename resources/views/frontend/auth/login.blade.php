@extends('layouts.frontend.auth')
@section('title', 'Login')
@section('body')
<div class="col-xl-5 col-xxl-4">
    <div class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
        <div class="col-sm-8 col-md-6 col-xl-9">
            <h2 class="mb-3 fs-7 fw-bolder">Welcome to ADEPR MIS</h2>
            <p class=" mb-9">Please sign in to your account and start the adventure</p>
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
            <form method="POST" action="{{ route('member.login') }}">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Reg Number</label>
                    <input type="text" name="reg_no" autocomplete="off" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                        <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                        <label class="form-check-label text-dark" for="flexCheckChecked">
                            Remeber this Device
                        </label>
                    </div>
                    <a class="text-primary fw-medium" href="{{ route('member.forgotPassword') }}">Forgot Password ?</a>
                </div>
                <button class="btn btn-primary w-100 py-8 mb-4 rounded-2">Sign In</button>
                <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-medium">New to AMS?</p>
                    <a class="text-primary fw-medium ms-2" href="{{ route('member.register') }}">Create an account</a>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- new page --}}



@endsection
