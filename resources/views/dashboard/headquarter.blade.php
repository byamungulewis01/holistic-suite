@extends('layouts.app')
@section('title', 'Dashboard')
@section('body')
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">{{ __('message.hq') }} </h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted " href="#">{{ __('message.dashboard') }}</a></li>
              <li class="breadcrumb-item" aria-current="page"><a class="text-muted " href="#">{{ __('message.hq') }}</a></li>
            </ol>
          </nav>
        </div>
        <div class="col-3">
          {{-- <div class="text-center mb-n5">
            <img src="../../dist/images/breadcrumb/ChatBc.png" alt="" class="img-fluid mb-n4">
          </div> --}}
        </div>
      </div>
    </div>
  </div>
  @endsection
