@extends('layouts.app')
@section('title', 'Step & Class')
@section('css')
<link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/libs/daterangepicker/daterangepicker.css') }}">
@endsection
@section('body')
<div class="product-list">
    <div class="card">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center mb-9">
                <h4 class="mb-0">Member Step & Class</h4>

                <div class="btn-group">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New </button>
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
                            <form action="{{ route('localChurch.step.store') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="className" class="control-label mb-2">Class Name:</label>
                                    <input type="text" class="form-control" name="name" id="className" placeholder="Class Name" required>
                                </div>
                                <div class="row mb-3">
                                 <div class="col-md-6">
                                    <label for="message-text" class="control-label mb-2">Teacher:</label>
                                    <select class="form-select" name="teacher_id"
                                        aria-label="Default select example">
                                        <option selected>Select Teacher</option>
                                        @foreach ($teachers as $item)
                                        <option value="{{ $item->member->id }}">{{ $item->member->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="message-text" class="control-label mb-2">Member Step:</label>
                                    <select class="form-select" name="step_id"
                                        style="width: 100%; height: 36px">
                                        <option value="" selected disabled> Select </option>
                                        <optgroup label="Member Step">
                                            @foreach(__('message.steps') as $i)
                                                <option {{ old('step_id') == $i['id'] ? 'selected' : '' }} value="{{ $i['id'] }}">
                                                {{ $i['name'] }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                        <optgroup label="Training">
                                            @foreach(__('message.trainings') as $i)
                                                <option {{ old('step_id') == $i['id'] ? 'selected' : '' }} value="{{ $i['id'] }}">
                                                {{ $i['name'] }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="className" class="control-label mb-2">Starting - Ending Date:</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="period" class="form-control daterange" />

                                        <span class="input-group-text">
                                          <i class="ti ti-calendar fs-5"></i>
                                        </span>
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
            <table id="datatable" class="table align-middle text-nowrap mb-0" style="width: 100%;">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Class</th>
                        <th scope="col">Teacher</th>
                        <th scope="col">Step/Training</th>
                        <th scope="col">Period</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($steps as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->teacher->name }}</td>
                        <td>
                            @if ($item->step_id == 1)
                            {{ __('message.steps.0.name') }}
                            @elseif($item->step_id == 2)
                            {{ __('message.steps.1.name') }}
                            @elseif($item->step_id == 3)
                            {{ __('message.trainings.0.name') }}
                            @elseif($item->step_id == 4)
                            {{ __('message.trainings.1.name') }}
                            @elseif($item->step_id == 5)
                            {{ __('message.trainings.2.name') }}
                            @else

                            @endif
                        </td>
                        <td>{{ $item->period }}</td>
                        <td>
                            @if ($item->status == 1)
                            <span class="mb-1 badge font-medium bg-light-info text-info">{{ __('message.callingStatus.0.name') }}</span>
                            @else
                            <span class="mb-1 badge font-medium bg-light-danger text-danger">{{ __('message.callingStatus.1.name') }}</span>
                            @endif
                        </td>
                        <td>
                                <div class="btn-group mb-2">
                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                      Action
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                      <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModel{{ $item->id }}" href="#">Edit</a></li>
                                      <li>
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteList{{ $item->id }}" href="#">Delete</a>
                                      </li>
                                      <li>
                                        <a class="dropdown-item" href="{{ route('localChurch.step.members',$item->id) }}">Members</a>
                                      </li>
                                      <li>
                                        <a class="dropdown-item" href="{{ route('localChurch.step.schedule',$item->id) }}">Class Chedule</a>
                                      </li>
                                      <li>
                                        <a class="dropdown-item" href="#">Attendence</a>
                                      </li>
                                    </ul>
                                </div>

                            <div class="modal fade" id="deleteList{{ $item->id }}" tabindex="-1"
                                aria-labelledby="vertical-center-modal" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content modal-filled bg-light-danger">
                                        <div class="modal-body p-4">
                                            <form action="{{ route('localChurch.step.destroy',$item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <div class="text-center text-danger">
                                                    <i class="ti ti-hexagon-letter-x fs-7"></i>
                                                    <h4 class="mt-2">Are you sure to delete?</h4>
                                                    <p class="mt-3">
                                                        Delete Step will remove the member
                                                        from Calling list.
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
                                            Modify Class & Step
                                        </h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>

                                    </div>
                                    <div class="modal-body">
                                    <form action="{{ route('localChurch.step.update',$item->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="className" class="control-label mb-2">Class Name:</label>
                                            <input type="text" class="form-control" name="name" id="className" value="{{ $item->name }}" required>
                                        </div>
                                        <div class="row mb-3">
                                         <div class="col-md-6">
                                            <label for="message-text" class="control-label mb-2">Teacher:</label>
                                            <select class="form-select" name="teacher_id"
                                                aria-label="Default select example">
                                                <option selected>Select Teacher</option>
                                                @foreach ($teachers as $i)
                                                <option {{ $item->teacher_id == $i->member->id ? 'selected' : '' }} value="{{ $i->member->id }}">{{ $i->member->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="message-text" class="control-label mb-2">Member Step:</label>
                                            <select class="form-select" name="step_id"
                                                style="width: 100%; height: 36px">
                                               <optgroup label="Member Steps">
                                                    @foreach(__('message.steps') as $i)
                                                    <option {{ $item->step_id == $i['id'] ? 'selected' : '' }} value="{{ $i['id'] }}">
                                                    {{ $i['name'] }}
                                                    </option>
                                                    @endforeach
                                               </optgroup>
                                               <optgroup label="Trainigs">
                                                    @foreach(__('message.trainings') as $i)
                                                    <option {{ $item->step_id == $i['id'] ? 'selected' : '' }} value="{{ $i['id'] }}">
                                                    {{ $i['name'] }}
                                                    </option>
                                                    @endforeach
                                               </optgroup>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-8">
                                                <label for="className" class="control-label mb-2">Starting - Ending Date:</label>
                                                <div class="input-group mb-3">
                                                    <input value="{{ $item->period }}" type="text" name="period" class="form-control daterange" />

                                                    <span class="input-group-text">
                                                      <i class="ti ti-calendar fs-5"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="className" class="control-label mb-2">Status </label>
                                                <select class="form-select" name="status"
                                                    style="width: 100%; height: 36px">
                                                    @foreach(__('message.callingStatus') as $i)
                                                        <option {{ $item->status == $i['id'] ? 'selected' : '' }} value="{{ $i['id'] }}">
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
<script src="{{ asset('dist/libs/bootstrap-material-datetimepicker/node_modules/moment/moment.js') }}"></script>
<script src="{{ asset('dist/libs/daterangepicker/daterangepicker.js') }}"></script>
<script>
  $(".daterange").daterangepicker({
    opens: "left",
    drops: "up"
  });
</script>
@endsection
