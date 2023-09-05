@extends('layouts.app')
@section('title', 'Sunday School')
@section('css')
<link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection
@section('body')
<div class="product-list">
    <div class="card">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center mb-9">
                <h4 class="mb-0">Sunday School</h4>

                <div class="btn-group">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">New
                        Sunday School</button>
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
                                    <form action="{{ route('localChurch.sundaySchool.store') }}" method="post">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="message-text" class="control-label mb-2">Sunday School
                                                    Level:</label>
                                                <select class="form-select" name="level"
                                                    aria-label="Default select example">
                                                    <option selected disabled>Select Ministry</option>
                                                    <optgroup label="Ordinary">
                                                        @foreach(__('message.sundaySchoolLevel') as $i)
                                                        <option {{ old('level') == $i['id'] ? 'selected' : '' }}
                                                            value="{{ $i['id'] }}">
                                                            {{ $i['name'] }}
                                                        </option>
                                                        @endforeach
                                                    </optgroup>
                                                    <optgroup label="Catch Up">
                                                        @foreach(__('message.catchUpLevel') as $i)
                                                        <option {{ old('level') == $i['id'] ? 'selected' : '' }}
                                                            value="{{ $i['id'] }}">
                                                            {{ $i['name'] }}
                                                        </option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="class" class="control-label mb-2">Class:</label>

                                                <select class="form-control" id="class" name="class" required>
                                                    <option selected value="" disabled>Select Class</option>
                                                    <option {{ old('class') == 'A' ? 'selected' : '' }} value="A">A</option>
                                                    <option {{ old('class') == 'B' ? 'selected' : '' }} value="B">B</option>
                                                    <option {{ old('class') == 'C' ? 'selected' : '' }} value="C">C</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label for="message-text" class="control-label mb-2">Sunday School
                                                    Teacher:</label>
                                                <select class="form-select" name="teacher_id" required
                                                    aria-label="Default select example">
                                                    <option selected>Select Ministry</option>
                                                    @foreach($teachers as $teacher)
                                                    <option {{ old('teacher_id') ==  $teacher->member->id ? 'selected' : '' }}
                                                        value="{{  $teacher->member->id }}">
                                                        {{ $teacher->member->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
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
                        <th scope="col">Class</th>
                        <th scope="col">Teacher</th>
                        <th scope="col">Members</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schools as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->classIndex }}{{ $item->class }}</td>
                        <td>{{ $item->teacher->name }}</td>
                        <td>
                            <span class="mb-1 badge font-medium bg-light-danger text-danger">{{ $item->members->count() }}</span>
                        </td>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                        <td>
                            @if ($item->status == 1)
                            <span
                                class="mb-1 badge font-medium bg-light-info text-info">{{ __('message.callingStatus.0.name') }}</span>
                            @else
                            <span
                                class="mb-1 badge font-medium bg-light-danger text-danger">{{ __('message.callingStatus.1.name') }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group mb-2">
                                <button class="btn btn-primary dropdown-toggle" type="button"
                                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    Action
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                    <li><a class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#editModel{{ $item->id }}" href="#">Edit</a></li>
                                        <li>
                                            <a class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#deleteList{{ $item->id }}" href="#">Delete</a>
                                        </li>
                                    <li><a class="dropdown-item" href="{{ route('localChurch.sundaySchool.members',$item->id) }}">Members</a></li>
                                    {{-- <li><a class="dropdown-item" href="#">Class Shedule</a></li>
                                    <li><a class="dropdown-item" href="#">Attendence</a></li> --}}
                                </ul>
                            </div>

                            <div class="modal fade" id="deleteList{{ $item->id }}" tabindex="-1"
                                aria-labelledby="vertical-center-modal" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content modal-filled bg-light-danger">
                                        <div class="modal-body p-4">
                                            <form action="{{ route('localChurch.sundaySchool.destroy',$item->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <div class="text-center text-danger">
                                                    <i class="ti ti-hexagon-letter-x fs-7"></i>
                                                    <h4 class="mt-2">Are you sure to delete?</h4>
                                                    <p class="mt-3">
                                                        Delete Sunday School will remove the member
                                                        from Sunday School list.
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
                                                Modify Sunday School
                                            </h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>

                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('localChurch.sundaySchool.update',$item->id) }}"
                                                method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="message-text" class="control-label mb-2">Sunday School
                                                            Level:</label>
                                                        <select class="form-select" name="level"
                                                            aria-label="Default select example">
                                                            <option selected disabled>Select Ministry</option>
                                                            <optgroup label="Ordinary">
                                                                @foreach(__('message.sundaySchoolLevel') as $i)
                                                                <option {{ $item->level == $i['id'] ? 'selected' : '' }}
                                                                    value="{{ $i['id'] }}">
                                                                    {{ $i['name'] }}
                                                                </option>
                                                                @endforeach
                                                            </optgroup>
                                                            <optgroup label="Catch Up">
                                                                @foreach(__('message.catchUpLevel') as $i)
                                                                <option {{ $item->level == $i['id'] ? 'selected' : '' }}
                                                                    value="{{ $i['id'] }}">
                                                                    {{ $i['name'] }}
                                                                </option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="class" class="control-label mb-2">Class:</label>

                                                        <select class="form-control" id="class" name="class" required>
                                                            <option selected value="" disabled>Select Class</option>
                                                            <option {{ $item->class == 'A' ? 'selected' : '' }} value="A">A</option>
                                                            <option {{ $item->class == 'B' ? 'selected' : '' }} value="B">B</option>
                                                            <option {{ $item->class == 'C' ? 'selected' : '' }} value="C">C</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="message-text" class="control-label mb-2">Sunday School
                                                            Teacher:</label>
                                                        <select class="form-select" name="teacher_id"
                                                            aria-label="Default select example">
                                                            <option selected>Select Ministry</option>
                                                            @foreach($teachers as $teacher)
                                                            <option {{ $item->teacher_id ==  $teacher->member->id ? 'selected' : '' }}
                                                                value="{{  $teacher->member->id }}">
                                                                {{ $teacher->member->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="className" class="control-label mb-2">Status
                                                        </label>
                                                        <select class="form-select" name="status"
                                                            style="width: 100%; height: 36px">
                                                            @foreach(__('message.callingStatus') as $i)
                                                            <option {{ $item->status == $i['id'] ? 'selected' : '' }}
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
        $("#datatable").DataTable();
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
