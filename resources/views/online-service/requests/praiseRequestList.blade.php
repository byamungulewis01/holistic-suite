@extends('layouts.app')
@section('title', 'Commissions')
@section('css')
<link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/libs/daterangepicker/daterangepicker.css') }}">
@endsection
@section('body')
<div class="product-list">
    <div class="card">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center mb-9">
                <h4 class="mb-0">Gushima Imana Requests</h4>
            </div>
            <table id="datatable" class="table align-middle text-nowrap mb-0" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Reg Number</th>
                        <th scope="col">Names</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Service</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Apply Date</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($collections as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->member->reg_no }}</td>
                        <td>{{ $item->member->name }}</td>
                        <td>@if ($item->member->gender == 1) {{ __('message.gender.0.name') }}
                            @else {{ __('message.gender.1.name') }} @endif</td>

                        <td>
                            @php
                            $attr = __('message.attribute');
                            @endphp
                            {{ $item->service_type->$attr }}
                        </td>
                        <td>
                            {{ $item->date }}
                        </td>
                        <td>
                            @if ($item->status == 1)
                            <span class="badge fw-semibold py-1 w-85 bg-light-primary text-primary">Pending</span>
                            @elseif($item->status == 2)
                            <span class="badge fw-semibold py-1 w-85 bg-light-success text-success">Approved</span>
                            @else
                            <span class="badge fw-semibold py-1 w-85 bg-light-danger text-danger">Reject</span>
                            @endif
                        </td>
                        <td>{{ $item->created_at->format('Y/m/d') }}</td>
                        <td class="d-flex justify-content-center gap-1">
                            @unless ($item->status != 1)
                            <button data-bs-toggle="modal" data-bs-target="#deleteRequest{{ $item->id }}"
                                class="btn btn-sm btn-danger" title="Delete"><i class="ti ti-trash"></i></button>

                            @elseif($item->status == 2)
                            <button class="btn btn-success">Accepted</button>
                            @else
                            Rejected
                            @endunless

                            <div class="modal fade" id="deleteRequest{{ $item->id }}" tabindex="-1"
                                aria-labelledby="vertical-center-modal" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content modal-filled bg-light-danger">
                                        <div class="modal-body p-4">
                                            <form action="{{ route('member.request.destroyPraiseRequest',$item->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <div class="text-center text-danger">
                                                    <i class="ti ti-hexagon-letter-x fs-7"></i>
                                                    <h4 class="mt-2">Are you sure to delete?</h4>
                                                    <p class="mt-3">
                                                        You will not be able to recover this file data!
                                                    </p>
                                                    <button class="btn btn-light my-2">
                                                        Yes I'm sure
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
<script src="{{ asset('dist/libs/bootstrap-material-datetimepicker/node_modules/moment/moment.js') }}"></script>
<script src="{{ asset('dist/libs/daterangepicker/daterangepicker.js') }}"></script>
<script>
    $(".daterange").daterangepicker({
        opens: "left",
        drops: "up"
    });
</script>
@endsection