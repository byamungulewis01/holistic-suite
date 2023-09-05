@extends('layouts.app')
@section('title', 'Group Members')
@section('css')
<link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/libs/daterangepicker/daterangepicker.css') }}">
@endsection
@section('body')
<div class="card mb-3">
    <div class="card-body p-3">
        <table class="table align-middle text-nowrap mb-0" style="width: 100%;">
            <thead>
                <tr>
                    <th scope="col"><strong>C CODE</strong> </th>
                    <th scope="col"><strong>COMMISSIOM </strong></th>
                    <th scope="col"><strong>DATE</strong></th>
                    <th scope="col"><strong>STATUS</strong></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $commission->code }}</td>
                    <td>
                        @php $attr = __('message.attribute'); @endphp
                        {{ $commission->commission->$attr }}
                    </td>
                    <td>{{ \Carbon\Carbon::parse($commission->created_at)->format('d -m - Y') }}</td>
                    <td>
                        @if ($commission->status == 1)
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
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-9">
                    <h4 class="mb-0">Commission Members</h4>

                    <div class="btn-group">
                        <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#groupMember"><i
                                class="ti ti-search"></i> Member
                        </button>
                        <div class="modal fade" id="groupMember" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-md">
                                <div class="modal-content rounded-1">
                                    <div class="modal-header d-flex align-items-center">
                                        <h4 class="modal-title" id="exampleModalLabel1">
                                            Assign Member to Commission
                                        </h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>

                                    </div>
                                    <div class="modal-body">
                                        <div class="border-bottom mb-3">
                                            <input type="search" class="form-control fs-3" placeholder="Search here"
                                                id="searchInput" autocomplete="off" />
                                        </div>
                                        <form action="{{ route('localChurch.commission.StoreMember',$commission->id) }}"
                                            method="post">
                                            @csrf



                                            <div class="message-body" data-simplebar="">
                                                <div id="message" class="text-center mb-3" role="alert">
                                                    Search for a member to assign to this class....
                                                </div>
                                                <ul id="searchResults" class="list mb-0 py-2">
                                                </ul>
                                            </div>
                                            <div id="memberInfoDiv" style="display: none;">
                                                {{-- member information div --}}
                                                <div class="mb-3">
                                                    <label for="name" class="control-label mb-2">Name:</label>
                                                    <input type="text" name="name" class="form-control" disabled
                                                        id="name" />
                                                    <input type="hidden" name="member_id" class="form-control" />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="className" class="control-label mb-2">Starting - Ending
                                                        Date:</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" name="period" class="form-control"
                                                            id="daterange777" />
                                                        <span class="input-group-text">
                                                            <i class="ti ti-calendar fs-5"></i>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="name" class="control-label mb-2">Post:</label>
                                                    <select name="post" class="form-control" id="post" required>
                                                        <option disabled selected value="">Select Post</option>
                                                        @foreach(__('message.leadersPost') as $i)
                                                        <option {{ old('post')==$i['id'] ? 'selected' : '' }}
                                                            value="{{ $i['id'] }}">
                                                            {{ $i['name'] }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3 text-center">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <table class="datatable table align-middle text-nowrap mb-0" style="width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Names </th>
                            <th scope="col">Mobile </th>
                            <th scope="col">Post </th>
                            <th scope="col">Start </th>
                            <th scope="col">End </th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->member->name }}</td>
                            <td>{{ $item->member->phone }}</td>
                            <td>@if ($item->post == 1)
                                {{ __('message.leadersPost.0.name') }}
                                @elseif ($item->post == 2)
                                {{ __('message.leadersPost.1.name') }}
                                @elseif ($item->post == 3)
                                {{ __('message.leadersPost.2.name') }}
                                @endif</td>
                            <td>{{ explode(' - ', $item->period)[0] }} </td>
                            <td>{{ explode(' - ', $item->period)[1] }} </td>
                            <td class="d-flex justify-content-center gap-1">
                                <a href="{{ route('localChurch.member.show',$item->member->id) }}"
                                    class="btn btn-sm btn-primary" title="Profile"><i class="ti ti-user"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#editModel{{ $item->id }}"
                                    class="btn btn-sm btn-success" title="Edit"><i class="ti ti-pencil"></i></button>
                                <button data-bs-toggle="modal" data-bs-target="#deleteList{{ $item->id }}"
                                    class="btn btn-sm btn-danger" title="Delete"><i class="ti ti-trash"></i></button>
                                <div class="modal fade" id="deleteList{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="vertical-center-modal" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content modal-filled bg-light-danger">
                                            <div class="modal-body p-4">
                                                <form
                                                    action="{{ route('localChurch.commission.destroyMember',$item->id) }}"
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

                                <div class="modal fade" id="editModel{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-md">
                                        <div class="modal-content rounded-1">
                                            <div class="modal-header d-flex align-items-center">
                                                <h4 class="modal-title" id="exampleModalLabel1">
                                                    Edit Member
                                                </h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <form
                                                    action="{{ route('localChurch.commission.editMember',$item->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="mb-3">
                                                        <input type="hidden" name="member_id" value="{{ $item->member_id }}">
                                                        <input type="hidden" name="commission_id" value="{{ $item->commission_id }}">
                                                        <label for="className" class="control-label mb-2">Starting - Ending Date:</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="period" class="form-control"
                                                                value="{{ $item->period }}" />
                                                            <span class="input-group-text">
                                                                <i class="ti ti-calendar fs-5"></i>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="name" class="control-label mb-2">Post:</label>
                                                        <select name="post" class="form-control" id="post" required>
                                                            <option disabled selected value="">Select Post</option>
                                                            @foreach(__('message.leadersPost') as $i)
                                                            <option {{ $item->post == $i['id'] ? 'selected' : '' }}
                                                                value="{{ $i['id'] }}">
                                                                {{ $i['name'] }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-3 text-center">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>

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
</div>

@endsection
@section('script')

<!-- ---------------------------------------------- -->
<script src="{{ asset('dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dist/libs/datatables.net/js/dataTables.bootstrap5.min.js') }}"></script>

<script src="{{ asset('dist/libs/bootstrap-material-datetimepicker/node_modules/moment/moment.js') }}"></script>
<script src="{{ asset('dist/libs/daterangepicker/daterangepicker.js') }}"></script>
<script>
    $(function () {
        $(".datatable").DataTable({
            scrollX: true,
        });
    });

</script>

<script>
    $(document).ready(function () {
        $('#searchInput').on('keyup', function () {
            var searchTerm = $(this).val();

            if (searchTerm.length >= 3) {
                $.ajax({
                    url: "{{ route('localChurch.calling.search') }}",
                    method: 'GET',
                    data: {
                        searchTerm: searchTerm
                    },
                    dataType: 'json',
                    success: function (response) {
                        var resultsList = $('#searchResults');
                        resultsList.empty();

                        if (response.length > 0) {
                            $.each(response, function (index, member) {
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
                            resultsList.append(
                                '<li class="p-1 mb-1 text-muted">No results found.</li>'
                                );
                        }
                    }
                });
            } else {
                $('#searchResults').empty();
            }
        });
        // Click event handler for member links
        $(document).on('click', '.member-link', function (e) {
            e.preventDefault();
            // Hide the search results
            $('#searchResults').hide();
            $('#message').hide();
            $('#searchInput').hide();
            var memberId = $(this).data('member-id');
            var name = $(this).data('name');

            // Display the member information in a div
            $("input[name=name]").val(name)
            $("input[name=member_id]").val(memberId)
            $('#memberInfoDiv').show();
        });
    });

</script>

<script>
    $(document).ready(() => {
        $("input[name=period]").daterangepicker({
            opens: "left",
            drops: "down"
        });
    });

</script>

@endsection
