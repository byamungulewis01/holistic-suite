@extends('layouts.app')
@section('title', 'Members')
@section('css')
<link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection
@section('body')
<div class="product-list">
    <div class="card">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center mb-9">
                <h4 class="mb-0">{{ __('church/member.rtitle') }}</h4>

                <div class="btn-group">
                    <a href="{{ route('localChurch.member.create') }}" class="btn btn-primary">{{ __('church/member.add') }}</a>
                </div>

            </div>
            <table id="datatable" class="table align-middle text-nowrap mb-0" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th>{{ __('church/member.reg_no') }}</th>
                        <th scope="col">{{ __('church/member.name') }}</th>
                        <th scope="col">{{ __('church/member.phone') }}</th>
                        <th scope="col">{{ __('church/member.email') }}</th>
                        <th scope="col">{{ __('church/member.nid') }}</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->reg_no }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ ($item->phone) ? $item->phone : 'N/A' }}</td>
                        <td>{{ ($item->email) ? $item->email : 'N/A' }}</td>
                        <td>{{ ($item->nid) ? $item->nid : 'N/A' }}</td>
                        <td>
                            @if ($item->status == 1)
                            <span
                                class="mb-1 badge font-medium bg-light-info text-info">{{ __('message.status.0.name') }}</span>
                            @elseif($item->status == 2)
                            <span
                                class="mb-1 badge font-medium bg-light-warning text-warning">{{ __('message.status.1.name') }}</span>
                            @elseif($item->status == 3)
                            <span
                                class="mb-1 badge font-medium bg-light-success text-success">{{ __('message.status.2.name') }}</span>
                            @else
                            <span
                                class="mb-1 badge font-medium bg-light-danger text-danger">{{ __('message.status.3.name') }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('localChurch.member.show',$item->id) }}"
                                class="btn btn-sm btn-primary">{{ __('church/member.profile') }}</a>
                            <a href="{{ route('localChurch.member.edit',$item->id) }}"
                                class="btn btn-sm btn-success">{{ __('church/member.edit') }}</a>

                            {{-- <a data-bs-toggle="modal" data-bs-target="#deleteList{{ $item->id }}"
                                class="btn btn-sm btn-danger" href="#">{{ __('church/member.delete') }}</a> --}}

                            <div class="modal fade" id="deleteList{{ $item->id }}" tabindex="-1"
                                aria-labelledby="vertical-center-modal" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content modal-filled bg-light-danger">
                                        <div class="modal-body p-4">
                                            <form action="{{ route('localChurch.member.destroy',$item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <div class="text-center text-danger">
                                                    <i class="ti ti-hexagon-letter-x fs-7"></i>
                                                    <h4 class="mt-2">{{ __('church/member.deleteMsg') }}</h4>
                                                    <p class="mt-3">
                                                        {{ __('church/member.deleteBody') }}
                                                    </p>
                                                    <button class="btn btn-light my-2">
                                                        {{ __('church/member.deleteBtn') }}
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
