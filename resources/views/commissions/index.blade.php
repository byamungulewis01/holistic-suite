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
                <h4 class="mb-0">Commissions</h4>

                <div class="btn-group">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New
                    </button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-md">
                            <div class="modal-content rounded-1">
                                <div class="modal-header d-flex align-items-center">
                                    <h4 class="modal-title" id="exampleModalLabel1">
                                        Commissions
                                    </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>

                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('localChurch.commission.store') }}" method="post" onsubmit="disableSubmitButton()">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="commission" class="control-label mb-2">Commission:</label>
                                            <select class="form-select" name="commission_id"
                                                style="width: 100%; height: 36px">
                                                @foreach(__('message.commissions') as $i)
                                                <option {{ old('commission_id') == $i['id'] ? 'selected' : '' }}
                                                    value="{{ $i['id'] }}">
                                                    {{ $i['name'] }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="status" class="control-label mb-2">Status:</label>
                                            <select class="form-select" name="status" style="width: 100%; height: 36px">
                                                @foreach(__('message.callingStatus') as $i)
                                                <option {{ old('status') == $i['id'] ? 'selected' : '' }}
                                                    value="{{ $i['id'] }}">
                                                    {{ $i['name'] }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 text-center">
                                            <button type="submit" id="submitButton" class="btn btn-primary">Submit</button>
                                        </div>

                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <table id="datatable" class="table align-middle text-nowrap mb-0" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">C Code</th>
                        <th scope="col">Commission</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($commissions as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->code }}</td>
                        <td>
                            @php
                            $attr = __('message.attribute');
                            @endphp
                            {{ $item->commission->$attr }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d -m - Y') }}</td>
                        <td>
                            @if ($item->status == 1)
                            <span
                                class="mb-1 badge font-medium bg-light-info text-info">{{ __('message.callingStatus.0.name') }}</span>
                            @else
                            <span
                                class="mb-1 badge font-medium bg-light-danger text-danger">{{ __('message.callingStatus.1.name') }}</span>
                            @endif
                        </td>
                        <td class="d-flex justify-content-center gap-1">
                            <a href="{{ route('localChurch.commission.members',$item->id) }}" class="btn btn-sm btn-primary">View</a>
                            <a href="" data-bs-toggle="modal" data-bs-target="#editModel{{ $item->id }}"
                                class="btn btn-sm btn-success">Edit</a>
                            <a data-bs-toggle="modal" data-bs-target="#deleteList{{ $item->id }}"
                                class="btn btn-sm btn-danger" href="#">Delete</a>

                            <div class="modal fade" id="deleteList{{ $item->id }}" tabindex="-1"
                                aria-labelledby="vertical-center-modal" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content modal-filled bg-light-danger">
                                        <div class="modal-body p-4">
                                            <form action="{{ route('localChurch.commission.destroy',$item->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <div class="text-center text-danger">
                                                    <i class="ti ti-hexagon-letter-x fs-7"></i>
                                                    <h4 class="mt-2">Are you sure to delete?</h4>
                                                    <p class="mt-3">
                                                        Delete Commission will remove the member
                                                        from Commission list.
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
                            <!-- /.modal-content -->

                            <div class="modal fade" id="editModel{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-md">
                                    <div class="modal-content rounded-1">
                                        <div class="modal-header d-flex align-items-center">
                                            <h4 class="modal-title" id="exampleModalLabel1">
                                                Edit Commission
                                            </h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>

                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('localChurch.commission.update',$item->id) }}"
                                                method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="commission" class="control-label mb-2">Commission:</label>
                                                    <select class="form-select" name="commission_id"
                                                        style="width: 100%; height: 36px">
                                                        @foreach(__('message.commissions') as $i)
                                                        <option {{ $item->commission_id == $i['id'] ? 'selected' : '' }}
                                                            value="{{ $i['id'] }}">
                                                            {{ $i['name'] }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="status" class="control-label mb-2">Status:</label>
                                                    <select class="form-select" name="status" style="width: 100%; height: 36px">
                                                        @foreach(__('message.callingStatus') as $i)
                                                        <option {{ $item->status == $i['id'] ? 'selected' : '' }}
                                                            value="{{ $i['id'] }}">
                                                            {{ $i['name'] }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3 text-center">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
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
        $("#datatable").DataTable({
            scrollX: true,
        });
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
