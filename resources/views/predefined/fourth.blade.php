@extends('layouts.app')
@section('title', 'Pre Defined')
@section('css')
<link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection
@section('body')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-9">
                    <h5 class="mb-0">Other Religion </h5>
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#OtherReligion"
                        class="btn btn-primary btn-sm">Add New</a>
                    <div class="modal fade" id="OtherReligion" tabindex="-1" aria-labelledby="exampleModalLabel1">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content p-3">
                                <div class="modal-header d-flex align-items-center">
                                    <h4 class="modal-title" id="exampleModalLabel1">
                                        New Religion
                                    </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('predefined.storeReligion') }}" method="POST">
                                    <div class="modal-body">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="control-label mb-2">English:</label>
                                            <input type="text" name="english" class="form-control text-capitalize"
                                                value="{{ old('english') }}" autocomplete="off" autofocus="on"
                                                placeholder="Religion">
                                        </div>
                                        <div class="mb-0">
                                            <label for="name" class="control-label mb-2">Kinyarwanda:</label>
                                            <input type="text" name="kinyarwanda" class="form-control text-capitalize"
                                                value="{{ old('kinyarwanda') }}" autocomplete="off"
                                                placeholder="Religion">
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-danger text-danger font-medium"
                                            data-bs-dismiss="modal">
                                            Close
                                        </button>
                                        <button class="btn btn-success"> Submit </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal -->
                </div>
                <table class="table align-middle text-nowrap mb-0 datatable" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">English</th>
                            <th scope="col">Kinyarwanda</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($religions as $item)
                        <tr>
                            <td>
                                {{ $item->english }}
                            </td>
                            <td>
                                {{ $item->kinyarwanda }}
                            </td>

                            <td>
                                <div class="dropdown dropstart">
                                    <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="ti ti-dots-vertical fs-6"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                        <li>
                                            <a data-bs-toggle="modal" data-bs-target="#ReligionEdit{{ $item->id }}"
                                                class="dropdown-item d-flex align-items-center gap-3" href="#"><i
                                                    class="fs-4 ti ti-edit"></i>Edit</a>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="modal" data-bs-target="#deleteReligion{{ $item->id }}"
                                                class="dropdown-item d-flex align-items-center gap-3" href="#"><i
                                                    class="fs-4 ti ti-trash"></i>Delete</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="modal fade" id="deleteReligion{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="vertical-center-modal" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content modal-filled bg-light-danger">
                                            <div class="modal-body p-4">
                                                <form action="{{ route('predefined.destroyReligion',$item->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="text-center text-danger">
                                                        <i class="ti ti-hexagon-letter-x fs-7"></i>
                                                        <h4 class="mt-2">Are you sure to delete?</h4>
                                                        <p class="mt-3">
                                                            Delete category will permanently remove the category
                                                            from your list.
                                                        </p>
                                                        <button class="btn btn-light my-2">
                                                            Yes I'm sure
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                </div>
                                <div class="modal fade" id="ReligionEdit{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel1">
                                    <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content p-3">
                                            <div class="modal-header d-flex align-items-center">
                                                <h4 class="modal-title" id="exampleModalLabel1">
                                                    Edit Religion
                                                </h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('predefined.updateReligion',$item->id) }}"
                                                method="POST">
                                                <div class="modal-body">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="english" class="control-label mb-2">Name:</label>
                                                        <input type="text" name="english"
                                                            class="form-control text-capitalize"
                                                            value="{{ $item->english }}">
                                                    </div>
                                                    <div class="mb-0">
                                                        <label for="kinyarwanda"
                                                            class="control-label mb-2">Name:</label>
                                                        <input type="text" name="kinyarwanda"
                                                            class="form-control text-capitalize"
                                                            value="{{ $item->kinyarwanda }}">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button"
                                                        class="btn btn-light-danger text-danger font-medium"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button class="btn btn-success"> Save </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-9">
                    <h5 class="mb-0">Calling Categories </h5>
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#OtherCalling"
                        class="btn btn-primary btn-sm">Add New</a>
                    <div class="modal fade" id="OtherCalling" tabindex="-1" aria-labelledby="exampleModalLabel1">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content p-3">
                                <div class="modal-header d-flex align-items-center">
                                    <h4 class="modal-title" id="exampleModalLabel1">
                                        New Category
                                    </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('predefined.storeCalling') }}" method="POST">
                                    <div class="modal-body">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="control-label mb-2">English:</label>
                                            <input type="text" name="english" class="form-control text-capitalize"
                                                value="{{ old('english') }}" autocomplete="off" autofocus="on"
                                                placeholder="Calling">
                                        </div>
                                        <div class="mb-0">
                                            <label for="name" class="control-label mb-2">Kinyarwanda:</label>
                                            <input type="text" name="kinyarwanda" class="form-control text-capitalize"
                                                value="{{ old('kinyarwanda') }}" autocomplete="off"
                                                placeholder="Calling">
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-danger text-danger font-medium"
                                            data-bs-dismiss="modal">
                                            Close
                                        </button>
                                        <button class="btn btn-success"> Submit </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal -->
                </div>
                <table class="table align-middle text-nowrap mb-0 datatable" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">English</th>
                            <th scope="col">Kinyarwanda</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($callings as $item)
                        <tr>
                            <td>
                                {{ $item->english }}
                            </td>
                            <td>
                                {{ $item->kinyarwanda }}
                            </td>

                            <td>
                                <div class="dropdown dropstart">
                                    <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="ti ti-dots-vertical fs-6"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                        <li>
                                            <a data-bs-toggle="modal" data-bs-target="#CallingEdit{{ $item->id }}"
                                                class="dropdown-item d-flex align-items-center gap-3" href="#"><i
                                                    class="fs-4 ti ti-edit"></i>Edit</a>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="modal" data-bs-target="#deleteCalling{{ $item->id }}"
                                                class="dropdown-item d-flex align-items-center gap-3" href="#"><i
                                                    class="fs-4 ti ti-trash"></i>Delete</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="modal fade" id="deleteCalling{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="vertical-center-modal" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content modal-filled bg-light-danger">
                                            <div class="modal-body p-4">
                                                <form action="{{ route('predefined.destroyCalling',$item->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="text-center text-danger">
                                                        <i class="ti ti-hexagon-letter-x fs-7"></i>
                                                        <h4 class="mt-2">Are you sure to delete?</h4>
                                                        <p class="mt-3">
                                                            Delete category will permanently remove the category
                                                            from your list.
                                                        </p>
                                                        <button class="btn btn-light my-2">
                                                            Yes I'm sure
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                </div>
                                <div class="modal fade" id="CallingEdit{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel1">
                                    <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content p-3">
                                            <div class="modal-header d-flex align-items-center">
                                                <h4 class="modal-title" id="exampleModalLabel1">
                                                    Edit Calling
                                                </h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('predefined.updateCalling',$item->id) }}"
                                                method="POST">
                                                <div class="modal-body">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="english" class="control-label mb-2">Name:</label>
                                                        <input type="text" name="english"
                                                            class="form-control text-capitalize"
                                                            value="{{ $item->english }}">
                                                    </div>
                                                    <div class="mb-0">
                                                        <label for="kinyarwanda"
                                                            class="control-label mb-2">Name:</label>
                                                        <input type="text" name="kinyarwanda"
                                                            class="form-control text-capitalize"
                                                            value="{{ $item->kinyarwanda }}">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button"
                                                        class="btn btn-light-danger text-danger font-medium"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button class="btn btn-success"> Save </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-9">
                    <h5 class="mb-0">Member Step </h5>
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#OtherStep"
                        class="btn btn-primary btn-sm">Add New</a>
                    <div class="modal fade" id="OtherStep" tabindex="-1" aria-labelledby="exampleModalLabel1">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content p-3">
                                <div class="modal-header d-flex align-items-center">
                                    <h4 class="modal-title" id="exampleModalLabel1">
                                        New Step
                                    </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('predefined.storeStep') }}" method="POST">
                                    <div class="modal-body">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="control-label mb-2">English:</label>
                                            <input type="text" name="english" class="form-control text-capitalize"
                                                value="{{ old('english') }}" autocomplete="off" autofocus="on"
                                                placeholder="Member Step">
                                        </div>
                                        <div class="mb-0">
                                            <label for="name" class="control-label mb-2">Kinyarwanda:</label>
                                            <input type="text" name="kinyarwanda" class="form-control text-capitalize"
                                                value="{{ old('kinyarwanda') }}" autocomplete="off"
                                                placeholder="Member Step">
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-danger text-danger font-medium"
                                            data-bs-dismiss="modal">
                                            Close
                                        </button>
                                        <button class="btn btn-success"> Submit </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal -->
                </div>
                <table class="table align-middle text-nowrap mb-0 datatable" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">English</th>
                            <th scope="col">Kinyarwanda</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($steps as $item)
                        <tr>
                            <td>
                                {{ $item->english }}
                            </td>
                            <td>
                                {{ $item->kinyarwanda }}
                            </td>

                            <td>
                                <div class="dropdown dropstart">
                                    <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="ti ti-dots-vertical fs-6"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                        <li>
                                            <a data-bs-toggle="modal" data-bs-target="#StepEdit{{ $item->id }}"
                                                class="dropdown-item d-flex align-items-center gap-3" href="#"><i
                                                    class="fs-4 ti ti-edit"></i>Edit</a>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="modal" data-bs-target="#deleteStep{{ $item->id }}"
                                                class="dropdown-item d-flex align-items-center gap-3" href="#"><i
                                                    class="fs-4 ti ti-trash"></i>Delete</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="modal fade" id="deleteStep{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="vertical-center-modal" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content modal-filled bg-light-danger">
                                            <div class="modal-body p-4">
                                                <form action="{{ route('predefined.destroyStep',$item->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="text-center text-danger">
                                                        <i class="ti ti-hexagon-letter-x fs-7"></i>
                                                        <h4 class="mt-2">Are you sure to delete?</h4>
                                                        <p class="mt-3">
                                                            Delete Step will permanently remove the category
                                                            from your list.
                                                        </p>
                                                        <button class="btn btn-light my-2">
                                                            Yes I'm sure
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                </div>
                                <div class="modal fade" id="StepEdit{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel1">
                                    <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content p-3">
                                            <div class="modal-header d-flex align-items-center">
                                                <h4 class="modal-title" id="exampleModalLabel1">
                                                    Edit Step
                                                </h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('predefined.updateStep',$item->id) }}"
                                                method="POST">
                                                <div class="modal-body">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="english" class="control-label mb-2">Name:</label>
                                                        <input type="text" name="english"
                                                            class="form-control text-capitalize"
                                                            value="{{ $item->english }}">
                                                    </div>
                                                    <div class="mb-0">
                                                        <label for="kinyarwanda"
                                                            class="control-label mb-2">Name:</label>
                                                        <input type="text" name="kinyarwanda"
                                                            class="form-control text-capitalize"
                                                            value="{{ $item->kinyarwanda }}">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button"
                                                        class="btn btn-light-danger text-danger font-medium"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button class="btn btn-success"> Save </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-9">
                    <h5 class="mb-0">Commissions </h5>
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#Commissions"
                        class="btn btn-primary btn-sm">Add New</a>
                    <div class="modal fade" id="Commissions" tabindex="-1" aria-labelledby="exampleModalLabel1">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content p-3">
                                <div class="modal-header d-flex align-items-center">
                                    <h4 class="modal-title" id="exampleModalLabel1">
                                        New Commission
                                    </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('predefined.storeCommission') }}" method="POST">
                                    <div class="modal-body">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="control-label mb-2">English:</label>
                                            <input type="text" name="english" class="form-control text-capitalize"
                                                value="{{ old('english') }}" autocomplete="off" autofocus="on"
                                                placeholder="Commission">
                                        </div>
                                        <div class="mb-0">
                                            <label for="name" class="control-label mb-2">Kinyarwanda:</label>
                                            <input type="text" name="kinyarwanda" class="form-control text-capitalize"
                                                value="{{ old('kinyarwanda') }}" autocomplete="off"
                                                placeholder="Commission">
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-danger text-danger font-medium"
                                            data-bs-dismiss="modal">
                                            Close
                                        </button>
                                        <button class="btn btn-success"> Submit </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal -->
                </div>
                <table class="table align-middle text-nowrap mb-0 datatable" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">English</th>
                            <th scope="col">Kinyarwanda</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($commissions as $item)
                        <tr>
                            <td>
                                {{ $item->english }}
                            </td>
                            <td>
                                {{ $item->kinyarwanda }}
                            </td>

                            <td>
                                <div class="dropdown dropstart">
                                    <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="ti ti-dots-vertical fs-6"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                        <li>
                                            <a data-bs-toggle="modal" data-bs-target="#CommissionEdit{{ $item->id }}"
                                                class="dropdown-item d-flex align-items-center gap-3" href="#"><i
                                                    class="fs-4 ti ti-edit"></i>Edit</a>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="modal" data-bs-target="#deleteCommission{{ $item->id }}"
                                                class="dropdown-item d-flex align-items-center gap-3" href="#"><i
                                                    class="fs-4 ti ti-trash"></i>Delete</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="modal fade" id="deleteCommission{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="vertical-center-modal" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content modal-filled bg-light-danger">
                                            <div class="modal-body p-4">
                                                <form action="{{ route('predefined.destroyCommission',$item->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="text-center text-danger">
                                                        <i class="ti ti-hexagon-letter-x fs-7"></i>
                                                        <h4 class="mt-2">Are you sure to delete?</h4>
                                                        <p class="mt-3">
                                                            Delete Commission will permanently remove the category
                                                            from your list.
                                                        </p>
                                                        <button class="btn btn-light my-2">
                                                            Yes I'm sure
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                </div>
                                <div class="modal fade" id="CommissionEdit{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel1">
                                    <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content p-3">
                                            <div class="modal-header d-flex align-items-center">
                                                <h4 class="modal-title" id="exampleModalLabel1">
                                                    Edit Commission
                                                </h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('predefined.updateCommission',$item->id) }}"
                                                method="POST">
                                                <div class="modal-body">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="english" class="control-label mb-2">Name:</label>
                                                        <input type="text" name="english"
                                                            class="form-control text-capitalize"
                                                            value="{{ $item->english }}">
                                                    </div>
                                                    <div class="mb-0">
                                                        <label for="kinyarwanda"
                                                            class="control-label mb-2">Name:</label>
                                                        <input type="text" name="kinyarwanda"
                                                            class="form-control text-capitalize"
                                                            value="{{ $item->kinyarwanda }}">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button"
                                                        class="btn btn-light-danger text-danger font-medium"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button class="btn btn-success"> Save </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal -->
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
<script>
    $(function () {
        $(".datatable").DataTable({
            scrollX: true,
            lengthMenu: [5, 10, 25, 50], // Define available page lengths
            pageLength: 5, // Set default page length to 5
        });
    });

</script>
@endsection
