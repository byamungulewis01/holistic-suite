@extends('layouts.app')
@section('title', 'Group Members')
@section('css')
<link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
<style>

.select2-dropdown {
    z-index: 1100; /* Make sure this value is higher than the modal's z-index */
}
.select2-dropdown {
    position: absolute; /* or position: fixed; */
}
.modal-parent {
    position: relative; /* or position: absolute; or position: fixed; */
}

.select2-parent {
    position: relative; /* or position: absolute; or position: fixed; */
}

</style>
@endsection
@section('body')
<div class="card mb-3">
    <div class="card-body p-3">
        <table class="table align-middle text-nowrap mb-0" style="width: 100%;">
            <thead>
                <tr>
                    <th scope="col"><strong>CLASS : </strong> <span
                            class="text-danger">{{ $school->classIndex }}{{ $school->class }}</span></th>
                    <th scope="col"><strong>TEACHER :</strong> {{ $school->teacher->name }} </th>
                    <th scope="col"><strong>DATE :</strong> {{ $school->created_at->format('d/m/Y') }} </th>
                    <th scope="col"><strong>STATUS :</strong> @if ($school->status == 1)
                        <span
                            class="mb-1 badge font-medium bg-light-info text-info">{{ __('message.callingStatus.0.name') }}</span>
                        @else
                        <span
                            class="mb-1 badge font-medium bg-light-danger text-danger">{{ __('message.callingStatus.1.name') }}</span>
                        @endif </th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">Children List</h4>

                    <div class="btn-group gap-2">
                        <a href="{{ route('localChurch.sundaySchool.addChild',$school->id) }}" class="btn btn-light"><i
                                class="ti ti-plus"></i> Child
                        </a>
                        <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addChidren"><i
                                class="ti ti-search"></i> Assign
                        </button>
                    </div>

                </div>
                <table class="datatable table align-middle text-nowrap mb-0" style="width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Names </th>
                            <th scope="col">DOB </th>
                            <th scope="col">Gender </th>
                            <th scope="col">Mother </th>
                            <th scope="col">Father </th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->child->name }}</td>
                            <td>{{ $item->child->dateOfBirth }}</td>
                            <td>@if ($item->child->gender == 1)
                                {{ __('message.gender.0.name') }}
                                @else {{ __('message.gender.1.name') }}
                                 @endif</td>
                            <td>{{ $item->child->motherName }}</td>
                            <td>{{ $item->child->fatherName }}</td>

                            <td class="d-flex justify-content-center gap-1">
                                {{-- profile --}}
                                <a href="{{ route('localChurch.children.show',$item->child_id) }}" class="btn btn-sm btn-primary" title="Profile"><i class="ti ti-user"></i></a>
                                {{-- changeLevel --}}
                                <button data-bs-toggle="modal" data-bs-target="#changeLevel{{ $item->id }}"
                                    class="btn btn-sm btn-light-primary" title="Change Level"><i class="ti ti-reload"></i></button>
                                <button data-bs-toggle="modal" data-bs-target="#deleteList{{ $item->id }}"
                                    class="btn btn-sm btn-danger" title="Delete"><i class="ti ti-trash"></i></button>
                                    <div class="modal fade" id="changeLevel{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-md">
                                            <div class="modal-content rounded-1">
                                                <div class="modal-header d-flex align-items-center">
                                                    <h4 class="modal-title" id="exampleModalLabel1">
                                                        Change Children Level
                                                    </h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <form
                                                        action="{{ route('localChurch.sundaySchool.changeLevel',$item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="level" class="control-label mb-2">Levels:</label>
                                                            <select name="level" class="form-select" id="level" required>
                                                                <option disabled selected value="">Select Level</option>
                                                                @foreach($schools as $level)
                                                                <option value="{{ $level->id }}">
                                                                    {{ $level->classIndex }}{{ $level->class }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="mb-3 text-center">
                                                            <button type="submit" class="btn btn-primary">Change</button>
                                                        </div>

                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <div class="modal fade" id="deleteList{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="vertical-center-modal" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content modal-filled bg-light-danger">
                                            <div class="modal-body p-4">
                                                <form
                                                    action="{{ route('localChurch.sundaySchool.destroyMember',$item->id) }}"
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
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addChidren" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Sunday School
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <form action="{{ route('localChurch.sundaySchool.members',$school->id) }}" method="post">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label for="children" class="form-label"> Children </label>
                    <select name="children[]" id="children" class="select2 form-select" multiple="multiple"
                        style="height: 36px; width: 100%" data-placeholder="Select ">
                        @foreach ($childrens as $item)
                        <option value="{{ $item->id }}"> {{ $item->name }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-light-primary font-medium waves-effect text-start">Save
                    changes</button>
                <button type="button" class="btn btn-light-danger text-danger font-medium waves-effect text-start"
                    data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- Button trigger modal -->


@endsection
@section('script')

<!-- ---------------------------------------------- -->
<script src="{{ asset('dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dist/libs/datatables.net/js/dataTables.bootstrap5.min.js') }}"></script>
<script>
    $(function () {
        $(".datatable").DataTable({
            scrollX: true,
        });
    });

</script>

@endsection
