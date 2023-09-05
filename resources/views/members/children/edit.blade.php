@extends('layouts.app')
@php
    use App\Models\RwandaGeography;
@endphp
@section('title', 'Add Child')
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
            <form action="{{ route('localChurch.children.update',$child->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __('church/children.editTitle') }}</h5>
                </div>
                <div class="card-body">
                    <label class="mb-3" for="">
                        {{ __('church/member.basic') }}
                    </label>
                    <div class="row g-4 mb-3">
                        <div class="col-lg-4">
                            <label for="name" class="form-label">{{ __('church/member.name') }}  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Names"
                                value="{{ $child->name }}" required autocomplete="off">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="fatherName" class="form-label">{{ __('church/children.father') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="fatherName" id="fatherName" value="{{ $child->fatherName }}"
                                    autocomplete="off">
                                    @error('fatherName')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="motherName" class="form-label">{{ __('church/children.mother') }}<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="motherName" id="motherName"
                                     value="{{ $child->motherName }}" autocomplete="off">
                                    @error('motherName')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for="parentPhone" class="form-label">{{ __('church/children.parentPhone') }}  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control number" name="parentPhone" id="parentPhone"
                                minlength="10" maxlength="10" value="{{ $child->parentPhone }}"
                                autocomplete="off">
                                @error('parentPhone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="province" class="form-label">{{ __('church/member.province') }}<span class="text-danger">*</span></label>
                            <select name="province" class="form-select" style="height: 36px; width: 100%" required>
                                @foreach ($provinces as $item)
                                <option {{ $child->province_id == $item->Prov_ID ? 'selected':'' }}
                                    value="{{ $item->Prov_ID }}">{{ $item->Province }}</option>
                                @endforeach
                            </select>
                            @error('province')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="district" class="form-label">{{ __('church/member.district') }}<span class="text-danger">*</span></label>
                            <select class="form-select" id="district" name="district" style="width: 100%; height: 36px"
                                required>
                                <option value="{{ $child->district_id }}" selected>
                                  {{ $child->district }}
                                </option>
                            </select>
                            @error('district')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="sector" class="form-label">{{ __('church/member.sector') }}<span class="text-danger">*</span></label>
                            <select class="form-select" id="sector" name="sector" style="width: 100%; height: 36px"
                                required>
                                <option value="{{ $child->sector_id }}" selected>
                                  {{ $child->sector }}
                                </option>
                            </select>
                            @error('sector')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="cell" class="form-label">{{ __('church/member.cell') }}<span class="text-danger">*</span></label>
                            <select class="form-select" id="cell" name="cell" style="width: 100%; height: 36px"
                                required>
                                <option value="{{ $child->cell_id }}" selected>
                                  {{ $child->cell }}
                                </option>
                            </select>
                            @error('cell')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="village" class="form-label">{{ __('church/member.village') }}<span class="text-danger">*</span></label>
                            <select class="form-select" id="village" name="village" style="width: 100%; height: 36px"
                                required>
                                <option value="{{ $child->village_id }}" selected>
                                  {{ $child->village }}
                                </option>

                            </select>
                            @error('village')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <label class="mb-3" for="">
                        {{ __('church/member.other') }}
                    </label>
                    <div class="row g-3">
                        <div class="col-lg-3">
                            <label for="gender" class="form-label mb-3">{{ __('church/member.gender') }} <span class="text-danger">*</span></label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input primary check-outline outline-primary" type="radio"
                                    id="male" name="gender" value="1"
                                    @if(!$child->gender || $child->gender == 1) checked @endif>
                                <label class="form-check-label" for="male">{{ __('message.gender.0.name') }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input primary check-outline outline-primary" type="radio"
                                    id="female" name="gender" value="2"
                                    @if($child->gender == 2) checked @endif>
                                <label class="form-check-label" for="female">{{ __('message.gender.1.name') }}</label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label for="education" class="form-label">{{ __('church/member.school') }} <span
                                    class="text-danger">*</span></label>
                            <select name="education" id="education" class="form-select" required>
                                @foreach(__('message.childrenEducation') as $item)
                                <option {{ $child->education_id == $item['id'] ? 'selected' : '' }} value="{{ $item['id'] }}">
                                    {{ $item['name'] }}</option>
                                @endforeach
                            </select>
                            @error('education')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3">
                            <div>
                                <label for="datepicker-autoclose" class="form-label">{{ __('church/member.dob') }} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input name="dateOfBirth" type="text" class="form-control" id="datepicker-autoclose"
                                        required value="{{ $child->dateOfBirth }}" />

                                    <span class="input-group-text">
                                        <i class="ti ti-calendar fs-5"></i>
                                    </span>
                                </div>
                                @error('dateOfBirth')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div>
                                <label for="datepicker-autoclose" class="form-label">{{ __('church/children.dayOfPrayer') }}</label>
                                <div class="input-group">
                                    <input name="dateOfPrayer" type="text" class="form-control" id="datepicker-autoclose1"
                                     value="{{ $child->dateOfPrayer }}" placeholder="mm/dd/yyyy" />

                                    <span class="input-group-text">
                                        <i class="ti ti-calendar fs-5"></i>
                                    </span>
                                </div>
                                @error('dateOfPrayer')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <label for="disability" class="form-label">{{ __('church/member.disability') }}</label>
                            <input type="text" class="form-control" name="disability" id="disability"
                                value="{{ $child->disability }}" placeholder="{{ __('church/member.disability') }}" autocomplete="off">
                            @error('disability')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-3">
                            <label for="insurance" class="form-label">{{ __('church/member.insurance') }}<span
                                    class="text-danger">*</span></label>
                            <select name="insurance" class="form-select" style="height: 36px; width: 100%" required>
                                <option value="" selected disabled>Select</option>
                                @foreach (__('message.insurance') as $item)
                                <option {{ $child->insurance_id == $item['id'] ? 'selected' : '' }}
                                    value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            </select>
                            @error('insurance')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-3">
                            <label for="orphanStatus" class="form-label">{{ __('church/children.orphans') }}<span
                                    class="text-danger">*</span></label>
                            <select name="orphanStatus" class="form-select" style="height: 36px; width: 100%" required>
                                @foreach (__('message.orphanStatus') as $item)
                                <option {{ $child->orphanStatus == $item['id'] ? 'selected' : '' }}
                                    value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            </select>
                            @error('orphanStatus')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-3">
                            <label for="status" class="form-label">Status<span class="text-danger">*</span></label>
                            <select name="status" class="form-select" style="height: 36px; width: 100%" required>
                                @foreach (__('message.childrenStatus') as $item)
                                <option {{ $child->status == $item['id'] ? 'selected' : '' }} value="{{ $item['id'] }}">
                                    {{ $item['name'] }}</option>
                                @endforeach
                            </select>
                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12 mt-3">
                        <div class="hstack justify-content-end gap-2">
                            <button type="submit" class="btn btn-primary">{{ __('church/member.save') }}</button>
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
    jQuery("#datepicker-autoclose1").datepicker({
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

    $(document).ready(function () {
        $('#field').on('change', function () {
            // Check the number of selected options
            var selectedOptions = $(this).val();
            if (selectedOptions && selectedOptions.length > 3) {
                // If more than 3 options are selected, deselect the last selected option
                $(this).val(selectedOptions.slice(0, 3));
            }
        });
    });

</script>
@include('office.countryJs')
@endsection
