@extends('layouts.app')
@php
    use App\Models\RwandaGeography;
@endphp
@section('title', 'Edit Friend')
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
            <form action="{{ route('localChurch.friend.update',$member->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Member</h5>
                </div>
                <div class="card-body">
                    <label class="mb-3" for="">
                        Basic information
                    </label>
                    <div class="row g-4 mb-3">
                        <div class="col-lg-4">
                            <label for="name" class="form-label">Names <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Names"
                                value="{{ $member->name }}" required autocomplete="off">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="phone" class="form-label">Telephone Number</label>
                                <input type="text" class="form-control number" name="phone" id="phone" minlength="10"
                                    maxlength="10" value="{{ $member->phone }}" placeholder="Enter Phone"
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
                                    placeholder="Enter Email" value="{{ $member->email }}" autocomplete="off">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for="nid" class="form-label">National ID</label>
                            <input type="text" class="form-control number" name="nid" id="nid"
                                minlength="16" maxlength="16" value="{{ $member->nid }}"
                                placeholder="Enter National ID" autocomplete="off">
                                @error('nid')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="province" class="form-label">Province<span class="text-danger">*</span></label>
                            <select name="province" class="form-select" style="height: 36px; width: 100%" required>
                                <option value="" selected disabled>Select Province</option>
                                @foreach ($provinces as $item)
                                <option {{ $member->province_id == $item->Prov_ID ? 'selected':'' }}
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
                                <option value="{{ $member->district_id }}" selected>
                                    {{ $member->district }}
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
                                <option value="{{ $member->sector_id }}" selected>
                                    {{ $member->sector }}
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
                                <option value="{{ $member->cell_id }}" selected>
                                    {{ $member->cell }}
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
                                <option value="{{ $member->village_id }}" selected>
                                    {{ $member->village }}
                                </option>
                            </select>
                            @error('village')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <label class="mb-3" for="">
                        Other information
                    </label>
                    <div class="row g-3">
                        <div class="col-lg-4">
                            <label for="name" class="form-label mb-3">Gender <span class="text-danger">*</span></label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input primary check-outline outline-primary" type="radio"
                                    id="male" name="gender" value="1"
                                    @if($member->gender == 1) checked @endif>
                                <label class="form-check-label" for="male">{{ __('message.gender.0.name') }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input primary check-outline outline-primary" type="radio"
                                    id="female" name="gender" value="2"
                                    @if($member->gender == 2) checked @endif>
                                <label class="form-check-label" for="female">{{ __('message.gender.1.name') }}</label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="marital_status" class="form-label">Marital Status <span
                                        class="text-danger">*</span></label>
                                <select name="marital_status" id="marital_status" class="form-select" required>
                                    <option value="" selected disabled>Select</option>
                                    @foreach(__('message.marital_status') as $status)
                                    <option {{ $member->marital_status_id == $status['id'] ? 'selected' : '' }}
                                        value="{{ $status['id'] }}">{{ $status['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('marital_status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="datepicker-autoclose" class="form-label">Date Of Birth <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input name="dateOfBirth" type="text" class="form-control" id="datepicker-autoclose"
                                        required value="{{ $member->dateOfBirth }}" placeholder="mm/dd/yyyy" />

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
                                @foreach(__('message.education') as $item)
                                <option {{ $member->education_id == $item['id'] ? 'selected' : '' }} value="{{ $item['id'] }}">
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
                                value="{{ $member->disability }}" placeholder="Enter Disability" autocomplete="off">
                            @error('disability')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="training" class="form-label">Training</label>
                            <input type="text" class="form-control" name="training" id="training"
                                value="{{ $member->training }}" placeholder="Enter Training" autocomplete="off">
                                @error('training')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                        <div class="col-lg-3">
                            <label for="professional" class="form-label">Professional</label>
                            <input type="text" class="form-control" name="professional" id="professional"
                                value="{{ $member->professional }}" placeholder="Enter Professional" autocomplete="off">
                                @error('professional')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                        <div class="col-lg-3">
                            <label for="employer" class="form-label">Employer</label>
                            <input type="text" class="form-control" name="employer" id="employer"
                                value="{{ $member->employer }}" placeholder="Enter Employer" autocomplete="off">
                                @error('employer')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="field" class="form-label"> Field</label>
                            <select name="field[]" id="field" class="select2 form-select" multiple="multiple"
                                style="height: 36px; width: 100%" data-placeholder="Select ">
                                @foreach (__('message.fields') as $item)
                                <option @foreach (explode(',',$member->field_id) as $field) {{ $field == $item['id'] ? 'selected' : '' }} @endforeach value="{{ $item['id'] }}">
                                    {{ $item['name'] }}</option>
                                @endforeach
                            </select>
                            @error('field')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3">
                            <label for="insurance" class="form-label">Medical Insurance<span
                                    class="text-danger">*</span></label>
                            <select name="insurance" class="form-select" style="height: 36px; width: 100%" required>
                                <option value="" selected disabled>Select</option>
                                @foreach (__('message.insurance') as $item)
                                <option {{ $member->insurance_id == $item['id'] ? 'selected' : '' }}
                                    value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            </select>
                            @error('insurance')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3">
                            <label for="saving" class="form-label">Saving Type</label>
                            <select name="saving" class="form-select" style="height: 36px; width: 100%">
                                <option value="" selected disabled>Select</option>
                                @foreach (__('message.saving') as $item)
                                <option {{ $member->saving_id == $item['id'] ? 'selected' : '' }} value="{{ $item['id'] }}">
                                    {{ $item['name'] }}</option>
                                @endforeach
                            </select>
                            @error('saving')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3">
                            <label for="religion" class="form-label">Previous Religion<span
                                    class="text-danger">*</span></label>
                            <select name="religion" class="form-select" style="height: 36px; width: 100%" required>
                                <option value="" selected disabled>Select</option>
                                @foreach(__('message.religions') as $item)
                                <option {{ $member->previus_religion_id == $item['id'] ? 'selected' : '' }}
                                    value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            </select>
                            @error('religion')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3">
                            <label for="relation" class="form-label">Relation<span class="text-danger">*</span></label>
                            <select name="relation" class="form-select" style="height: 36px; width: 100%" required>
                                <option value="" selected disabled>Select</option>
                                @foreach (__('message.relation') as $item)
                                <option {{ $member->relation == $item['id'] ? 'selected' : '' }}
                                    value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            </select>
                            @error('relation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12 mt-3">
                        <div class="hstack justify-content-end gap-2">
                            <button type="submit" class="btn btn-primary">Save</button>
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
