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
            <table id="datatable" class="table align-middle text-nowrap mb-0" style="width: 100%;">
                <thead>
                    <tr>
                        <th style="width: 20px;">#</th>
                        <th>AGE</th>
                        <th>MALE</th>
                        <th>FEMELE</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><strong>12 - 17</strong></td>
                        <td>{{ $member12And17->where('gender',1)->count() }}</td>
                        <td>{{ $member12And17->where('gender',2)->count() }}</td>
                        <td>{{ $member12And17->where('gender',1)->count() + $member12And17->where('gender',2)->count()
                            }}</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><strong>18 - 24</strong></td>
                       <td>{{ $member18And24->where('gender',1)->count() }}</td>
                        <td>{{ $member18And24->where('gender',2)->count() }}</td>
                        <td>{{ $member18And24->where('gender',1)->count() + $member18And24->where('gender',2)->count()
                            }}</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><strong>25 - 30</strong></td>
                       <td>{{ $member25And30->where('gender',1)->count() }}</td>
                        <td>{{ $member25And30->where('gender',2)->count() }}</td>
                        <td>{{ $member25And30->where('gender',1)->count() + $member25And30->where('gender',2)->count()
                            }}</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td><strong>31 - 40</strong></td>
                       <td>{{ $member31And40->where('gender',1)->count() }}</td>
                        <td>{{ $member31And40->where('gender',2)->count() }}</td>
                        <td>{{ $member31And40->where('gender',1)->count() + $member31And40->where('gender',2)->count()
                            }}</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td><strong>41 - 50</strong></td>
                       <td>{{ $member41And50->where('gender',1)->count() }}</td>
                        <td>{{ $member41And50->where('gender',2)->count() }}</td>
                        <td>{{ $member41And50->where('gender',1)->count() + $member41And50->where('gender',2)->count()
                            }}</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td><strong>> 50</strong></td>
                       <td>{{ $memberAbove50->where('gender',1)->count() }}</td>
                        <td>{{ $memberAbove50->where('gender',2)->count() }}</td>
                        <td>{{ $memberAbove50->where('gender',1)->count() + $memberAbove50->where('gender',2)->count()
                            }}</td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
@include('reports.datatableJs')
@endsection
