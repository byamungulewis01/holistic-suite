@extends('layouts.app')
@section('title', 'Church Users')
@section('css')
<link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection
@section('body')
<div class="product-list">
    <div class="card">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center mb-9">
                <div class="d-flex justify-content-between gap-3">
                    <select name="region_search" class="form-select form-select-sm" style="width: 150px;">
                        <option value="" disabled selected>{{ __('message.region') }}</option>
                        @foreach ($regions as $item)
                        <option value="{{ $item->reg_number }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <select name="parish_search" class="form-select form-select-sm" style="width: 150px;">
                        <option value="" disabled selected>{{ __('message.parish') }}</option>
                    </select>
                    <select name="localChurch_search" class="form-select form-select-sm" style="width: 150px;">
                        <option value="" disabled selected>{{ __('message.localChurch') }}</option>
                    </select>

                </div>
                <div class="d-flex align-items-center">
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addModel"
                        class="btn btn-outline-primary flex-1 me-2">Add User</a>
                    <div class="modal fade" id="addModel" tabindex="-1" aria-labelledby="exampleModalLabel1">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content p-3">
                                <div class="modal-header d-flex align-items-center">
                                    <h4 class="modal-title" id="exampleModalLabel1">
                                        Add User
                                    </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('users.localChurch.store') }}" method="POST">
                                    <div class="modal-body">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="control-label">Name:</label>
                                            <input type="text" name="name" value="{{ old('name') }}"
                                                class="form-control" id="name" placeholder="Enter Name" required
                                                autofocus autocomplete="off">
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="email" class="control-label">Email:</label>
                                                <input type="email" name="email" value="{{ old('email') }}"
                                                    class="form-control" id="email" placeholder="Enter Email" required
                                                    autocomplete="off">
                                                @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="phone" class="control-label">Phone:</label>
                                                <input type="text" minlength="10" maxlength="10" name="phone"
                                                    value="{{ old('phone') }}" class="form-control phone" id="phone"
                                                    placeholder="Enter Phone" required autocomplete="off">
                                                @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">

                                            <div class="col-md-6">
                                                <label for="username" class="control-label">Username:</label>
                                                <input type="text" name="username" value="{{ old('username') }}"
                                                    class="form-control" id="username" placeholder="Enter Username"
                                                    required autocomplete="off">
                                                @error('username')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="message-text" class="control-label">Regions:</label>
                                                <select class="form-select" name="region"
                                                    style="width: 100%; height: 36px" required>
                                                    <option>Select</option>
                                                    @foreach ($regions as $item)
                                                    <option {{ old('region') == $item->reg_number ? 'selected' : '' }} value="{{ $item->reg_number }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('region')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="message-text" class="control-label">Parish:</label>
                                                <select class="form-select" name="parish"
                                                    style="width: 100%; height: 36px" required>
                                                    @if (old('parish'))
                                                    <option selected value="{{ old('parish') }}">{{
                                                        \App\Models\Office::where('reg_number',
                                                        old('parish'))->first()->name }}</option>
                                                    @endif
                                                </select>
                                                @error('parish')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            {{-- local Church --}}
                                            <div class="col-md-6">
                                                <label for="message-text" class="control-label">Local Church:</label>
                                                <select class="form-select" name="local_church"
                                                    style="width: 100%; height: 36px" required>
                                                    @if (old('local_church'))
                                                    <option selected value="{{ old('local_church') }}">{{
                                                        \App\Models\Office::where('reg_number',
                                                        old('local_church'))->first()->name }}</option>
                                                    @endif
                                                </select>
                                                @error('local_church')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Username</th>
                        <th scope="col">Local Church</th>
                        <th scope="col">Parish</th>
                        <th scope="col">Region</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($users as $item)
                    <tr>
                        <td><strong>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</strong></td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->localChurch->name }}</td>
                        <td>{{ $item->parish->name }} </td>
                        <td>{{ $item->region->name }}</td>
                        <td>
                            @php
                            $region = \App\Models\Office::find($item->region_id)->reg_number;
                            $parish = \App\Models\Office::find($item->parish_id)->reg_number;
                            $parishName = \App\Models\Office::find($item->parish_id)->name;
                            $localChurch = \App\Models\Office::find($item->local_church_id)->reg_number;
                            $localChurchName = \App\Models\Office::find($item->local_church_id)->name;
                            @endphp
                            <a href="" data-bs-toggle="modal" data-bs-target="#editOffice"
                                class="btn btn-sm btn-outline-primary editOffice">
                                <span data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                                    data-phone="{{ $item->phone }}" data-email="{{ $item->email }}"
                                    data-username="{{ $item->username }}" data-region="{{ $region }}"
                                    data-parish="{{ $parish }}" data-parishname="{{ $parishName }}"
                                    data-localchurch="{{ $localChurch }}" data-localchurchname="{{ $localChurchName }}">
                                    Edit</span>
                            </a>
                            <form action="{{ route('users.localChurch.destroy', $item->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach --}}
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
                    Edit User
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateform" method="POST">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <input type="hidden" name="id" id="id" value="{{ old('id') }}">
                        <label for="name" class="control-label">Name:</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name"
                            placeholder="Enter Name" required autofocus autocomplete="off">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="control-label">Email:</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email"
                                placeholder="Enter Email" required autocomplete="off">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="control-label">Phone:</label>
                            <input type="text" minlength="10" maxlength="10" name="phone" value="{{ old('phone') }}"
                                class="form-control phone" id="phone" placeholder="Enter Phone" required
                                autocomplete="off">
                            @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">

                        <div class="col-md-6">
                            <label for="username" class="control-label">Username:</label>
                            <input type="text" name="username" value="{{ old('username') }}" class="form-control"
                                id="username" placeholder="Enter Username" required autocomplete="off">
                            @error('username')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="message-text" class="control-label">Regions:</label>
                            <select class="form-select" name="region" id="region" style="width: 100%; height: 36px"
                                required>
                                <option>Select</option>
                                @foreach ($regions as $item)
                                <option value="{{ $item->reg_number }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('region')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="message-text" class="control-label">Parish:</label>
                            <select class="form-select" name="parish" id="parish" style="width: 100%; height: 36px"
                                required>

                            </select>
                            @error('parish')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- local Church --}}
                        <div class="col-md-6">
                            <label for="message-text" class="control-label">Local Church:</label>
                            <select class="form-select" name="local_church" id="local_church"
                                style="width: 100%; height: 36px" required>

                            </select>
                            @error('local_church')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-danger text-danger font-medium" data-bs-dismiss="modal">
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
    $(document).ready(function () {
        $('select[name="region"]').on('change', function () {
            var parishID = $(this).val();
            var url = '{{ route("office.getParishes", ":id") }}';
            if (parishID) {
                $.ajax({
                    url: url.replace(':id', parishID),
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="parish"]').empty();
                        $('select[name="local_church"]').empty();

                        $('select[name="parish"]').append(
                            '<option value="">Select</option>');
                        $.each(data, function (key, value) {
                            $('select[name="parish"]').append('<option value="' +
                                value.reg_number + '">' + value.name +
                                '</option>');
                        });
                    }
                });
            } else {
                $('select[name="parish"]').empty();
            }
        });
        $('select[name="parish"]').on('change', function () {
            var churchID = $(this).val();
            var url = '{{ route("office.getChurches", ":id") }}';
            if (churchID) {
                $.ajax({
                    url: url.replace(':id', churchID),
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="local_church"]').empty();
                        $('select[name="local_church"]').append(
                            '<option value="">Select</option>');
                        $.each(data, function (key, value) {
                            $('select[name="local_church"]').append(
                                '<option value="' +
                                value.reg_number + '">' + value.name +
                                '</option>');
                        });
                    }
                });
            } else {
                $('select[name="local_church"]').empty();
            }
        });

    });

</script>
<script>
    $(document).on('click', '.editOffice', function () {
        var id = $(this).find('span').data('id');
        var name = $(this).find('span').data('name');
        var phone = $(this).find('span').data('phone');
        var email = $(this).find('span').data('email');
        var username = $(this).find('span').data('username');
        var region = $(this).find('span').data('region');
        var parish = $(this).find('span').data('parish');
        var parishName = $(this).find('span').data('parishname');
        var localchurch = $(this).find('span').data('localchurch');
        var localchurchname = $(this).find('span').data('localchurchname');
        // Populate the modal fields with the retrieved data
        $('#editOffice').find('#id').val(id);
        $('#editOffice').find('#name').val(name);
        $('#editOffice').find('#phone').val(phone);
        $('#editOffice').find('#email').val(email);
        $('#editOffice').find('#username').val(username);
        $('#editOffice').find('#region').val(region);

        var parishSelect = $('#editOffice').find('#parish');
        var localchurchSelect = $('#editOffice').find('#local_church');
        parishSelect.empty();
        localchurchSelect.empty();
        parishSelect.append($('<option>', {
            value: parish,
            text: parishName
        }));
        localchurchSelect.append($('<option>', {
            value: localchurch,
            text: localchurchname
        }));


        var route = "{{ route('users.localChurch.update', ['id' => ':id']) }}";
        route = route.replace(':id', id);

        $('#updateform').attr('action', route);

    });

</script>
<script>
    $(document).ready(function() {
        $('select[name="region_search"]').on('change', function() {
            var parishID = $(this).val();
            var url = '{{ route("office.getParishes", ":id") }}';
            if (parishID) {
                $.ajax({
                    url: url.replace(':id', parishID)
                    , type: "GET"
                    , dataType: "json"
                    , success: function(data) {
                        $('select[name="parish_search"]').empty();
                        $('select[name="parish_search"]').append('<option value="">Select Parish</option>');
                        $.each(data, function(key, value) {
                            $('select[name="parish_search"]').append('<option value="' +
                                value.reg_number + '">' + value.name +
                                '</option>');
                        });
                    }
                });
            } else {
                $('select[name="parish_search"]').empty();
            }
        });
        $('select[name="parish_search"]').on('change', function() {
            var parishID = $(this).val();
            var url = '{{ route("office.getChurches", ":id") }}';
            if (parishID) {
                $.ajax({
                    url: url.replace(':id', parishID)
                    , type: "GET"
                    , dataType: "json"
                    , success: function(data) {
                        $('select[name="localChurch_search"]').empty();
                        $('select[name="localChurch_search"]').append('<option value="">Select Local Church</option>');
                        $.each(data, function(key, value) {
                            $('select[name="localChurch_search"]').append('<option value="' +
                                value.id + '">' + value.name +
                                '</option>');
                        });
                    }
                });
            } else {
                $('select[name="localChurch_search"]').empty();
            }
        });
        $('select[name="localChurch_search"]').on('change', function() {
            var churchID = $(this).val();
            var url = '{{ route("users.singleLocalChurchUsersApi", ":id") }}';
            if (churchID) {
                $.ajax({
            url: url.replace(':id', churchID)
            , type: "GET"
            , dataType: "json"
            , success: function(data) {
                $("#datatable").DataTable().destroy();
                $('#datatable').DataTable({

                    data: data
                    , columns: [{
                            data: ''
                        }
                        , {
                            data: 'name'
                        }
                        , {
                            data: 'phone'
                        }
                        , {
                            data: 'email'
                        }
                        , {
                            data: 'username'
                        }
                        , {
                            data: 'local_church_id'
                        }
                        , {
                            data: 'parish_id'
                        }
                        , {
                            data: 'region_d'
                        }
                        , {
                            data: ''
                        }
                    , ]
                    , columnDefs: [

                        {
                            targets: 0
                            , render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        }
                        , {
                            targets: 5
                            , render: function(data, type, row, meta) {
                                return '<span>' + row.local_church.name + '</span>';
                            }
                        }
                        , {
                            targets: 6
                            , render: function(data, type, row, meta) {
                                return '<span>' + row.parish.name + '</span>';
                            }
                        }
                        , {
                            targets: 7
                            , render: function(data, type, row, meta) {
                                return '<span>' + row.region.name + '</span>';
                            }
                        },

                        {
                            targets: 8
                            , render: function(data, type, row, meta) {
                                var route = "{{ route('users.localChurch.destroy', ['id' => ':id']) }}";
                                    route = route.replace(':id', row.id);
                                return `<a href="" data-bs-toggle="modal" data-bs-target="#editOffice"
                                class="btn btn-sm btn-outline-primary editOffice">
                                <span data-id="${row.id}" data-name="${row.name}"
                                    data-phone="${row.phone}" data-email="${row.email}"
                                    data-username="${row.username}" data-region="${row.region.reg_number}"
                                    data-parish="${row.parish.reg_number}" data-parishname="${row.parish.name}"
                                    data-localchurch="${row.local_church.reg_number}" data-localchurchname="${row.local_church.name}"
                                    >
                                    Edit</span>
                            </a>
                        <form action="${route}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>`;
                            }
                        }
                    ],

                    scrollX: true
                , });
            }
        });
            } else {
                console.log('error')
            }

        });
    });
</script>
<!-- ---------------------------------------------- -->
<script src="{{ asset('dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dist/libs/datatables.net/js/dataTables.bootstrap5.min.js') }}"></script>
<script>
    $(function() {
        $.ajax({
            url: "{{ route('users.localChurchUsersApi') }}"
            , type: "GET"
            , dataType: "json"
            , success: function(data) {
                $('#datatable').DataTable({

                    data: data
                    , columns: [{
                            data: ''
                        }
                        , {
                            data: 'name'
                        }
                        , {
                            data: 'phone'
                        }
                        , {
                            data: 'email'
                        }
                        , {
                            data: 'username'
                        }
                        , {
                            data: 'local_church_id'
                        }
                        , {
                            data: 'parish_id'
                        }
                        , {
                            data: 'region_d'
                        }
                        , {
                            data: ''
                        }
                    , ]
                    , columnDefs: [

                        {
                            targets: 0
                            , render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        }
                        , {
                            targets: 5
                            , render: function(data, type, row, meta) {
                                return '<span>' + row.local_church.name + '</span>';
                            }
                        }
                        , {
                            targets: 6
                            , render: function(data, type, row, meta) {
                                return '<span>' + row.parish.name + '</span>';
                            }
                        }
                        , {
                            targets: 7
                            , render: function(data, type, row, meta) {
                                return '<span>' + row.region.name + '</span>';
                            }
                        },

                        {
                            targets: 8
                            , render: function(data, type, row, meta) {
                                var route = "{{ route('users.localChurch.destroy', ['id' => ':id']) }}";
                                    route = route.replace(':id', row.id);
                                return `<a href="" data-bs-toggle="modal" data-bs-target="#editOffice"
                                class="btn btn-sm btn-outline-primary editOffice">
                                <span data-id="${row.id}" data-name="${row.name}"
                                    data-phone="${row.phone}" data-email="${row.email}"
                                    data-username="${row.username}" data-region="${row.region.reg_number}"
                                    data-parish="${row.parish.reg_number}" data-parishname="${row.parish.name}"
                                    data-localchurch="${row.local_church.reg_number}" data-localchurchname="${row.local_church.name}"
                                    >
                                    Edit</span>
                            </a>
                        <form action="${route}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>`;
                            }
                        }
                    ],

                    scrollX: true
                , });
            }
        });
    });

</script>
<script>
    $(document).ready(function () {
        $(".phone").on("input", function () {
            var value = $(this).val();
            var decimalRegex = /^[0-9]+(\.[0-9]{1,2})?$/;
            if (!decimalRegex.test(value)) {
                $(this).val(value.substring(0, value.length - 1));
            }
        });
    });

</script>
<script>
    @if($errors->any())
    @if(old('id'))
    new bootstrap.Modal(document.getElementById('editOffice'), {
        keyboard: false
    }).show();
    @else
    new bootstrap.Modal(document.getElementById('addModel'), {
        keyboard: false
    }).show();
    @endif
    @endif

</script>
@endsection
