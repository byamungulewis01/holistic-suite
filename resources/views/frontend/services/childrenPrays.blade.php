@extends('layouts.frontend.app')

@section('title','WeddingProject')
@section('css')
<link rel="stylesheet" href="{{ asset('dist/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection
@section('body')

<div id="note-full-container" class="note-has-grid row mb-3">
    <div class="col-md-6 single-note-item all-category">
        <div class="card card-body">
            <span class="side-stick"></span>
            <h5 class="note-title text-truncate w-75 mb-3" data-noteheading="Kurambura Ibiganza Kumwana">Kurambura
                Ibiganza Kumwana </h5>
            <div class="note-content">
                <p class="note-inner-content"
                    data-notecontent="Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.">Umwana
                    uramburwaho ibiganza ni umaze ibyumweru bibiri avutse kandi ababyeyi bombi cyangwa umwe akaba ari
                    umunyetorero w'Itorero ADEPR </p>

                <ul class="list-unstyled mb-0">
                    <li class="d-flex align-items-center gap-1 mb-2">
                        <span class="fs-4">
                            <i class="ti ti-briefcase text-dark fs-6"></i> Iyi Service Itangwa :
                        </span>
                        <h6 class="fs-4 fw-semibold mb-0">Iminsi 30</h6>
                    </li>
                    <li class="d-flex align-items-center gap-1 mb-2">
                        <span class="fs-4">
                            <i class="ti ti-briefcase text-dark fs-6"></i> Amafaranga y'Ifishi :
                        </span>
                        <h6 class="fs-4 fw-semibold mb-0">1000 Frw</h6>
                    </li>

                </ul>
            </div>

        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <form action="{{ route('member.memberStep.storeChildrenPrays') }}" method="POST">
                @csrf
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __('church/children.title') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row g-4 mb-3">
                        <div class="col-lg-7">
                            <label for="name" class="form-label">{{ __('church/member.name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Names"
                                value="{{ old('name') }}" required autocomplete="off" autofocus>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-5">
                            <label for="gender" class="form-label mb-3">{{ __('church/member.gender') }}  <span class="text-danger">*</span></label>
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
                        <div class="col-lg-6">
                            <div>
                                <label for="fatherName" class="form-label">{{ __('church/children.father') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="fatherName" id="fatherName" value="{{ old('fatherName') }}" placeholder="{{ __('church/children.father') }}"
                                    autocomplete="off">
                                    @error('fatherName')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="motherName" class="form-label">{{ __('church/children.mother') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="motherName" id="motherName"
                                    placeholder="{{ __('church/children.mother') }}" value="{{ old('motherName') }}" autocomplete="off">
                                    @error('motherName')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="parentPhone" class="form-label">{{ __('church/children.parentPhone') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control number" name="parentPhone" id="parentPhone"
                                minlength="10" maxlength="10" value="{{ old('parentPhone') }}"
                                placeholder="{{ __('church/children.parentPhone') }}" autocomplete="off">
                                @error('parentPhone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="datepicker-autoclose" class="form-label">{{ __('church/member.dob') }}  <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input name="dateOfBirth" type="text" class="form-control" id="datepicker-autoclose" autocomplete="off"
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
                        <div class="col-lg-12 mt-3">
                            <div class="hstack justify-content-end gap-2">
                                <button type="submit" class="btn btn-primary">{{ __('church/member.submit') }}</button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('dist/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    jQuery("#datepicker-autoclose").datepicker({
        autoclose: true,
        todayHighlight: true,
        endDate: '0d',
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
@endsection
