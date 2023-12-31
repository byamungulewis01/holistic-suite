@extends('layouts.frontend.auth')
@section('title', 'Forgot Password')
@section('body')
<div class="col-xl-5 col-xxl-4">
    <div class="mb-5 text-center">
        <h1 class="h3 text-gray-900 mb-4">Successfull </h1>
        <p class="mb-0 ">
          Please enter the email address associated with your account and We will email you a link to reset your password.
        </p>
      </div>
      <a href="{{ route('member.login') }}" class="btn btn-light-primary text-primary w-100 py-8">Back to Login</a>
</div>
{{-- new page --}}
@endsection
