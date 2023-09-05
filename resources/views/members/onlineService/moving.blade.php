@extends('layouts.app')
@section('title', 'Moving Services')
@section('css')
<link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/libs/daterangepicker/daterangepicker.css') }}">
@endsection
@section('body')
<div class="product-list">
    <div class="card">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center mb-9">
                <h4 class="mb-0">Recomandation Applications </h4>
            </div>
            <table id="datatable" class="table align-middle text-nowrap mb-0" style="width: 100%;">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Reg Number</th>
                        <th scope="col">Names</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Church Moving to</th>
                        <th scope="col">Apply Date</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applications as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->member->reg_no }}</td>
                        <td>{{ $item->member->name }}</td>
                        <td>{{ $item->member->phone }}</td>
                        <td>
                            {{ $item->region->name }} > {{ $item->parish->name }} > {{ $item->localChurch->name }}
                        </td>
                        <td>{{ $item->created_at->format('Y/m/d') }}</td>
                        <td>
                            @if ($item->status == 1)
                            <span class="badge fw-semibold py-1 w-85 bg-light-primary text-primary">Pending</span>
                            @elseif($item->status == 2)
                            <span class="badge fw-semibold py-1 w-85 bg-light-success text-success">Approved</span>
                            @else
                            <span class="badge fw-semibold py-1 w-85 bg-light-danger text-danger">Reject</span>
                            @endif
                        </td>
                        <td>
                            @unless ($item->status != 1)
                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                data-bs-target="#approve{{ $item->id }}">
                                Aproove
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                data-bs-target="#reject{{ $item->id }}">
                                Reject
                            </button>
                            @elseif($item->status == 2)
                            <button class="btn btn-success">Certificate</button>
                            @else
                            Rejected
                            @endunless

                            <!-- Vertically centered modal -->
                            <div class="modal fade" id="approve{{ $item->id }}" tabindex="-1"
                                aria-labelledby="vertical-center-modal" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content modal-filled bg-light-warning">
                                        <div class="modal-body p-4">
                                            <div class="text-center text-warning">
                                                <i class="ti ti-alert-octagon fs-7"></i>
                                                <h4 class="mt-2">Approve Application</h4>
                                                <p class="mt-3">
                                                    Cras mattis consectetur purus sit amet
                                                    fermentum.Cras justo odio,
                                                </p>
                                                <form
                                                    action="{{ route('localChurch.onlineService.aprooveMoving',$item->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="btn btn-light my-2">
                                                        Continue
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                            </div>
                            <!-- Vertically centered modal -->
                            <div class="modal fade" id="reject{{ $item->id }}" tabindex="-1"
                                aria-labelledby="vertical-center-modal" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content modal-filled bg-light-danger">
                                        <div class="modal-body p-4">
                                            <div class="text-center text-danger">
                                                <i class="ti ti-alert-octagon fs-7"></i>
                                                <h4 class="mt-2">Reject Application</h4>
                                                <p class="mt-3">
                                                    Cras mattis consectetur purus sit amet
                                                    fermentum.Cras justo odio,
                                                </p>
                                                <form action="{{ route('localChurch.onlineService.rejectMoving',$item->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="btn btn-light my-2">
                                                        Continue
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
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
