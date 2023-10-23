@extends('layouts.app')
@section('title', 'Social Security')
@section('css')
@include('reports.datatableCss')
@endsection
@section('body')
@php
$attr = __('message.attribute');
@endphp
<div class="product-list">
    <div class="card">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center mb-9">
                <h4 class="mb-0">Social Security Reports</h4>
            </div>
            <table id="datatable" class="table align-middle text-nowrap mb-0" style="width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>MEDICAL INSURANCE</th>
                        <th>ABAGABO</th>
                        <th>ABAGORE</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->insurance->$attr }}</td>
                        <td>{{ $item->totalMale }}</td>
                        <td>{{ $item->totalFemal }}</td>
                        <td>{{ $item->totalCount }}</td>
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
