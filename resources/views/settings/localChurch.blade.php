@extends('layouts.app')
@section('title', 'Wedding Project')
@section('css')
<link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/libs/daterangepicker/daterangepicker.css') }}">
@endsection
@section('body')
<div class="row">
    <div class="col-lg-5 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body">
                <h5 class="card-title fw-semibold">Settings List</h5>
                <p class="card-subtitle">Preparation for the Upcoming Activity</p>

                <div class="py-6 d-flex align-items-center">
                    <div
                        class="flex-shrink-0 bg-light-danger rounded-circle round d-flex align-items-center justify-content-center">
                        <i class="ti ti-bookmark fs-6 text-danger"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 fw-semibold">Wedding Project</h6>
                        @php
                           $price = \App\Models\Office::where('id',auth()->user()->local_church_id)->first()->wedding_price;
                        @endphp
                        <span class="fs-5">{{ number_format($price) }} frw</span>
                    </div>
                    <div class="ms-auto">
                        <button data-bs-toggle="modal" data-bs-target="#modelOpen" class="btn btn-sm btn-primary"
                            title="Update"><i class="ti ti-edit"></i> Update</button>
                        <div class="modal fade" id="modelOpen" tabindex="-1" aria-labelledby="vertical-center-modal"
                            aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content modal-filled">
                                    <div class="modal-body p-4">
                                        <div>
                                            <form action="{{ route('localChurch.setting.setWeddingPrice') }}"
                                                method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <h5 class="mt-2">Wedding Cost</h5>
                                                </div>
                                                <div class="mb-2">
                                                    <input name="amount" type="number" value="{{ $price }}"
                                                      required class="form-control" min="0">
                                                </div>
                                                <div class="text-end">
                                                    <button type="button" class="btn btn-light font-medium"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button class="btn btn-primary font-medium">
                                                        Save
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
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
        $("#datatable").DataTable({scrollX: true,});
    });
</script>
@endsection
