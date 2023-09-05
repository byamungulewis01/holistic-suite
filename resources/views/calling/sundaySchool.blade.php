@extends('layouts.app')
@section('title', 'Calling')
@section('css')
<link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection
@section('body')
<div class="product-list">
    <div class="card">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center mb-9">
                <h4 class="mb-0">Calling List</h4>

                <div class="btn-group">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New </button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-md">
                          <div class="modal-content rounded-1">
                            <div class="modal-header d-flex align-items-center">
                                <h4 class="modal-title" id="exampleModalLabel1">
                                    Assign Member to Calling
                                </h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>

                            </div>
                            <div class="modal-body">
                            <div class="border-bottom mb-3">
                                <input type="search" class="form-control fs-3" autocomplete="off" placeholder="Search here" id="searchInput" />
                            </div>
                            <form action="{{ route('localChurch.calling.sundaySchoolStore') }}" method="post">
                                @csrf
                                <div class="message-body" data-simplebar="">
                                    <div id="message" class="text-center mb-3" role="alert">
                                      Search for a member to assign to this Sunday school ....
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
            <table id="datatable" class="table align-middle text-nowrap mb-0" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Names</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Email</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($callings as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->member->name }}</td>
                        <td>{{ (!$item->member->phone) ? 'N/A' : $item->member->phone }}</td>
                        <td>{{ (!$item->member->email) ? 'N/A' : $item->member->email }}</td>
                        <td>
                            @php
                                if ($item->member->gender == 1) {
                                   $gender = __('message.gender.0.name');
                                } else {
                                    $gender = __('message.gender.1.name');
                                }
                            @endphp
                            {{ $gender }}
                        </td>
                        <td>
                            @if ($item->status == 1)
                            <span class="mb-1 badge font-medium bg-light-info text-info">{{ __('message.callingStatus.0.name') }}</span>
                            @else
                            <span class="mb-1 badge font-medium bg-light-danger text-danger">{{ __('message.callingStatus.1.name') }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('localChurch.member.show',$item->member->id) }}"
                                class="btn btn-sm btn-primary">Profile</a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#editModel{{ $item->id }}"
                                class="btn btn-sm btn-success">Edit</a>
                            <a data-bs-toggle="modal" data-bs-target="#deleteList{{ $item->id }}"
                                class="btn btn-sm btn-danger" href="#">Delete</a>

                            <div class="modal fade" id="deleteList{{ $item->id }}" tabindex="-1"
                                aria-labelledby="vertical-center-modal" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content modal-filled bg-light-danger">
                                        <div class="modal-body p-4">
                                            <form action="{{ route('localChurch.calling.sundaySchoolDestroy',$item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <div class="text-center text-danger">
                                                    <i class="ti ti-hexagon-letter-x fs-7"></i>
                                                    <h4 class="mt-2">Are you sure to delete?</h4>
                                                    <p class="mt-3">
                                                        Delete Calling will remove the member
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
                                <div class="modal-dialog modal-dialog-scrollable modal-sm">
                                  <div class="modal-content rounded-1">
                                    <div class="modal-header d-flex align-items-center">
                                        <h4 class="modal-title" id="exampleModalLabel1">
                                            Modify Calling
                                        </h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>

                                    </div>
                                    <div class="modal-body">
                                    <form action="{{ route('localChurch.calling.sundaySchoolUpdate',$item->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="status" class="control-label mb-2">Status:</label>
                                            <select class="form-select" name="status"
                                                style="width: 100%; height: 36px">
                                                @foreach(__('message.callingStatus') as $i)
                                                    <option {{ $item->status == $i['id'] ? 'selected' : '' }} value="{{ $i['id'] }}">
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
