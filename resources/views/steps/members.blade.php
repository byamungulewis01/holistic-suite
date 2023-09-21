@extends('layouts.app')
@section('title', 'All Members')
@section('css')
<link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
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
                        <span class="mb-1 badge font-medium bg-light-info text-info">{{
                            __('message.callingStatus.0.name') }}</span>
                        @else
                        <span class="mb-1 badge font-medium bg-light-danger text-danger">{{
                            __('message.callingStatus.1.name') }}</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="product-list">
    <div class="card">
        @if ($class->step_id == 2)
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center mb-9">
                <h4 class="mb-0">Marriage Project</h4>
            </div>
            <table class="table align-middle text-nowrap mb-0" style="width: 100%;">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Boy Names</th>
                        <th scope="col">Boy Phone</th>
                        <th scope="col">Girl Names</th>
                        <th scope="col">Girl Phone</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if ($item->wedding->churchMember == 'girl')
                            {{ $item->wedding->boy_name }}
                            @else
                            {{ $item->wedding->boy_member->name }}
                            @endif
                        </td>
                        <td>
                            @if ($item->wedding->churchMember == 'girl')
                            {{ $item->wedding->boy_phone }}
                            @else
                            {{ $item->wedding->boy_member->phone }}
                            @endif
                        </td>
                        <td>
                            @if ($item->wedding->churchMember == 'boy')
                            {{ $item->wedding->girl_name }}
                            @else
                            {{ $item->wedding->girl_member->name }}
                            @endif
                        </td>
                        <td>
                            @if ($item->wedding->churchMember == 'boy')
                            {{ $item->wedding->girl_phone }}
                            @else
                            {{ $item->wedding->girl_member->phone }}
                            @endif
                        </td>
                        <td><button data-bs-toggle="modal" data-bs-target="#complete{{ $item->id }}"
                                class="btn btn-sm btn-success">Completion</button></td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center mb-9">
                <h4 class="mb-0">Class Members List</h4>

                <div class="btn-group">
                    @unless ($class->step_id != 1)
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newBeliver">New Believe
                    </button>
                    @else
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Assign Member
                    </button>
                    @endunless
                    <div class="modal fade" id="newBeliver" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content rounded-1">
                                <div class="modal-header d-flex align-items-center">
                                    <h4 class="modal-title" id="exampleModalLabel1">
                                        New Believers
                                    </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>

                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('localChurch.step.newBeliever',$class->id) }}" method="post">
                                        @csrf

                                        <div class="mb-3 text-center">
                                            <div class="btn-group" data-bs-toggle="buttons">
                                                <label class="btn btn-light-primary text-primary font-medium active">
                                                    <div class="form-check">
                                                        <input type="radio" id="penitent" name="member_type"
                                                            value="penitent" class="form-check-input">
                                                        <label class="form-check-label" for="penitent"><span
                                                                class="d-block d-md-none">1</span><span
                                                                class="d-none d-md-block">Penitent</span></label>
                                                    </div>
                                                </label>
                                                <label class="btn btn-light-primary text-primary font-medium">
                                                    <div class="form-check">
                                                        <input type="radio" id="teenager" name="member_type"
                                                            value="teenager" class="form-check-input">
                                                        <label class="form-check-label" for="teenager"><span
                                                                class="d-block d-md-none">2</span><span
                                                                class="d-none d-md-block">Teenager</span></label>
                                                    </div>
                                                </label>
                                                <label class="btn btn-light-primary text-primary font-medium">
                                                    <div class="form-check">
                                                        <input type="radio" id="friend" name="member_type"
                                                            value="friend" class="form-check-input">
                                                        <label class="form-check-label" for="friend"><span
                                                                class="d-block d-md-none">3</span><span
                                                                class="d-none d-md-block">Freind</span></label>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="message-text" class="control-label mb-2">Member :</label>
                                            <select class="form-select" name="member" style="width: 100%; height: 36px">

                                            </select>

                                        </div>

                                        <div class="mb-3 text-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>

                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-md">
                            <div class="modal-content rounded-1">
                                <div class="modal-header d-flex align-items-center">
                                    <h4 class="modal-title" id="exampleModalLabel1">
                                        Assign Member to Class
                                    </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>

                                </div>
                                <div class="modal-body">
                                    <div class="border-bottom mb-3">
                                        <input type="search" class="form-control fs-3" placeholder="Search here"
                                            id="searchInput" autocomplete="off" />
                                    </div>
                                    <form action="{{ route('localChurch.step.newMember',$class->id) }}" method="post">
                                        @csrf
                                        <div class="message-body" data-simplebar="">
                                            <div id="message" class="text-center mb-3" role="alert">
                                                Search for a member to assign to this class....
                                            </div>
                                            <ul id="searchResults" class="list mb-0 py-2">
                                            </ul>
                                        </div>
                                        <div id="memberInfoDiv" style="display: none;"></div>
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
                        <th scope="col">Names </th>
                        <th scope="col">Mobile </th>
                        <th scope="col">Joining Date</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>@if ($item->type == 'baptism')
                            {{ ($item->from == 1) ? $item->penitent->name : ($item->from == 2 ? $item->teenager->name :
                            $item->friend->name) }}
                            @else
                            {{ $item->member->name }}
                            @endif
                        </td>
                        <td>
                            @if ($item->type == 'baptism')
                            {{ ($item->from == 1) ? $item->penitent->phone : ($item->from == 2 ? $item->teenager->phone
                            : $item->friend->phone) }}
                            @else
                            {{ $item->member->phone }}
                            @endif
                        </td>

                        <td>{{ $item->created_at->format('Y-m-d') }}</td>
                        <td>
                            @if ($item->type == 'baptism')
                            @if ($item->status == 1)
                            <span class="mb-1 badge font-medium bg-light-info text-info">New Biliever</span>
                            @else
                            <span class="mb-1 badge font-medium bg-light-success text-success">Completed</span>
                            @endif
                            @else
                            @if ($item->status == 1)
                            <span class="mb-1 badge font-medium bg-light-info text-info">{{
                                __('message.callingStatus.0.name') }}</span>
                            @else
                            <span class="mb-1 badge font-medium bg-light-danger text-danger">{{
                                __('message.callingStatus.1.name') }}</span>
                            @endif
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($item->type == 'baptism')
                            <button data-bs-toggle="modal" data-bs-target="#deleteList{{ $item->id }}"
                                class="btn btn-sm btn-danger">Delete</button>
                            <button data-bs-toggle="modal" data-bs-target="#complete{{ $item->id }}"
                                class="btn btn-sm btn-success">Completion</button>
                            @else
                            <button data-bs-toggle="modal" data-bs-target="#deleteMember{{ $item->id }}"
                                class="btn btn-sm btn-danger"><i class="ti ti-trash"></i> Delete</button>
                            @endif


                            <div class="modal fade" id="complete{{ $item->id }}" tabindex="-1"
                                aria-labelledby="vertical-center-modal" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content modal-filled bg-light-success">
                                        <div class="modal-body p-4">
                                            <form action="{{ route('localChurch.step.completion',$item->id) }}"
                                                method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="text-center text-dark">
                                                    <h4 class="mt-2">Completion Baptism Class</h4>
                                                    <p class="mt-3">
                                                        <strong>Dear Pastor are you sure Inshuti is completed Baptism
                                                            class ?</strong>
                                                    </p>
                                                    <button class="btn btn-success my-2">
                                                        Yes I'm sure
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="deleteList{{ $item->id }}" tabindex="-1"
                                aria-labelledby="vertical-center-modal" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content modal-filled bg-light-danger">
                                        <div class="modal-body p-4">
                                            <form action="{{ route('localChurch.step.destroyBeliever',$item->id) }}"
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
                            <div class="modal fade" id="deleteMember{{ $item->id }}" tabindex="-1"
                                aria-labelledby="vertical-center-modal" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content modal-filled bg-light-danger">
                                        <div class="modal-body p-4">
                                            <form action="{{ route('localChurch.step.destroyMember',$item->id) }}"
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
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
