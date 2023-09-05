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
                    <h5 class="mb-0">Marital Status</h5>
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#Martital"
                        class="btn btn-primary btn-sm">Add New</a>
                    <div class="modal fade" id="Martital" tabindex="-1" aria-labelledby="exampleModalLabel1">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content p-3">
                                <div class="modal-header d-flex align-items-center">
                                    <h4 class="modal-title" id="exampleModalLabel1">
                                        New Marital Status
                                    </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('predefined.storeMaritalStatus') }}" method="POST">
                                    <div class="modal-body">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="control-label mb-2">English:</label>
                                            <input type="text" name="english" class="form-control text-capitalize"
                                                value="{{ old('english') }}" autocomplete="off" autofocus="on"
                                                placeholder="Marital Status">
                                        </div>
                                        <div class="mb-0">
                                            <label for="name" class="control-label mb-2">Kinyarwanda:</label>
                                            <input type="text" name="kinyarwanda" class="form-control text-capitalize"
                                                value="{{ old('kinyarwanda') }}" autocomplete="off"
                                                placeholder="Marital Status">
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
                        @foreach ($marital as $item)
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
                                            <a data-bs-toggle="modal" data-bs-target="#maritalEdit{{ $item->id }}"
                                                class="dropdown-item d-flex align-items-center gap-3" href="#"><i
                                                    class="fs-4 ti ti-edit"></i>Edit</a>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="modal" data-bs-target="#deletemarital{{ $item->id }}"
                                                class="dropdown-item d-flex align-items-center gap-3" href="#"><i
                                                    class="fs-4 ti ti-trash"></i>Delete</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="modal fade" id="deletemarital{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="vertical-center-modal" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content modal-filled bg-light-danger">
                                            <div class="modal-body p-4">
                                                <form action="{{ route('predefined.destroyMaritalStatus',$item->id) }}"
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
                                <div class="modal fade" id="maritalEdit{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel1">
                                    <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content p-3">
                                            <div class="modal-header d-flex align-items-center">
                                                <h4 class="modal-title" id="exampleModalLabel1">
                                                    Edit Insurance
                                                </h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('predefined.updateMaritalStatus',$item->id) }}"
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
                    <h5 class="mb-0">Service Type</h5>
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#Service"
                        class="btn btn-primary btn-sm">Add New</a>
                    <div class="modal fade" id="Service" tabindex="-1" aria-labelledby="exampleModalLabel1">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content p-3">
                                <div class="modal-header d-flex align-items-center">
                                    <h4 class="modal-title" id="exampleModalLabel1">
                                        New Service
                                    </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('predefined.storeService') }}" method="POST">
                                    <div class="modal-body">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="control-label mb-2">English:</label>
                                            <input type="text" name="english" class="form-control text-capitalize"
                                                value="{{ old('english') }}" autocomplete="off" autofocus="on"
                                                placeholder="Service">
                                        </div>
                                        <div class="mb-0">
                                            <label for="name" class="control-label mb-2">Kinyarwanda:</label>
                                            <input type="text" name="kinyarwanda" class="form-control text-capitalize"
                                                value="{{ old('kinyarwanda') }}" autocomplete="off"
                                                placeholder="Service">
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
                        @foreach ($services as $item)
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
                                            <a data-bs-toggle="modal" data-bs-target="#ServiceEdit{{ $item->id }}"
                                                class="dropdown-item d-flex align-items-center gap-3" href="#"><i
                                                    class="fs-4 ti ti-edit"></i>Edit</a>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="modal" data-bs-target="#deleteService{{ $item->id }}"
                                                class="dropdown-item d-flex align-items-center gap-3" href="#"><i
                                                    class="fs-4 ti ti-trash"></i>Delete</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="modal fade" id="deleteService{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="vertical-center-modal" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content modal-filled bg-light-danger">
                                            <div class="modal-body p-4">
                                                <form action="{{ route('predefined.destroyService',$item->id) }}"
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
                                <div class="modal fade" id="ServiceEdit{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel1">
                                    <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content p-3">
                                            <div class="modal-header d-flex align-items-center">
                                                <h4 class="modal-title" id="exampleModalLabel1">
                                                    Edit Service
                                                </h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('predefined.updateService',$item->id) }}"
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
                    <h5 class="mb-0">Medical Ensurance</h5>
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#medical"
                        class="btn btn-primary btn-sm">Add New</a>
                    <div class="modal fade" id="medical" tabindex="-1" aria-labelledby="exampleModalLabel1">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content p-3">
                                <div class="modal-header d-flex align-items-center">
                                    <h4 class="modal-title" id="exampleModalLabel1">
                                        New Insurance
                                    </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('predefined.storeMedicalInsurance') }}" method="POST">
                                    <div class="modal-body">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="control-label mb-2">English:</label>
                                            <input type="text" name="english" class="form-control text-capitalize"
                                                value="{{ old('english') }}" autocomplete="off" autofocus="on"
                                                placeholder="Insurance">
                                        </div>
                                        <div class="mb-0">
                                            <label for="name" class="control-label mb-2">Kinyarwanda:</label>
                                            <input type="text" name="kinyarwanda" class="form-control text-capitalize"
                                                value="{{ old('kinyarwanda') }}" autocomplete="off"
                                                placeholder="Insurance">
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
                        @foreach ($insurance as $item)
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
                                            <a data-bs-toggle="modal" data-bs-target="#insuranceEdit{{ $item->id }}"
                                                class="dropdown-item d-flex align-items-center gap-3" href="#"><i
                                                    class="fs-4 ti ti-edit"></i>Edit</a>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="modal" data-bs-target="#deleteinsurance{{ $item->id }}"
                                                class="dropdown-item d-flex align-items-center gap-3" href="#"><i
                                                    class="fs-4 ti ti-trash"></i>Delete</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="modal fade" id="deleteinsurance{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="vertical-center-modal" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content modal-filled bg-light-danger">
                                            <div class="modal-body p-4">
                                                <form action="{{ route('predefined.destroyMedicalInsurance',$item->id) }}"
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
                                <div class="modal fade" id="insuranceEdit{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel1">
                                    <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content p-3">
                                            <div class="modal-header d-flex align-items-center">
                                                <h4 class="modal-title" id="exampleModalLabel1">
                                                    Edit Insurance
                                                </h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('predefined.updateMedicalInsurance',$item->id) }}"
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
                    <h5 class="mb-0">Saving Type</h5>
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#Saving"
                        class="btn btn-primary btn-sm">Add New</a>
                    <div class="modal fade" id="Saving" tabindex="-1" aria-labelledby="exampleModalLabel1">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content p-3">
                                <div class="modal-header d-flex align-items-center">
                                    <h4 class="modal-title" id="exampleModalLabel1">
                                        New Saving Type
                                    </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('predefined.storeSavingType') }}" method="POST">
                                    <div class="modal-body">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="control-label mb-2">English:</label>
                                            <input type="text" name="english" class="form-control text-capitalize"
                                                value="{{ old('english') }}" autocomplete="off" autofocus="on"
                                                placeholder="Saving Type">
                                        </div>
                                        <div class="mb-0">
                                            <label for="name" class="control-label mb-2">Kinyarwanda:</label>
                                            <input type="text" name="kinyarwanda" class="form-control text-capitalize"
                                                value="{{ old('kinyarwanda') }}" autocomplete="off"
                                                placeholder="Saving Type">
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
                        @foreach ($saving as $item)
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
                                            <a data-bs-toggle="modal" data-bs-target="#savingEdit{{ $item->id }}"
                                                class="dropdown-item d-flex align-items-center gap-3" href="#"><i
                                                    class="fs-4 ti ti-edit"></i>Edit</a>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="modal" data-bs-target="#savingDelete{{ $item->id }}"
                                                class="dropdown-item d-flex align-items-center gap-3" href="#"><i
                                                    class="fs-4 ti ti-trash"></i>Delete</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="modal fade" id="savingDelete{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="vertical-center-modal" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content modal-filled bg-light-danger">
                                            <div class="modal-body p-4">
                                                <form action="{{ route('predefined.destroySavingType',$item->id) }}"
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
                                <div class="modal fade" id="savingEdit{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel1">
                                    <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content p-3">
                                            <div class="modal-header d-flex align-items-center">
                                                <h4 class="modal-title" id="exampleModalLabel1">
                                                    Edit Ministry
                                                </h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('predefined.updateSavingType',$item->id) }}"
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
