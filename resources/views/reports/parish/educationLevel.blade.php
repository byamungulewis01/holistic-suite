@extends('layouts.app')
@section('title', 'Education Level')
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
                <h4 class="mb-0">Education Reports</h4>
            </div>
            <table class="table align-middle text-nowrap mb-0" style="width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ITORERO</th>
                        @foreach ($education as $i)
                        <th>{{ $i->education->$attr }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($churches as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->localChurch->name }}</td>
                        @foreach ($education as $i)
                        <td>{{
                            $educations->where('education_id',$i->education_id)->where('local_church_id',$item->local_church_id)->count()
                            }}</td>
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
