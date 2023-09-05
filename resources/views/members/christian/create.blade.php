@extends('layouts.app')
@php
    use App\Models\RwandaGeography;
@endphp
@section('title', __('church/churchNav.member'))
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
            <form action="{{ route('localChurch.member.store') }}" method="POST">
                @csrf
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __('church/member.title') }}</h5>
                </div>
                <div class="card-body">
                    <label class="mb-3" for="">
                        {{ __('church/member.basic') }}
                    </label>
                    <div class="row g-4 mb-3">
                        <div class="col-lg-4">
                            <label for="name" class="form-label"> {{ __('church/member.name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="name" placeholder=" {{ __('church/member.pname') }}"
                                value="{{ old('name') }}" required autocomplete="off" autofocus>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="phone" class="form-label"> {{ __('church/member.phone') }}</label>
                                <input type="text" class="form-control number" name="phone" id="phone" minlength="10"
                                    maxlength="10" value="{{ old('phone') }}" placeholder=" {{ __('church/member.pphone') }}"
                                    autocomplete="off">
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="email" class="form-label"> {{ __('church/member.email') }}</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder=" {{ __('church/member.pemail') }}" value="{{ old('email') }}" autocomplete="off">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for="nid" class="form-label"> {{ __('church/member.nid') }}</label>
                            <input type="text" class="form-control number" name="nid" id="nid"
                                minlength="16" maxlength="16" value="{{ old('nid') }}"
                                placeholder=" {{ __('church/member.pnid') }}" autocomplete="off">
                                @error('nid')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="province" class="form-label"> {{ __('church/member.province') }}<span class="text-danger">*</span></label>
                            <select name="province" class="form-select" style="height: 36px; width: 100%" required>
                                <option value="" selected disabled> {{ __('church/member.pprovince') }}</option>
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
                            <label for="district" class="form-label"> {{ __('church/member.district') }}<span class="text-danger">*</span></label>
                            <select class="form-select" id="district" name="district" style="width: 100%; height: 36px"
                                required>
                                <option value=""> {{ __('church/member.pdistrict') }}</option>
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
                            <label for="sector" class="form-label"> {{ __('church/member.sector') }}<span class="text-danger">*</span></label>
                            <select class="form-select" id="sector" name="sector" style="width: 100%; height: 36px"
                                required>
                                <option value="">{{ __('church/member.psector') }}</option>
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
                            <label for="cell" class="form-label"> {{ __('church/member.cell') }}<span class="text-danger">*</span></label>
                            <select class="form-select" id="cell" name="cell" style="width: 100%; height: 36px"
                                required>
                                <option value="">{{ __('church/member.pcell') }}</option>
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
                            <label for="village" class="form-label"> {{ __('church/member.village') }}<span class="text-danger">*</span></label>
                            <select class="form-select" id="village" name="village" style="width: 100%; height: 36px"
                                required>
                                <option value="">{{ __('church/member.pvillage') }}</option>
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
                        {{ __('church/member.other') }}
                    </label>
                    <div class="row g-3">
                        <div class="col-lg-3">
                            <label for="name" class="form-label mb-3"> {{ __('church/member.gender') }} <span class="text-danger">*</span></label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input primary check-outline outline-primary" type="radio"
                                    id="male" name="gender" value="1"
                                    @if(!old('gender') || old('gender') == 1) checked @endif>
                                <label class="form-check-label" for="male">{{ __('message.gender.0.name') }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input primary check-outline outline-primary" type="radio"
                                    id="female" name="gender" value="2"
                                    @if(old('gender') == 2) checked @endif>
                                <label class="form-check-label" for="female">{{ __('message.gender.1.name') }}</label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div>
                                <label for="marital_status" class="form-label"> {{ __('church/member.maritalStatus') }}<span
                                        class="text-danger">*</span></label>
                                <select name="marital_status" id="marital_status" class="form-select" required>
                                    <option value="" selected disabled> {{ __('church/member.select') }}</option>
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
                                <label for="datepicker-autoclose" class="form-label"> {{ __('church/member.dob') }} <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input name="dateOfBirth" type="text" class="form-control" autocomplete="off" id="datepicker-autoclose"
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
                            <label for="education" class="form-label"> {{ __('church/member.school') }} <span
                                    class="text-danger">*</span></label>
                            <select name="education" id="education" class="form-select" required>
                                <option value="" selected disabled> {{ __('church/member.select') }}</option>
                                @foreach(__('message.education') as $item)
                                <option {{ old('education') == $item['id'] ? 'selected' : '' }} value="{{ $item['id'] }}">
                                    {{ $item['name'] }}</option>
                                @endforeach
                            </select>
                            @error('education')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3">
                            <label for="disability" class="form-label"> {{ __('church/member.disability') }}</label>
                            <input type="text" class="form-control" name="disability" id="disability"
                                value="{{ old('disability') }}" placeholder="{{ __('church/member.disability') }}" autocomplete="off">
                            @error('disability')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3">
                            <label for="training" class="form-label"> {{ __('church/member.training') }}</label>
                            <input type="text" class="form-control" name="training" id="training"
                                value="{{ old('training') }}" placeholder=" {{ __('church/member.training') }}" autocomplete="off">
                                @error('training')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                        <div class="col-lg-3">
                            <label for="professional" class="form-label"> {{ __('church/member.professional') }}</label>
                            <input type="text" class="form-control" name="professional" id="professional"
                                value="{{ old('professional') }}" placeholder="{{ __('church/member.professional') }}" autocomplete="off">
                                @error('professional')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                        <div class="col-lg-3">
                            <label for="employer" class="form-label"> {{ __('church/member.employee') }}</label>
                            <input type="text" class="form-control" name="employer" id="employer"
                                value="{{ old('employer') }}" placeholder=" {{ __('church/member.employee') }}" autocomplete="off">
                                @error('employer')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="field" class="form-label">  {{ __('church/member.field') }}</label>
                            <select name="field[]" id="field" class="select2 form-select" multiple="multiple"
                                style="height: 36px; width: 100%" data-placeholder="{{ __('church/member.select') }}">
                                @foreach (__('message.fields') as $item)
                                <option @if(in_array($item['id'], old('field', []))) selected @endif value="{{ $item['id'] }}">
                                    {{ $item['name'] }}</option>
                                @endforeach
                            </select>
                            @error('field')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3">
                            <label for="insurance" class="form-label"> {{ __('church/member.insurance') }}<span
                                    class="text-danger">*</span></label>
                            <select name="insurance" class="form-select" style="height: 36px; width: 100%" required>
                                <option value="" selected disabled> {{ __('church/member.insurance') }}</option>
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
                            <label for="saving" class="form-label"> {{ __('church/member.saving') }}</label>
                            <select name="saving" class="form-select" style="height: 36px; width: 100%">
                                <option value="" selected disabled> {{ __('church/member.saving') }}</option>
                                @foreach (__('message.saving') as $item)
                                <option {{ old('saving') == $item['id'] ? 'selected' : '' }} value="{{ $item['id'] }}">
                                    {{ $item['name'] }}</option>
                                @endforeach
                            </select>
                            @error('saving')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="ministry" class="form-label"> {{ __('church/member.ministry') }}<span class="text-danger">*</span></label>
                            <select name="ministry[]" id="ministry" class="select2 form-select" multiple="multiple"
                                style="height: 36px; width: 100%" data-placeholder=" {{ __('church/member.pministry') }}" required>
                                @foreach (__('message.ministries') as $item)
                                <option @if(in_array($item['id'], old('ministry', []))) selected @endif
                                    value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            </select>
                            @error('ministry')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3">
                            <label for="relation" class="form-label"> {{ __('church/member.relation') }}<span class="text-danger">*</span></label>
                            <select name="relation" class="form-select" style="height: 36px; width: 100%" required>
                                <option value="" selected disabled> {{ __('church/member.relation') }}</option>
                                @foreach (__('message.relation') as $item)
                                <option {{ old('relation') == $item['id'] ? 'selected' : '' }}
                                    value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            </select>
                            @error('relation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3">
                            <label for="status" class="form-label">Status<span class="text-danger">*</span></label>
                            <select name="status" class="form-select" style="height: 36px; width: 100%" required>
                                <option value="" selected disabled>{{ __('church/member.select') }}</option>
                                @foreach (__('message.status') as $item)
                                <option {{ old('status') == $item['id'] ? 'selected' : '' }} value="{{ $item['id'] }}">
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
                            <button type="submit" class="btn btn-primary">{{ __('church/member.submit') }}</button>
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
