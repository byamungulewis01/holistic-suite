@extends('layouts.app')
@section('title', 'Teenager')
@section('css')
<link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection
@section('body')
<div class="product-list">
    <div class="card">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center mb-9">
                <h4 class="mb-0">Teenager List</h4>

                <div class="btn-group">
                    <a href="{{ route('localChurch.teenager.create') }}" class="btn btn-primary">Add Member</a>
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
                        <th scope="col">Date Of Birth</th>
                        <th scope="col">Disability</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teenagers as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ (!$item->phone) ? 'N/A' : $item->phone }}</td>
                        <td>{{ (!$item->email) ? 'N/A' : $item->email }}</td>
                        <td>
                            @php
                                if ($item->gender == 1) {
                                   $gender = __('message.gender.0.name');
                                } else {
                                    $gender = __('message.gender.1.name');
                                }

                            @endphp
                            {{ $gender }}
                        </td>
                        <td>{{ $item->dateOfBirth }}</td>
                        <td>{{ (!$item->disability) ? 'N/A' : $item->disability }}</td>
                        <td>
                            <a href="{{ route('localChurch.teenager.show',$item->id) }}"
                                class="btn btn-sm btn-primary">Profile</a>
                            <a href="{{ route('localChurch.teenager.edit',$item->id) }}"
                                class="btn btn-sm btn-success">Edit</a>
                            <a data-bs-toggle="modal" data-bs-target="#deleteList{{ $item->id }}"
                                class="btn btn-sm btn-danger" href="#">Delete</a>

                            <div class="modal fade" id="deleteList{{ $item->id }}" tabindex="-1"
                                aria-labelledby="vertical-center-modal" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content modal-filled bg-light-danger">
                                        <div class="modal-body p-4">
                                            <form action="{{ route('localChurch.teenager.destroy',$item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <div class="text-center text-danger">
                                                    <i class="ti ti-hexagon-letter-x fs-7"></i>
                                                    <h4 class="mt-2">Are you sure to delete?</h4>
                                                    <p class="mt-3">
                                                        Delete Teenager will permanently remove the member
                                                        from your list.
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
@endsection
