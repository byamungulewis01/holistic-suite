@extends('layouts.app')
@section('title', 'Profile')
@section('css')
<link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection
@section('body')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-5">
            <div class="card shadow-none border">
                <div class="card-body">
                    <h4 class="fw-semibold mb-3 text-info">Introduction</h4>
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex align-items-center gap-3 mb-4">
                            <strong>NAMES:</strong>
                            <h6 class="fs-4 mb-0">{{ $child->name }}</h6>
                        </li>
                        <li class="d-flex align-items-center gap-3 mb-4">
                            <strong>PHONE:</strong>
                            <h6 class="fs-4 mb-0">{{ $child->parentPhone }}</h6>
                        </li>
                        <li class="d-flex align-items-center gap-3 mb-4">
                            <strong>DOB:</strong>
                            <h6 class="fs-4 mb-0">{{ $child->dateOfBirth }}</h6>
                        </li>
                        <li class="d-flex align-items-center gap-3 mb-4">
                            <strong>GENDER:</strong>
                            <h6 class="fs-4 mb-0">@if ($child->gender == 1) {{ __('message.gender.0.name') }}
                                @else {{ __('message.gender.1.name') }} @endif</h6>
                        </li>
                        <li class="d-flex align-items-center gap-3 mb-4">
                            <strong>FATHER NAME:</strong>
                            <h6 class="fs-4 mb-0">{{ $child->fatherName }}</h6>
                        </li>
                        <li class="d-flex align-items-center gap-3 mb-4">
                            <strong>MOTHER NAME:</strong>
                            <h6 class="fs-4 mb-0">{{ $child->motherName }}</h6>
                        </li>
                        <li class="d-flex align-items-center gap-3 mb-4">
                            <strong>PARENT PHONE:</strong>
                            <h6 class="fs-4 mb-0">{{ $child->parentPhone }}</h6>
                        </li>
                        <li class="d-flex align-items-center gap-3 mb-2">
                            <strong>HOME:</strong>
                            <h6 class="fs-4 mb-0">{{ $child->sector }}, {{ $child->cell }} , {{ $child->village }}</h6>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card w-100 mb-3">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-3">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Sunday School</h5>
                            <p class="card-subtitle">Sunday School in Church</p>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle text-nowrap mb-0">
                            <thead>
                                <tr class="text-muted fw-semibold">
                                    <th scope="col" class="ps-0">Class</th>
                                    <th scope="col">Teacher Name</th>
                                    <th scope="col">Join Date</th>
                                </tr>
                            </thead>
                            <tbody class="border-top">
                                @if ($school)
                                <tr>
                                    <td class="ps-0">
                                        <span class="badge fw-semibold py-1 w-85 bg-light-success text-success">{{ $school->school->classIndex }}{{ $school->school->class }} </span>
                                    </td>
                                    <td>
                                        <p class="mb-0 fs-3 text-dark">{{ $school->school->teacher->name }}  </p>
                                    </td>
                                    <td>{{ $school->created_at->format('d/m/Y') }}
                                    </td>

                                </tr>
                                @else
                                <tr>
                                    <td colspan="3" class="text-center">
                                        <p class="mb-0 fs-3 text-dark">Not Registered</p>
                                    </td>
                                </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card w-100 mb-3">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-3">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Family Members </h5>
                            <p class="card-subtitle">Family Member in Church</p>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle text-nowrap mb-0">
                            <thead>
                                <tr class="text-muted fw-semibold">
                                    <th scope="col" class="ps-0">Names</th>
                                    <th scope="col">Reg Number</th>
                                    <th scope="col">Relation</th>
                                </tr>
                            </thead>
                            <tbody class="border-top">
                                @forelse ($familyMembers as $item)
                                <tr>
                                    <td class="ps-0">
                                        <h6 class="fw-semibold mb-1">{{ ($item->member_id == NULL) ? $item->child->name : $item->member->name }}</h6>

                                    </td>
                                    <td>
                                        <p class="mb-0 fs-3 text-dark">{{ ($item->member_id == NULL) ? 'N/A': $item->member->reg_no }}</p>
                                    </td>
                                    <td>
                                        @if ($item->relation == 'head')
                                        <span class="badge fw-semibold py-1 w-85 bg-light-danger text-danger">{{ __('church/member.head') }}</span>
                                        @elseif($item->relation == 'spouse')
                                        <span class="badge fw-semibold py-1 w-85 bg-light-warning text-warning">{{ __('church/member.spouse') }}</span>
                                        @elseif($item->relation == 'child')
                                        <span class="badge fw-semibold py-1 w-85 bg-light-primary text-primary">{{ __('church/member.child') }}</span>
                                        @else
                                        <span class="badge fw-semibold py-1 w-85 bg-light-info text-info">{{ __('church/member.familyOther') }}</span>
                                        @endif
                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="d-flex justify-content-center">
                                        <p class="mb-0 fs-3 text-dark">Not Registered &nbsp;&nbsp;&nbsp;&nbsp;
                                             <a href="" data-bs-toggle="modal" data-bs-target="#joinFamily">Join Family</a>
                                        </p>
                                        <div class="modal fade" id="joinFamily" tabindex="-1" aria-hidden="true">
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
                                                    <input type="search" class="form-control fs-3" placeholder="Search here" id="searchInput" autocomplete="off" />
                                                </div>
                                                <form action="{{ route('localChurch.childProfile.assignMember',$child->id) }}" method="post">
                                                    @csrf
                                                    <div class="message-body" data-simplebar="">
                                                        <div id="message" class="text-center mb-3" role="alert">
                                                          Search for a member to assign to this Family ....
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
                                    </td>
                                </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
                               if(member.relation != 1){
                                  return true;
                                }else{
                                    resultsList.append(
                                        `<li id="active" class="p-1 mb-1 bg-hover-light-black">
                                            <a href="#" data-member-id="${member.id}" data-name="${member.name}" class="member-link">
                                                <span class="fs-3 text-black fw-normal d-block">${member.name}</span>
                                                <span class="fs-3 text-muted d-block">/${member.reg_no}/${member.email}</span>
                                            </a>
                                        </li>`
                                    );
                                }

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
                <button type="submit" class="btn btn-primary">Join Family</button>
            </div>
            `).show();
        });
    });
</script>
@endsection
