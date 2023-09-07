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
                <h4 class="mb-0">Furneral Requests</h4>
            </div>
            <table id="datatable" class="table align-middle text-nowrap mb-0" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Names</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Date Of Birth</th>
                        <th scope="col">Date Of Death</th>
                        <th scope="col">Death Cource</th>
                        <th scope="col">Funeral Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Apply Date</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($collections as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->member->name }}</td>
                        <td>@if ($item->gender == 1) {{ __('message.gender.0.name') }}
                            @else {{ __('message.gender.1.name') }} @endif</td>
                        <td>{{ $item->member->dateOfBirth }}</td>
                        <td>{{ $item->dateOfDeath }}</td>
                        <td>{{ $item->deathCourse }}</td>
                        <td>{{ $item->dateOfFuneral }}</td>
                        <td>
                            @if ($item->status == 1)
                            <span class="badge fw-semibold py-1 w-100 bg-light-primary text-primary">Pending</span>
                            @elseif($item->status == 2)
                            <span class="badge fw-semibold py-1 w-100 bg-light-success text-success">Approved</span>
                            @else
                            <span class="badge fw-semibold py-1 w-100 bg-light-danger text-danger">Reject</span>
                            @endif
                        </td>
                        <td>{{ $item->created_at->format('m/d/Y') }}</td>
                        <td class="d-flex justify-content-center gap-1">
                            @unless ($item->status != 1)
                            <button data-bs-toggle="modal" data-bs-target="#approve{{ $item->id }}"
                                class="btn btn-sm btn-success" title="Approve"><i class="ti ti-check"></i></button>
                            <button data-bs-toggle="modal" data-bs-target="#reject{{ $item->id }}"
                                class="btn btn-sm btn-danger" title="Delete"><i class="ti ti-letter-x"></i></button>

                            @elseif($item->status == 2)
                            <a href="" data-bs-toggle="modal"
                                data-bs-target="#approveComment{{ $item->id }}">Comment</a>
                            <div class="modal fade" id="approveComment{{ $item->id }}" tabindex="-1"
                                aria-labelledby="vertical-center-modal" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content modal-filled">
                                        <div class="modal-body p-4">
                                            <div>
                                                <div class="mb-3">
                                                    <h4 class="mt-2 text-success">Approve Comment</h4>
                                                </div>
                                                <div class="mb-2">
                                                    <textarea rows="5" readonly
                                                        class="form-control">{{ $item->comment }}</textarea>
                                                </div>
                                                <div class="text-end">
                                                    <button type="button" class="btn btn-light font-medium"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                            </div>
                            @else
                            <a href="" data-bs-toggle="modal" data-bs-target="#rejectComment{{ $item->id }}">Comment</a>
                            <div class="modal fade" id="rejectComment{{ $item->id }}" tabindex="-1"
                                aria-labelledby="vertical-center-modal" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content modal-filled">
                                        <div class="modal-body p-4">
                                            <div>
                                                <div class="mb-3">
                                                    <h4 class="mt-2 text-danger">Reject Comment</h4>
                                                </div>
                                                <div class="mb-2">
                                                    <textarea rows="5" readonly
                                                        class="form-control">{{ $item->comment }}</textarea>
                                                </div>
                                                <div class="text-end">
                                                    <button type="button" class="btn btn-light font-medium"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                            </div>
                            @endunless
                            <div class="modal fade" id="approve{{ $item->id }}" tabindex="-1"
                                aria-labelledby="vertical-center-modal" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content modal-filled">
                                        <div class="modal-body p-4">
                                            <div>
                                                <div class="mb-3">
                                                    <h4 class="mt-2">Approve Application</h4>
                                                </div>
                                                <form
                                                    action="{{ route('localChurch.memberStep.funeralApprove',$item->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-2">
                                                        <label for="message-text" class="control-label">Comment:</label>
                                                        <textarea name="comment" class="form-control" id="message-text1"
                                                            placeholder="Comments on Application"></textarea>
                                                    </div>
                                                    <div class="text-center">
                                                        <button class="btn btn-light-success my-2">
                                                            Continue
                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-light-danger text-danger font-medium"
                                                            data-bs-dismiss="modal">
                                                            Close
                                                        </button>
                                                    </div>
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
                                    <div class="modal-content modal-filled">
                                        <div class="modal-body p-4">
                                            <div>
                                                <div class="mb-3">
                                                    <h4 class="mt-2">Reject Application</h4>
                                                </div>

                                                <form
                                                    action="{{ route('localChurch.memberStep.funeralReject',$item->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-2">
                                                        <label for="message-text" class="control-label">Comment:</label>
                                                        <textarea name="comment" class="form-control" id="message-text1"
                                                            placeholder="Comments on Application"></textarea>
                                                    </div>
                                                    <div class="text-center">
                                                        <button class="btn btn-light-success my-2">
                                                            Continue
                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-light-danger text-danger font-medium"
                                                            data-bs-dismiss="modal"> Close </button>
                                                    </div>
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
