@extends('layouts.app')
@section('title', 'Profile')
@section('css')
<link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection
@section('body')
<div class="container-fluid">
    <div class="card overflow-hidden">
      <div class="card-body p-0">
        <div class="row align-items-center">
          <div class="col-lg-4 order-lg-1 order-2">
            <div class="d-flex align-items-center m-4">
              <div class="text-center">
                {{-- <h4 class="mb-0 fw-semibold lh-1 text-primary">REG: {{ $penitent->reg_no }}</h4> --}}
              </div>
            </div>
          </div>
        </div>
        <ul class="nav nav-pills user-profile-tab justify-content-end mt-2 bg-light-info rounded-2" id="pills-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6 active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="true">
              <i class="ti ti-user-circle me-2 fs-6"></i>
              <span class="d-none d-md-block">Profile</span>
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6" id="pills-followers-tab" data-bs-toggle="pill" data-bs-target="#pills-followers" type="button" role="tab" aria-controls="pills-followers" aria-selected="false" tabindex="-1">
              <i class="ti ti-heart me-2 fs-6"></i>
              <span class="d-none d-md-block">Family</span>
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6" id="pills-friends-tab" data-bs-toggle="pill" data-bs-target="#pills-friends" type="button" role="tab" aria-controls="pills-friends" aria-selected="false" tabindex="-1">
              <i class="ti ti-user-circle me-2 fs-6"></i>
              <span class="d-none d-md-block">Steps</span>
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6" id="pills-gallery-tab" data-bs-toggle="pill" data-bs-target="#pills-gallery" type="button" role="tab" aria-controls="pills-gallery" aria-selected="false" tabindex="-1">
              <i class="ti ti-photo-plus me-2 fs-6"></i>
              <span class="d-none d-md-block">Class</span>
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6" id="pills-gallery-tab" data-bs-toggle="pill" data-bs-target="#pills-gallery" type="button" role="tab" aria-controls="pills-gallery" aria-selected="false" tabindex="-1">
              <i class="ti ti-user me-2 fs-6"></i>
              <span class="d-none d-md-block">Groups</span>
            </button>
          </li>
        </ul>
      </div>
    </div>
    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade active show" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
        <div class="row">
          <div class="col-lg-5">
            <div class="card shadow-none border">
              <div class="card-body">
                <h4 class="fw-semibold mb-3 text-info">Introduction</h4>
                <ul class="list-unstyled mb-0">
                  <li class="d-flex align-items-center gap-3 mb-4">
                    <i class="ti ti-briefcase text-dark fs-6"></i>
                    <h6 class="fs-4 mb-0">{{ $penitent->name }}</h6>
                  </li>
                  <li class="d-flex align-items-center gap-3 mb-4">
                    <i class="ti ti-mail text-dark fs-6"></i>
                    <h6 class="fs-4 mb-0">{{ $penitent->email == null ? 'N/A' : $penitent->email }}</h6>
                  </li>
                  <li class="d-flex align-items-center gap-3 mb-4">
                    <i class="ti ti-phone text-dark fs-6"></i>
                    <h6 class="fs-4 mb-0">{{ $penitent->phone == null ? 'N/A' : $penitent->phone }}</h6>
                  </li>
                  <li class="d-flex align-items-center gap-3 mb-4">
                    <i class="ti ti-calendar text-dark fs-6"></i>
                    <h6 class="fs-4 mb-0">{{ $penitent->dateOfBirth }}</h6>
                  </li>
                  <li class="d-flex align-items-center gap-3 mb-2">
                    <i class="ti ti-map-pin text-dark fs-6"></i>
                    <h6 class="fs-4 mb-0">{{ $penitent->sector }}, {{ $penitent->cell }} , {{ $penitent->village }}</h6>
                  </li>
                </ul>
              </div>
            </div>

          </div>
        </div>
      </div>
   
    </div>
  </div>
@endsection
@section('script')

<!-- ---------------------------------------------- -->
<script src="{{ asset('dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dist/libs/datatables.net/js/dataTables.bootstrap5.min.js') }}"></script>
<script>
    $(function () {
        $("#datatable").DataTable({
            scrollX: true,
        });
    });

</script>
@endsection
