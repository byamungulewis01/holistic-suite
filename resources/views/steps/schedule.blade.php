@extends('layouts.app')
@section('title', 'Class Schedule')
@section('css')
<link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection
@section('body')
<div class="card mb-3">
    <div class="card-body p-3">
        <table class="table align-middle text-nowrap mb-0" style="width: 100%;">
            <thead>
                <tr>
                    <th><strong>CLASS</strong></th>
                    <th><strong>TEACHER</strong></th>
                    <th><strong>STEP/TRAINNING</strong></th>
                    <th><strong>STARTED DATE</strong></th>
                    <th><strong>END DATA</strong></th>
                    <th><strong>STATUS</strong></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $class->name }}</td>
                    <td>{{ $class->teacher->name }}</td>
                    <td>
                        @if ($class->step_id == 1)
                        {{ __('message.steps.0.name') }}
                        @elseif($class->step_id == 2)
                        {{ __('message.steps.1.name') }}
                        @elseif($class->step_id == 3)
                        {{ __('message.trainings.0.name') }}
                        @elseif($class->step_id == 4)
                        {{ __('message.trainings.1.name') }}
                        @elseif($class->step_id == 5)
                        {{ __('message.trainings.2.name') }}
                        @else

                        @endif
                    </td>
                    <td>{{ explode(' - ', $class->period)[0] }} </td>
                    <td>{{ explode(' - ', $class->period)[1] }} </td>
                    <td>
                        @if ($class->status == 1)
                        <span class="mb-1 badge font-medium bg-light-info text-info">{{ __('message.callingStatus.0.name') }}</span>
                        @else
                        <span class="mb-1 badge font-medium bg-light-danger text-danger">{{ __('message.callingStatus.1.name') }}</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="product-list">
    <div class="card">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center mb-9">
                <h4 class="mb-0">Class Schedule</h4>

                <div class="btn-group">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Schedule">New Schedule
                    </button>
                    <div class="modal fade" id="Schedule" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content rounded-1">
                                <div class="modal-header d-flex align-items-center">
                                    <h4 class="modal-title" id="exampleModalLabel1">
                                        Class Schedule
                                    </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>

                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('localChurch.step.scheduleStore',$class->id) }}" method="post" onsubmit="disableSubmitButton()">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="message-text" class="control-label mb-2">Topic :</label>
                                            <input type="text" name="topic" class="form-control" id="message-text" placeholder="Topic" autocomplete="off"
                                                required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="message-text" class="control-label mb-2">Date :</label>
                                            <div class="input-group">
                                                <input name="date" type="text" class="form-control date" autocomplete="off"
                                                    required value="{{ old('date') }}" placeholder="mm/dd/yyyy" />

                                                <span class="input-group-text">
                                                    <i class="ti ti-calendar fs-5"></i>
                                                </span>
                                            </div>
                                        </div>
                                        {{-- desc --}}
                                        <div class="mb-3">
                                            <label for="message-text" class="control-label mb-2">Description :</label>
                                            <textarea name="description" class="form-control" id="message-text" cols="4" placeholder="Description"></textarea>
                                        </div>

                                        <div class="mb-3 text-center">
                                            <button type="submit" class="btn btn-primary" id="submitButton">Submit</button>
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
                        <th scope="col">Session </th>
                        <th scope="col">Topic </th>
                        <th scope="col">Date</th>
                        <th scope="col">Description</th>
                        <th scope="col">Created At</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schedules as $item)
                    <tr>
                        <td>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $item->topic }}</td>
                        <td>
                            {{ $item->date }}
                        </td>

                        <td>{{ $item->description }}</td>
                        <td>
                            {{ $item->created_at->format('d/m/Y') }}
                        </td>
                        <td class="text-center">
                            <button data-bs-toggle="modal" data-bs-target="#editModel{{ $item->id }}" class="btn btn-sm btn-primary"><i class="ti ti-pencil"></i> Edit</button>
                            <button data-bs-toggle="modal" data-bs-target="#deleteList{{ $item->id }}" class="btn btn-sm btn-danger"><i class="ti ti-trash"></i> Delete</button>

                            <div class="modal fade" id="deleteList{{ $item->id }}" tabindex="-1"
                                aria-labelledby="vertical-center-modal" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content modal-filled bg-light-danger">
                                        <div class="modal-body p-4">
                                            <form action="{{ route('localChurch.step.scheduleDestroy',$item->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <div class="text-center text-danger">
                                                    <i class="ti ti-hexagon-letter-x fs-7"></i>
                                                    <h4 class="mt-2">Are you sure to delete?</h4>
                                                    <p class="mt-3">
                                                        Delete Member will remove the member
                                                        on the list.
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
                        </td>
                        <div class="modal fade" id="editModel{{ $item->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content rounded-1">
                                    <div class="modal-header d-flex align-items-center">
                                        <h4 class="modal-title" id="exampleModalLabel1">
                                            Edit Class Schedule
                                        </h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>

                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('localChurch.step.scheduleUpdate',$class->id) }}" method="post" onsubmit="disableSubmitButton()">
                                            @csrf
                                            @method('PUT')

                                            <div class="mb-3">
                                                <label for="message-text" class="control-label mb-2">Topic :</label>
                                                <input type="text" name="topic" class="form-control" id="message-text" value="{{ $item->topic }}"
                                                    required />
                                            </div>
                                            <div class="mb-3">
                                                <label for="message-text" class="control-label mb-2">Date :</label>
                                                <div class="input-group">
                                                    <input name="date" type="text" class="form-control date" autocomplete="off"
                                                        required value="{{ $item->date }}" placeholder="mm/dd/yyyy" />

                                                    <span class="input-group-text">
                                                        <i class="ti ti-calendar fs-5"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            {{-- desc --}}
                                            <div class="mb-3">
                                                <label for="message-text" class="control-label mb-2">Description :</label>
                                                <textarea name="description" class="form-control" id="message-text" cols="4" placeholder="Description">{{ $item->description }}</textarea>
                                            </div>

                                            <div class="mb-3 text-center">
                                                <button type="submit" class="btn btn-primary" id="submitButton">Save</button>
                                            </div>

                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
<script src="{{ asset('dist/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script>
        jQuery(".date").datepicker({
        autoclose: true,
        todayHighlight: true,
        startDate: '0d',
    });

    $(function () {
        $("#datatable").DataTable();
    });

</script>
<script>
$(document).ready(function() {
        $('#penitent').on('click', function() {
            $.ajax({
        url: '{{ route("localChurch.penitentApi") }}',
        type: "GET",
        dataType: "json",
        success: function (data) {
            $('select[name="member"]').empty();
            $('select[name="member"]').append('<option value="">Select from penitent</option>');
            $.each(data, function (key, value) {
                $('select[name="member"]').append('<option value="' +
                    value.id + '">' + value.name + '</option>');
            });
        }
    });
    });
});
$(document).ready(function() {
    $('#teenager').on('click', function() {
        $.ajax({
        url: '{{ route("localChurch.teenagerApi") }}',
        type: "GET",
        dataType: "json",
        success: function (data) {
            $('select[name="member"]').empty();
            $('select[name="member"]').append('<option value="">Select from teenager</option>');
            $.each(data, function (key, value) {
                $('select[name="member"]').append('<option value="' +
                    value.id + '">' + value.name + '</option>');
            });
        }
    });
    });
});
$(document).ready(function() {
    $('#friend').on('click', function() {
        $.ajax({
        url: '{{ route("localChurch.friendApi") }}',
        type: "GET",
        dataType: "json",
        success: function (data) {
            $('select[name="member"]').empty();
            $('select[name="member"]').append('<option value="">Select from friends</option>');
            $.each(data, function (key, value) {
                $('select[name="member"]').append('<option value="' +
                    value.id + '">' + value.name + '</option>');
            });
        }
    });
    });
});
</script>
<script>
    $(document).ready(function(){
        $('#searchInput').on('keyup', function(){
            var searchTerm = $(this).val();

            if (searchTerm.length >= 3) {
                $.ajax({
                    url: "{{ route('localChurch.calling.search') }}",
                    method: 'GET',
                    data: { searchTerm: searchTerm },
                    dataType: 'json',
                    success: function(response){
                        var resultsList = $('#searchResults');
                        resultsList.empty();

                        if (response.length > 0) {
                            $.each(response, function(index, member){
                                resultsList.append(
                                    `<li id="active" class="p-1 mb-1 bg-hover-light-black">
                                        <a href="#" data-member-id="${member.id}" data-name="${member.name}" class="member-link">
                                            <span class="fs-3 text-black fw-normal d-block">${member.name}</span>
                                            <span class="fs-3 text-muted d-block">/${member.reg_no}/${member.email}</span>
                                        </a>
                                    </li>`
                                );
                            });
                        } else {
                            resultsList.append('<li class="p-1 mb-1 text-muted">No results found.</li>');
                        }
                    }
                });
            } else {
                $('#searchResults').empty();
            }
        });

         // Click event handler for member links
         $(document).on('click', '.member-link', function(e) {
            e.preventDefault();
             // Hide the search results
             $('#searchResults').hide();
             $('#message').hide();
             $('#searchInput').hide();
            var memberId = $(this).data('member-id');
            var name = $(this).data('name');

            // Display the member information in a div
            $('#memberInfoDiv').html(`
            <div class="mb-3">
                <label for="name" class="control-label mb-2">Name:</label>
                <input type="text" value="${name}" name="name" class="form-control" disabled id="name" />
                <input type="hidden" value="${memberId}" name="member_id" class="form-control" />
            </div>
            <div class="mb-3 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            `).show();
        });
    });
</script>
@endsection
