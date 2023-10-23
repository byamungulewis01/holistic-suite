@extends('layouts.app')
@section('title', 'Member report')
@section('css')
@include('reports.datatableCss')
@endsection
@section('body')
<div class="product-list">
    <div class="card">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center mb-9">
                <h4 class="mb-0">Member Reports</h4>
            </div>
            <table id="datatable" class="table align-middle text-nowrap mb-0" style="width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Paruwasi</th>
                        <th>Abanyetorero</th>
                        <th>Abana</th>
                        <th>Ingimbi</th>
                        <th>Inshuti z'itorero</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->parish->name }}</td>
                        <td>{{ $item->countMember }}</td>
                        <td>{{ $item->countChildren }}</td>
                        <td>{{ $item->countTeenagers }}</td>
                        <td>{{ $item->countFriends }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
@include('reports.datatableJs')
@endsection
