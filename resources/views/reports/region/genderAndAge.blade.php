@extends('layouts.app')
@section('title', 'Gender & Age Report')
@section('css')
<link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection
@section('body')
<div class="product-list">
    <div class="card">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center mb-9">
                <h4 class="mb-0">Member Reports</h4>
            </div>
            <table class="table align-middle text-nowrap mb-0" style="width: 100%;">
                <thead>
                    <tr>
                        <th style="width: 20px;">#</th>
                        <th>PARUWASI</th>
                        <th>12 - 17</th>
                        <th>18 - 24</th>
                        <th>25 - 30</th>
                        <th>31 - 40</th>
                        <th>41 - 50</th>
                        <th>> 50</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parishes as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->parish->name }}</td>
                        <td>{{ $member12And17->where('parish_id',$item->parish_id)->count() }}</td>
                        <td>{{ $member18And24->where('parish_id',$item->parish_id)->count() }}</td>
                        <td>{{ $member25And30->where('parish_id',$item->parish_id)->count() }}</td>
                        <td>{{ $member31And40->where('parish_id',$item->parish_id)->count() }}</td>
                        <td>{{ $member41And50->where('parish_id',$item->parish_id)->count() }}</td>
                        <td>{{ $memberAbove50->where('parish_id',$item->parish_id)->count() }}</td>
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
        $("#datatable").DataTable();
    });
</script>
@endsection
