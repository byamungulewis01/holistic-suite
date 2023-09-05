@extends('layouts.app')
@php
use App\Models\RwandaGeography;
@endphp
@section('title', 'Penitent')
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
            <form action="{{ route('localChurch.penitent.store') }}" method="POST">
                @csrf
                <div class="card-header">
                    <h5 class="card-title mb-0">Penitent Registration</h5>
                </div>
                <div class="card-body">
                    <label class="mb-3" for="">
                        Basic information
                    </label>
                    <div class="row g-4 mb-3">
                        <div class="col-lg-4">
                            <label for="name" class="form-label">Names <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Names"
                                value="{{ old('name') }}" required autocomplete="off" autofocus>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="phone" class="form-label">Telephone Number</label>
                                <input type="text" class="form-control number" name="phone" id="phone" minlength="10"
                                    maxlength="10" value="{{ old('phone') }}" placeholder="Enter Phone"
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
                                    placeholder="Enter Email" value="{{ old('email') }}" autocomplete="off">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for="nid" class="form-label">National ID</label>
                            <input type="text" class="form-control number" name="nid" id="nid" minlength="16"
                                maxlength="16" value="{{ old('nid') }}" placeholder="Enter National ID"
                                autocomplete="off">
                            @error('nid')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="province" class="form-label">Province<span class="text-danger">*</span></label>
                            <select name="province" class="form-select" style="height: 36px; width: 100%" required>
                                <option value="" selected disabled>Select Province</option>
                                @foreach ($provinces as $item)
                                <option {{ old('province') == $item->Prov_ID ? 'selected':'' }}
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
                                @if (old('district'))
                                <option value="{{ old('district') }}" selected>
                                    {{ RwandaGeography::where('Dist_ID',old('district'))->first()->District }}
                                </option>
                                @endif
                            </select>
                            @error('district')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="sector" class="form-label">Sector<span class="text-danger">*</span></label>
                            <select class="form-select" id="sector" name="sector" style="width: 100%; height: 36px"
                                required>
                                @if (old('sector'))
                                <option value="{{ old('sector') }}" selected>
                                    {{ RwandaGeography::where('Sect_ID',old('sector'))->first()->Sector }}
                                </option>
                                @endif
                            </select>
                            @error('sector')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="cell" class="form-label">Cell<span class="text-danger">*</span></label>
                            <select class="form-select" id="cell" name="cell" style="width: 100%; height: 36px"
                                required>
                                @if (old('cell'))
                                <option value="{{ old('cell') }}" selected>
                                    {{ RwandaGeography::where('Cell_ID',old('cell'))->first()->Cell }}
                                </option>
                                @endif
                            </select>
                            @error('cell')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="village" class="form-label">Village<span class="text-danger">*</span></label>
                            <select class="form-select" id="village" name="village" style="width: 100%; height: 36px"
                                required>
                                @if (old('village'))
                                <option value="{{ old('village') }}" selected>
                                    {{ RwandaGeography::where('Vill_ID',old('village'))->first()->Village }}
                                </option>
                                @endif
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
                        <div class="col-lg-3">
                            <label for="name" class="form-label mb-3">Gender <span class="text-danger">*</span></label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input primary check-outline outline-primary" type="radio"
                                    id="male" name="gender" value="1" @if(!old('gender') || old('gender')==1) checked
                                    @endif>
                                <label class="form-check-label" for="male">{{ __('message.gender.0.name') }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input primary check-outline outline-primary" type="radio"
                                    id="female" name="gender" value="2" @if(old('gender')==2) checked @endif>
                                <label class="form-check-label" for="female">{{ __('message.gender.1.name') }}</label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div>
                                <label for="marital_status" class="form-label">Marital Status <span
                                        class="text-danger">*</span></label>
                                <select name="marital_status" id="marital_status" class="form-select" required>
                                    <option value="" selected disabled>Select</option>
                                    @foreach(__('message.marital_status') as $status)
                                    <option {{ old('marital_status') == $status['id'] ? 'selected' : '' }}
                                        value="{{ $status['id'] }}">{{ $status['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('marital_status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div>
                                <label for="datepicker-autoclose" class="form-label">Date Of Birth <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input name="dateOfBirth" type="text" class="form-control" id="datepicker-autoclose"
                                        required value="{{ old('dateOfBirth') }}" placeholder="mm/dd/yyyy" />

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
                            <label for="education" class="form-label">School / Grade <span
                                    class="text-danger">*</span></label>
                            <select name="education" id="education" class="form-select" required>
                                <option value="" selected disabled>Select</option>
                                @foreach(__('message.education') as $item)
                                <option {{ old('education') == $item['id'] ? 'selected' : '' }}
                                    value="{{ $item['id'] }}">
                                    {{ $item['name'] }}</option>
                                @endforeach
                            </select>
                            @error('education')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3">
                            <label for="disability" class="form-label">Disability</label>
                            <input type="text" class="form-control" name="disability" id="disability"
                                value="{{ old('disability') }}" placeholder="Enter Disability" autocomplete="off">
                            @error('disability')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3">
                            <label for="training" class="form-label">Training</label>
                            <input type="text" class="form-control" name="training" id="training"
                                value="{{ old('training') }}" placeholder="Enter Training" autocomplete="off">
                            @error('training')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3">
                            <label for="professional" class="form-label">Professional</label>
                            <input type="text" class="form-control" name="professional" id="professional"
                                value="{{ old('professional') }}" placeholder="Enter Professional" autocomplete="off">
                            @error('professional')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3">
                            <label for="employer" class="form-label">Employer</label>
                            <input type="text" class="form-control" name="employer" id="employer"
                                value="{{ old('employer') }}" placeholder="Enter Employer" autocomplete="off">
                            @error('employer')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="field" class="form-label"> Field</label>
                            <select name="field[]" id="field" class="select2 form-select" multiple="multiple"
                                style="height: 36px; width: 100%" data-placeholder="Select ">
                                @foreach (__('message.fields') as $item)
                                <option @if(in_array($item['id'], old('field', []))) selected @endif
                                    value="{{ $item['id'] }}">
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
                                <option {{ old('insurance') == $item['id'] ? 'selected' : '' }}
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
                                <option {{ old('saving') == $item['id'] ? 'selected' : '' }} value="{{ $item['id'] }}">
                                    {{ $item['name'] }}</option>
                                @endforeach
                            </select>
                            @error('saving')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-4">
                            <div class="mb-2">
                                <label for="relation" class="form-label">Relation<span
                                        class="text-danger">*</span></label>
                                <select name="relation" class="form-select" style="height: 36px; width: 100%" required>
                                    <option value="" selected disabled>Select</option>
                                    @foreach (__('message.relation') as $item)
                                    <option {{ old('relation') == $item['id'] ? 'selected' : '' }}
                                        value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('relation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="service" class="form-label">Service Type<span
                                        class="text-danger">*</span></label>
                                <select name="service" class="form-select" style="height: 36px; width: 100%" required>
                                    <option value="" selected disabled>Select</option>
                                    @foreach (__('message.services') as $item)
                                    <option {{ old('service') == $item['id'] ? 'selected' : '' }}
                                        value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('service')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="religion" class="form-label">Previous Religion<span
                                        class="text-danger">*</span></label>
                                <select name="religion" class="form-select" style="height: 36px; width: 100%" required>
                                    <option value="" selected disabled>Select</option>
                                    @foreach (__('message.religions') as $item)
                                    <option {{ old('religion') == $item['id'] ? 'selected' : '' }}
                                        value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('religion')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <label for="motif" class="form-label">Motification<span class="text-danger">*</span></label>

                            <textarea name="motif" class="form-control" id="motif" rows="8"
                                placeholder="Enter Motification for Penitent" required>{{ old('motif') }}</textarea>

                            @error('motif')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="col-lg-12 mt-3">
                        <div class="hstack justify-content-end gap-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
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
