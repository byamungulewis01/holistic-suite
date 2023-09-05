@extends('layouts.app')
@section('title', 'Local Church Users')
@section('css')
<link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection
@section('body')
<div class="product-list">
    <div class="card">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center mb-9">
                <h4 class="mb-0">Local Church Users</h4>
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
                                <form action="{{ route('parish.localChurchUser.store') }}" method="POST">
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

                                        <div class="mb-3">
                                            <label for="email" class="control-label">Email:</label>
                                            <input type="email" name="email" value="{{ old('email') }}"
                                                class="form-control" id="email" placeholder="Enter Email" required
                                                autocomplete="off">
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- phone --}}
                                        <div class="mb-3">
                                            <label for="phone" class="control-label">Phone:</label>
                                            <input type="text" minlength="10" maxlength="10" name="phone"
                                                value="{{ old('phone') }}" class="form-control phone" id="phone"
                                                placeholder="Enter Phone" required autocomplete="off">
                                            @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="username" class="control-label">Username:</label>
                                            <input type="text" name="username" value="{{ old('username') }}"
                                                class="form-control" id="username" placeholder="Enter Username" required
                                                autocomplete="off">
                                            @error('username')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        {{-- parish --}}
                                        <div class="mb-3">
                                            <label for="local_church" class="control-label">Local Church:</label>
                                            <select name="local_church" id="local_church" class="form-select" required>
                                                <option value="">Select Local Church</option>
                                                @foreach ($local_churches as $item)
                                                <option {{ old('local_church')==$item->id ? 'selected' : '' }} value="{{
                                                    $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('local_church')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
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
                        <th scope="col">Created At</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                    <tr>
                        <td><strong>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</strong></td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->localChurch->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d ,M Y H:i') }}</td>
                        <td>
                            <a href="" data-bs-toggle="modal" data-bs-target="#editOffice"
                                class="btn btn-sm btn-outline-primary editOffice">
                                <span data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                                    data-phone="{{ $item->phone }}" data-email="{{ $item->email }}"
                                    data-username="{{ $item->username }}"
                                    data-local_church="{{ $item->local_church_id }}">
                                    Edit</span>
                            </a>
                            <form action="{{ route('parish.localChurchUser.destroy', $item->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
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

                    <div class="mb-3">
                        <label for="email" class="control-label">Email:</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email"
                            placeholder="Enter Email" required autocomplete="off">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- phone --}}
                    <div class="mb-3">
                        <label for="phone" class="control-label">Phone:</label>
                        <input type="text" minlength="10" maxlength="10" name="phone" value="{{ old('phone') }}"
                            class="form-control phone" id="phone" placeholder="Enter Phone" required autocomplete="off">
                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="username" class="control-label">Username:</label>
                        <input type="text" name="username" value="{{ old('username') }}" class="form-control"
                            id="username" placeholder="Enter Username" required autocomplete="off">
                        @error('username')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="local_church" class="control-label">Local Church:</label>
                        <select name="local_church" id="local_church" class="form-control" required>
                            <option value="">Select Local Church</option>
                            @foreach ($local_churches as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('local_church')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
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
    $(document).on('click', '.editOffice', function () {
            var id = $(this).find('span').data('id');
            var name = $(this).find('span').data('name');
            var phone = $(this).find('span').data('phone');
            var email = $(this).find('span').data('email');
            var username = $(this).find('span').data('username');
            var local_church = $(this).find('span').data('local_church');
            // Populate the modal fields with the retrieved data
            $('#editOffice').find('#id').val(id);
            $('#editOffice').find('#name').val(name);
            $('#editOffice').find('#phone').val(phone);
            $('#editOffice').find('#email').val(email);
            $('#editOffice').find('#username').val(username);
            $('#editOffice').find('#local_church').val(local_church);

            var route = "{{ route('parish.localChurchUser.update', ['id' => ':id']) }}";
                route = route.replace(':id', id);

                $('#updateform').attr('action', route);

    });
</script>
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
       @if (old('id'))
        new bootstrap.Modal(document.getElementById('editOffice'), { keyboard: false }).show();
       @else
        new bootstrap.Modal(document.getElementById('addModel'), { keyboard: false }).show();
       @endif
    @endif
</script>
@endsection
