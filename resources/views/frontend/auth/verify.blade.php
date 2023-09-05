@extends('layouts.frontend.auth')
@section('title', 'Verification')
@section('body')
<div class="col-xl-5 col-xxl-4">
    <div class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
        <div class="col-sm-8 col-md-6 col-xl-9">
            <h2 class="mb-3 fs-7 fw-bolder">Account Verification!</h2>
            <p class=" mb-9">Please enter the verification Code you have receive via email or Phone Number you provided to continue setup your account.</p>
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
            <form action="{{ route('member.verify',$id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Verify Code</label>
                    <input type="text" name="code" class="form-control" id="exampleInputEmail1" autocomplete="off" autofocus aria-describedby="emailHelp">
                </div>
                <button class="btn btn-primary w-100 py-8 mb-4 rounded-2">Verify</button>
                <a href="{{ route('member.login') }}" class="btn btn-light-primary text-primary w-100 py-8">Back to Login</a>

            </form>
        </div>
    </div>
</div>
{{-- new page --}}



@endsection
