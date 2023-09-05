@extends('layouts.app')
@section('title', 'Ministry Groups')
@section('css')
<link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection
@section('body')
<div class="product-list">
    <div class="card">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center mb-9">
                <h4 class="mb-0">Ministry Groups </h4>

                <div class="btn-group">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">New
                        Ministry</button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-md">
                            <div class="modal-content rounded-1">
                                <div class="modal-header d-flex align-items-center">
                                    <h4 class="modal-title" id="exampleModalLabel1">
                                        Member Class
                                    </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>

                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('localChurch.group.store') }}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="className" class="control-label mb-2">Group Name:</label>
                                            <input type="text" class="form-control" name="name" id="className"
                                                placeholder="Group Name" autocomplete="off" required>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="message-text" class="control-label mb-2">Ministry:</label>
                                                <select class="form-select" name="ministry_id"
                                                    aria-label="Default select example">
                                                    <option selected>Select Ministry</option>
                                                    @foreach(__('message.ministries') as $i)
                                                    <option {{ old('ministry_id') == $i['id'] ? 'selected' : '' }}
                                                        value="{{ $i['id'] }}">
                                                        {{ $i['name'] }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="message-text" class="control-label mb-2">Started
                                                    Date:</label>
                                                <div class="input-group">
                                                    <input name="startDate" type="text" class="form-control datepicker"
                                                        required value="{{ old('startDate') }}" autocomplete="off"
                                                        placeholder="mm/dd/yyyy" />

                                                    <span class="input-group-text">
                                                        <i class="ti ti-calendar fs-5"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 text-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
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
                        <th scope="col">G Code</th>
                        <th scope="col">Group Name</th>
                        <th scope="col">Ministry</th>
                        <th scope="col">Started Date</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($groups as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->code }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            @php $attr = __('message.attribute'); @endphp
                            {{ $item->ministry->$attr }}
                        </td>
                        <td>{{ $item->startDate }}</td>
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
                            <a href="{{ route('localChurch.group.members',$item->id) }}" class="btn btn-sm btn-success"><i class="ti ti-list"></i> View</a>
                            <button data-bs-toggle="modal" data-bs-target="#editModel{{ $item->id }}" class="btn btn-sm btn-primary"><i class="ti ti-pencil"></i> Edit</button>
                            <button data-bs-toggle="modal" data-bs-target="#deleteList{{ $item->id }}" class="btn btn-sm btn-danger"><i class="ti ti-trash"></i> Delete</button>

                            <div class="modal fade" id="deleteList{{ $item->id }}" tabindex="-1"
                                aria-labelledby="vertical-center-modal" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content modal-filled bg-light-danger">
                                        <div class="modal-body p-4">
                                            <form action="{{ route('localChurch.group.destroy',$item->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <div class="text-center text-danger">
                                                    <i class="ti ti-hexagon-letter-x fs-7"></i>
                                                    <h4 class="mt-2">Are you sure to delete?</h4>
                                                    <p class="mt-3">
                                                        Delete Group will remove the member
                                                        from Groups list.
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
                                                Modify Ministry Group
                                            </h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>

                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('localChurch.group.update',$item->id) }}"
                                                method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="className" class="control-label mb-2">Group
                                                        Name:</label>
                                                    <input type="text" class="form-control" name="name" id="className"
                                                        value="{{ $item->name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="message-text"
                                                        class="control-label mb-2">Ministry:</label>
                                                    <select class="form-select" name="ministry_id"
                                                        aria-label="Default select example">
                                                        <option selected>Select Ministry</option>
                                                        @foreach(__('message.ministries') as $i)
                                                        <option {{ $item->ministry_id == $i['id'] ? 'selected' : '' }}
                                                            value="{{ $i['id'] }}">
                                                            {{ $i['name'] }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="message-text" class="control-label mb-2">Started
                                                            Date:</label>
                                                        <div class="input-group">
                                                            <input name="startDate" type="text"
                                                                class="form-control datepicker" required
                                                                value="{{ $item->startDate }}" />

                                                            <span class="input-group-text">
                                                                <i class="ti ti-calendar fs-5"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                        <div class="col-md-6">
                                                            <label for="className" class="control-label mb-2">Status
                                                            </label>
                                                            <select class="form-select" name="status"
                                                                style="width: 100%; height: 36px">
                                                                @foreach(__('message.callingStatus') as $i)
                                                                <option
                                                                    {{ $item->status == $i['id'] ? 'selected' : '' }}
                                                                    value="{{ $i['id'] }}">
                                                                    {{ $i['name'] }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
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

<script src="{{ asset('dist/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    jQuery(".datepicker").datepicker({
        autoclose: true,
        todayHighlight: true,
        endDate: '0d',
    });

</script>
@endsection
