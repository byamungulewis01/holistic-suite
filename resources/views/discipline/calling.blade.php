@extends('layouts.app')
@section('title', 'Discipline')
@section('css')
<link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection
@section('body')
<div class="product-list">
    <div class="card">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center mb-9">
                <h4 class="mb-0">Discipline List</h4>

                <div class="btn-group">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New
                    </button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-md">
                            <div class="modal-content rounded-1">
                                <div class="modal-header d-flex align-items-center">
                                    <h4 class="modal-title" id="exampleModalLabel1">
                                        Assign Member to Discipline
                                    </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>

                                </div>
                                <div class="modal-body">
                                    <div class="border-bottom mb-3">
                                        <input type="search" class="form-control fs-3" autocomplete="off"
                                            placeholder="Search here" id="searchInput" />
                                    </div>
                                    <form action="{{ route('localChurch.discipline.storeCalling') }}" method="post">
                                        @csrf
                                        <div class="message-body" data-simplebar="">
                                            <div id="message" class="text-center mb-3" role="alert">
                                                Search for a member to assign to this Discipline....
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
                                                <input type="hidden" name="category_id" class="form-control" />
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="name" class="control-label mb-2">Post:</label>
                                                    <select name="category" disabled class="form-select" id="category" required>
                                                        @foreach(__('message.callings') as $i)
                                                        <option value="{{ $i['id'] }}">{{ $i['name'] }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="className" class="control-label mb-2">Punish
                                                        Duration</label>
                                                    <div class="input-group">
                                                        <input name="expireDate" type="text" class="form-control"
                                                            autocomplete="off" required readonly id="datepicker-autoclose"
                                                            value="{{ old('expireDate') }}" placeholder="mm/dd/yyyy" />
                                                        <span class="input-group-text">
                                                            <i class="ti ti-calendar fs-5"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="message-text" class="control-label mb-2">Reason:</label>
                                              <input autofocus autocomplete="off" class="form-control" name="reason" required placeholder="Reason">
                                            </div>
                                            <div class="mb-3">
                                                <label for="message-text" class="control-label mb-2">Description:</label>
                                                <textarea name="description" autocomplete="off" rows="3" class="form-control"></textarea>
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

            </div>
            <table id="datatable" class="table align-middle text-nowrap mb-0" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Names</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Category</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Expire Date</th>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->member->name }}</td>
                        <td>{{ (!$item->member->phone) ? 'No Mobile' : $item->member->phone }}</td>
                        <td>
                            @php
                            if ($item->member->gender == 1) { $gender = __('message.gender.0.name');}
                            else {$gender = __('message.gender.1.name'); }
                            @endphp
                            {{ $gender }}
                        </td>
                        <td>
                            @php
                            $attr = __('message.attribute');
                            @endphp
                            {{ $item->category->$attr }}</td>
                        <td>
                            {{ $item->reason }}
                        </td>
                        <td>
                            {{ $item->expireDate }}
                        </td>
                        <td>
                            <a href="">More</a>
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
<script src="{{ asset('dist/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    $(function () {
        $("#datatable").DataTable({scrollX: true,}); });
    jQuery("#datepicker-autoclose").datepicker({
        autoclose: true,
        todayHighlight: true,
        startDate: '0d',
    });
</script>
<script>
    $(document).ready(function () {
        $('#searchInput').on('keyup', function () {
            var searchTerm = $(this).val();

            if (searchTerm.length >= 3) {
                $.ajax({
                    url: "{{ route('localChurch.discipline.search') }}",
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
                                        <a href="#" data-member-id="${member.id}" data-name="${member.name}" data-category="${member.category}" class="member-link">
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
            var category = $(this).data('category');

            // Display the member information in a div
            $("input[name=name]").val(name)
            $("input[name=member_id]").val(memberId)
            $("select[name=category]").val(category)
            $("input[name=category_id]").val(category)
            $('#memberInfoDiv').show();
        });
    });

</script>
@endsection
