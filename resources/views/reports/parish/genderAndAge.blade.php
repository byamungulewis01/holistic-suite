@extends('layouts.app')
@section('title', 'Gender & Age Report')
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
            <table class="table align-middle text-nowrap mb-0" style="width: 100%;">
                <thead>
                    <tr>
                        <th style="width: 20px;">#</th>
                        <th>ITORERO</th>
                        <th>12 - 17</th>
                        <th>18 - 24</th>
                        <th>25 - 30</th>
                        <th>31 - 40</th>
                        <th>41 - 50</th>
                        <th>> 50</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($churches as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->localChurch->name }}</td>
                        <td>{{ $member12And17->where('local_church_id',$item->local_church_id)->count() }}</td>
                        <td>{{ $member18And24->where('local_church_id',$item->local_church_id)->count() }}</td>
                        <td>{{ $member25And30->where('local_church_id',$item->local_church_id)->count() }}</td>
                        <td>{{ $member31And40->where('local_church_id',$item->local_church_id)->count() }}</td>
                        <td>{{ $member41And50->where('local_church_id',$item->local_church_id)->count() }}</td>
                        <td>{{ $memberAbove50->where('local_church_id',$item->local_church_id)->count() }}</td>
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
