@extends('layouts.app')
@section('title', 'Saving Type')
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
                <h4 class="mb-0">Saving Type Reports</h4>
            </div>
            <table class="table align-middle text-nowrap mb-0" style="width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>PARUWASI</th>
                        @foreach ($savingType as $i)
                        <th>{{ $i->saving_type->$attr }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parishes as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->parish->name }}</td>
                        @foreach ($savingType as $i)
                        <td>{{ $savingTypes->where('saving_id',$i->saving_id)->where('parish_id',$item->parish_id)->count() }}</td>
                        @endforeach
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
