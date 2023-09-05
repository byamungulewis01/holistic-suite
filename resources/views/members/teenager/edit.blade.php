@extends('layouts.app')
@php
    use App\Models\RwandaGeography;
@endphp
@section('title', 'Teenager')
@section('css')
{{-- <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" /> --}}

<!-- --------------------------------------------------- -->
<link rel="stylesheet" href="{{ asset('dist/libs/prismjs/themes/prism-okaidia.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/libs/select2/dist/css/select2.min.css') }}">

<link rel="stylesheet" href="{{ asset('dist/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection
@section('body')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <form action="{{ route('localChurch.teenager.update',$teenager->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-header">
                    <h5 class="card-title mb-0">Teenager Registration</h5>
                </div>
                <div class="card-body">
                    <label class="mb-3" for="">
                        Basic information
                    </label>
                    <div class="row g-4 mb-3">
                        <div class="col-lg-4">
                            <label for="name" class="form-label">Names <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Names"
                                value="{{ $teenager->name }}" required autocomplete="off">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="phone" class="form-label">Telephone Number</label>
                                <input type="text" class="form-control number" name="phone" id="phone" minlength="10"
                                    maxlength="10" value="{{ $teenager->phone }}" placeholder="Enter Phone"
                                    autocomplete="off">
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Enter Email" value="{{ $teenager->email }}" autocomplete="off">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for="province" class="form-label">Province<span class="text-danger">*</span></label>
                            <select name="province" class="form-select" style="height: 36px; width: 100%" required>
                                <option value="" selected disabled>Select Province</option>
                                @foreach ($provinces as $item)
                                <option {{ $teenager->province_id == $item->Prov_ID ? 'selected':'' }}
                                    value="{{ $item->Prov_ID }}">{{ $item->Province }}</option>
                                @endforeach
                            </select>
                            @error('province')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="district" class="form-label">District<span class="text-danger">*</span></label>
                            <select class="form-select" id="district" name="district" style="width: 100%; height: 36px"
                                required>
                                <option value="{{ $teenager->district_id }}" selected>
                                    {{ $teenager->district }}
                                </option>
                            </select>
                            @error('district')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="sector" class="form-label">Sector<span class="text-danger">*</span></label>
                            <select class="form-select" id="sector" name="sector" style="width: 100%; height: 36px"
                                required>
                                <option value="{{ $teenager->sector_id }}" selected>
                                    {{ $teenager->sector }}
                                </option>
                            </select>
                            @error('sector')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="cell" class="form-label">Cell<span class="text-danger">*</span></label>
                            <select class="form-select" id="cell" name="cell" style="width: 100%; height: 36px"
                                required>
                                <option value="{{ $teenager->cell_id }}" selected>
                                    {{ $teenager->cell }}
                                </option>
                            </select>
                            @error('cell')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="village" class="form-label">Village<span class="text-danger">*</span></label>
                            <select class="form-select" id="village" name="village" style="width: 100%; height: 36px"
                                required>
                                <option value="{{ $teenager->village_id }}" selected>
                                    {{ $teenager->village }}
                                </option>
                            </select>
                            @error('village')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="name" class="form-label mb-3">Gender <span class="text-danger">*</span></label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input primary check-outline outline-primary" type="radio"
                                    id="male" name="gender" value="1"
                                    @if($teenager->gender == 1) checked @endif>
                                <label class="form-check-label" for="male">{{ __('message.gender.0.name') }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input primary check-outline outline-primary" type="radio"
                                    id="female" name="gender" value="2"
                                    @if($teenager->gender == 2) checked @endif>
                                <label class="form-check-label" for="female">{{ __('message.gender.1.name') }}</label>
                            </div>
                        </div>
                    </div>
                    <label class="mb-3" for="">
                        Other information
                    </label>
                    <div class="row g-3">

                        <div class="col-lg-4">
                            <div>
                                <label for="datepicker-autoclose" class="form-label">Date Of Birth <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input name="dateOfBirth" type="text" class="form-control" id="datepicker-autoclose"
                                        required value="{{ $teenager->dateOfBirth }}" placeholder="mm/dd/yyyy" />

                                    <span class="input-group-text">
                                        <i class="ti ti-calendar fs-5"></i>
                                    </span>
                                </div>
                                @error('dateOfBirth')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for="education" class="form-label">School / Grade <span
                                    class="text-danger">*</span></label>
                            <select name="education" id="education" class="form-select" required>
                                <option value="" selected disabled>Select</option>
                                @foreach(__('message.childrenEducation') as $item)
                                <option {{ $teenager->education_id == $item['id'] ? 'selected' : '' }} value="{{ $item['id'] }}">
                                    {{ $item['name'] }}</option>
                                @endforeach
                            </select>
                            @error('education')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="disability" class="form-label">Disability</label>
                            <input type="text" class="form-control" name="disability" id="disability"
                                value="{{ $teenager->disability }}" placeholder="Enter Disability" autocomplete="off">
                            @error('disability')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-4">
                         <label for="insurance" class="form-label">Medical Insurance<span
                                    class="text-danger">*</span></label>
                            <select name="insurance" class="form-select" style="height: 36px; width: 100%" required>
                                <option value="" selected disabled>Select</option>
                                @foreach (__('message.insurance') as $item)
                                <option {{ $teenager->insurance_id == $item['id'] ? 'selected' : '' }}
                                    value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            </select>
                            @error('insurance')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="saving" class="form-label">Saving Type</label>
                            <select name="saving" class="form-select" style="height: 36px; width: 100%">
                                <option value="" selected disabled>Select</option>
                                @foreach (__('message.saving') as $item)
                                <option {{ $teenager->saving_id == $item['id'] ? 'selected' : '' }} value="{{ $item['id'] }}">
                                    {{ $item['name'] }}</option>
                                @endforeach
                            </select>
                            @error('saving')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="btn" class="form-label "></label> <br>
                            <button type="submit" class="btn btn-primary form-control">Save</button>
                        </div>

                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
{{-- <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script> --}}
<!-- ---------------------------------------------- -->
<!-- current page js files -->
<!-- ---------------------------------------------- -->
<script src="{{ asset('dist/libs/prismjs/prism.js') }}"></script>
<script src="{{ asset('dist/libs/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('dist/libs/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('dist/js/forms/select2.init.js') }}"></script>

<script src="{{ asset('dist/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    // Date Picker
    jQuery(".mydatepicker, #datepicker, .input-group.date").datepicker();
    jQuery("#datepicker-autoclose").datepicker({
        autoclose: true,
        todayHighlight: true,
        endDate: '0d',
    });
    jQuery("#date-range").datepicker({
        toggleActive: true,
    });
    jQuery("#datepicker-inline").datepicker({
        todayHighlight: true,
    });

</script>

<script>
    // .phone allow only number

    $(document).ready(function () {
        $(".number").on("input", function () {
            var value = $(this).val();
            var decimalRegex = /^[0-9]+(\.[0-9]{1,2})?$/;
            if (!decimalRegex.test(value)) {
                $(this).val(value.substring(0, value.length - 1));
            }
        });
    });

</script>
@include('office.countryJs')
@endsection
