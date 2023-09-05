@extends('layouts.app')
@section('title', __('church/children.title'))
@section('css')
<link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection
@section('body')
<div class="product-list">
    <div class="card">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center mb-9">
                <h4 class="mb-0">{{ __('church/children.rtitle') }}</h4>

                <div class="btn-group">
                    <a href="{{ route('localChurch.children.create') }}" class="btn btn-primary">{{ __('church/children.add') }}</a>
                </div>

            </div>
            <table id="datatable" class="table align-middle text-nowrap mb-0" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th>{{ __('church/member.name') }} </th>
                        <th>{{ __('church/member.dob') }}</th>
                        <th>{{ __('church/member.gender') }}</th>
                        <th>{{ __('church/children.mother') }}</th>
                        <th>{{ __('church/children.father') }}</th>
                        <th>{{ __('church/children.prayed') }}</th>
                        <th>{{ __('church/member.school') }}</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($children as $item)
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->dateOfBirth }}</td>
                <td>@if ($item->gender == 1) {{ __('message.gender.0.name') }}
                    @else {{ __('message.gender.1.name') }} @endif</td>
                <td>{{ $item->fatherName }}</td>
                <td>{{ $item->motherName }}</td>
                <td>{{ $item->dateOfPrayer ? 'YES' : 'NO' }}</td>
                <td>
                    @php
                        $attr = __('message.attribute');
                    @endphp
                    {{ $item->education->$attr }}
                </td>

                <td>
                    <a href="{{ route('localChurch.children.show',$item->id) }}"
                        class="btn btn-sm btn-primary">{{ __('church/member.profile') }}s</a>
                    <a href="{{ route('localChurch.children.edit',$item->id) }}"
                        class="btn btn-sm btn-success">{{ __('church/member.edit') }}</a>
                    <a data-bs-toggle="modal" data-bs-target="#deleteList{{ $item->id }}"
                        class="btn btn-sm btn-danger" href="#">{{ __('church/member.delete') }}</a>

                    <div class="modal fade" id="deleteList{{ $item->id }}" tabindex="-1"
                        aria-labelledby="vertical-center-modal" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content modal-filled bg-light-danger">
                                <div class="modal-body p-4">
                                    <form action="{{ route('localChurch.children.destroy',$item->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <div class="text-center text-danger">
                                            <i class="ti ti-hexagon-letter-x fs-7"></i>
                                            <h4 class="mt-2">{{ __('church/children.deleteMsg') }}</h4>
                                            <p class="mt-3">
                                                {{ __('church/children.deleteBody') }}
                                            </p>
                                            <button class="btn btn-light my-2">
                                                {{ __('church/children.deleteBtn') }}
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
