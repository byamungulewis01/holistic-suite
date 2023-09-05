@extends('layouts.app')
@section('title', 'Office')
@section('css')
<link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection
@section('body')
<div class="product-list">
    <div class="card">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center mb-9">
                <h4 class="mb-0">Region List</h4>
                
                <div class="d-flex align-items-center">
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addModel"
                        class="btn btn-outline-primary flex-1 me-2">Add Region</a>
                    <div class="modal fade" id="addModel" tabindex="-1" aria-labelledby="exampleModalLabel1">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content p-3">
                                <div class="modal-header d-flex align-items-center">
                                    <h4 class="modal-title" id="exampleModalLabel1">
                                        Add Region
                                    </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                            <form action="{{ route('office.storeRegion') }}" method="POST">
                                <div class="modal-body">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="control-label">Name:</label>
                                            <input type="text" name="name" class="form-control" id="name" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="message-text" class="control-label">Province:</label>
                                            <select class="form-select" name="province" style="width: 100%; height: 36px">
                                                <option>Select</option>
                                                @foreach ($provinces as $item)
                                                <option value="{{ $item->Prov_ID }}">{{ $item->Province }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {{-- district --}}
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="message-text" class="control-label">District:</label>
                                                <select class="form-select" name="district" style="width: 100%; height: 36px">
                                                    <option>Select</option>
                                                </select>
                                            </div>
                                            {{-- sector --}}
                                            <div class="col-md-6">
                                                <label for="message-text" class="control-label">Sector:</label>
                                                <select class="form-select" name="sector" style="width: 100%; height: 36px">
                                                    <option>Select</option>
                                                </select>
                                            </div>
                                        </div>
                                        {{-- cell --}}
                                       <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="message-text" class="control-label">Cell:</label>
                                            <select class="form-select" name="cell" style="width: 100%; height: 36px">
                                                <option>Select</option>
                                            </select>
                                        </div>
                                        {{-- village --}}
                                        <div class="col-md-6">
                                            <label for="message-text" class="control-label">Village:</label>
                                            <select class="form-select" name="village" style="width: 100%; height: 36px">
                                                <option>Select</option>
                                            </select>
                                        </div>
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
            </div>
            <table id="datatable" class="table align-middle text-nowrap mb-0" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th>Reg Number</th>
                        <th scope="col">Region</th>
                        <th scope="col">Province</th>
                        <th scope="col">District</th>
                        <th scope="col">Sector</th>
                        <th scope="col">Created At</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($regions as $item)
                    <tr>
                        <td><strong>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</strong></td>
                        <td><strong class="text-primary">{{ $item->reg_number }}</strong></td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->province }}</td>
                        <td>{{ $item->district }}</td>
                        <td>{{ $item->sector }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d ,M Y H:i') }}</td>
                        <td>
                            <a href="" data-bs-toggle="modal" data-bs-target="#editOffice" class="btn btn-sm btn-outline-primary editOffice">
                                <span data-id="{{ $item->id }}" data-name = "{{ $item->name }}" data-province = "{{ $item->province_id }}" data-district = "{{ $item->district }}" data-sector = "{{ $item->sector }}" data-cell = "{{ $item->cell }}" data-village = "{{ $item->village }}"
                                    data-district_id = "{{ $item->district_id }}" data-sector_id = "{{ $item->sector_id }}" data-cell_id = "{{ $item->cell_id }}" data-village_id = "{{ $item->village_id }}">
                                Edit</span>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="editOffice" tabindex="-1" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content p-3">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="exampleModalLabel1">
                    Edit Region
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
        <form id="updateform" method="POST">
            <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="control-label">Name:</label>
                        <input type="hidden" name="id" id="id" value="{{ old('id') }}">
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" />
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="control-label">Province:</label>
                        <select class="form-select" id="province" name="province" style="width: 100%; height: 36px" required>
                            @foreach ($provinces as $item)
                            <option {{ old('province') == $item->Prov_ID ? 'selected':'' }} value="{{ $item->Prov_ID }}">{{ $item->Province }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- district --}}
                    {{-- sector --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="message-text" class="control-label">District:</label>
                            <select class="form-select" id="district" name="district" style="width: 100%; height: 36px" required>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="message-text" class="control-label">Sector:</label>
                            <select class="form-select" id="sector" name="sector" style="width: 100%; height: 36px" required>
                            </select>
                        </div>
                    </div>

                    {{-- village --}}
                    <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="message-text" class="control-label">Cell:</label>
                        <select class="form-select" id="cell" name="cell" style="width: 100%; height: 36px" required>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="message-text" class="control-label">Village:</label>
                        <select class="form-select" id="village" name="village" style="width: 100%; height: 36px" required>
                        </select>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-danger text-danger font-medium"
                    data-bs-dismiss="modal">
                    Close
                </button>
                <button class="btn btn-success"> Save Changes </button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).on('click', '.editOffice', function () {
            var id = $(this).find('span').data('id');
            var name = $(this).find('span').data('name');
            var province = $(this).find('span').data('province');
            var district = $(this).find('span').data('district');
            var sector = $(this).find('span').data('sector');
            var cell = $(this).find('span').data('cell');
            var village = $(this).find('span').data('village');
            var district_id = $(this).find('span').data('district_id');
            var sector_id = $(this).find('span').data('sector_id');
            var cell_id = $(this).find('span').data('cell_id');
            var village_id = $(this).find('span').data('village_id');

            // Populate the modal fields with the retrieved data
            $('#editOffice').find('#id').val(id);
            $('#editOffice').find('#name').val(name);
            $('#editOffice').find('#province').val(province);

            var $districtSelect = $('#editOffice').find('#district');
            var $sectorSelect = $('#editOffice').find('#sector');
            var $cellSelect = $('#editOffice').find('#cell');
            var $villageSelect = $('#editOffice').find('#village');

            // Clear existing options
            $districtSelect.empty();
            $sectorSelect.empty();
            $cellSelect.empty();
            $villageSelect.empty();

            // Append unique options
            $districtSelect.append($('<option>', {value: district_id, text: district }));
            $sectorSelect.append($('<option>', {value: sector_id, text: sector }));
            $cellSelect.append($('<option>', {value: cell_id, text: cell }));
            $villageSelect.append($('<option>', {value: village_id, text: village }));

                var route = "{{ route('office.updateRegion', ['id' => ':id']) }}";
                    route = route.replace(':id', id);

                    $('#updateform').attr('action', route);

    });
</script>
<!-- ---------------------------------------------- -->
<script src="{{ asset('dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dist/libs/datatables.net/js/dataTables.bootstrap5.min.js') }}"></script>
<script>
    $(function () {
        $("#datatable").DataTable({ scrollX: true,});
    });
</script>
@include('office.countryJs')
@endsection
