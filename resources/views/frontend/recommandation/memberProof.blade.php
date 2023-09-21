@extends('layouts.frontend.app')

@section('title','Gusaba Guterana')
@section('css')
<link rel="stylesheet" href="{{ asset('dist/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection
@section('body')

<div id="note-full-container" class="note-has-grid row mb-3">
    <div class="col-md-6 single-note-item all-category">
        <div class="card card-body">
            <span class="side-stick"></span>
            <h5 class="note-title text-truncate w-75 mb-3" data-noteheading="Icyifuzo cyo gusengera">Icyifuzo cyo
                gusengera
            </h5>
            <div class="note-content">
                <p class="note-inner-content" data-notecontent="Gusaba gutangiza umushinga w'Ubukwe.">
                    Gusaba amasangesho/Gutanga ikifuzo cyo gusengera Mumateraniro
                    Bakagusengera </p>

                <ul class="list-unstyled mb-0">
                    <li class="d-flex align-items-center gap-1 mb-2">
                        <span class="fs-4">
                            <i class="ti ti-briefcase text-dark fs-6"></i> Iyi Service Itangwa :
                        </span>
                        <h6 class="fs-4 fw-semibold mb-0">Akokanya</h6>
                    </li>
                    <li class="d-flex align-items-center gap-1 mb-2">
                        <span class="fs-4">
                            <i class="ti ti-briefcase text-dark fs-6"></i> Amafaranga y'Ifishi :
                        </span>
                        <h6 class="fs-4 fw-semibold mb-0">0 Frw</h6>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <form action="{{ route('member.recommandation.storeMemberProof') }}" method="POST">
                @csrf
                <div class="card-header">
                    <h5 class="card-title mb-0">Icyangobwa cy'Umukristo</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="hstack p-2 border rounded mb-3 mb-md-0">
                                <div class="ms-0">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input primary" checked type="radio" name="requestedBy"
                                            id="radio1" value="1">
                                        <label class="form-check-label" for="radio1">Ninjye Wisabira</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="hstack p-2 border rounded mb-3 mb-md-0">
                                <div class="ms-0">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input primary" type="radio" name="requestedBy"
                                            id="radio2" value="2">
                                        <label class="form-check-label" for="radio2">Gusabira undi</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="reg_number" class="form-label">Numero Y'Umukristo <span
                                    class="text-danger">*</span></label>
                            <input type="text" disabled class="form-control number" minlength="9" maxlength="9"
                                name="reg_number" id="reg_number" placeholder="Enter Reg Number"
                                value="{{ auth()->guard('member')->user()->reg_no }}" required autocomplete="off"
                                autofocus>
                            @error('reg_number')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="region" class="form-label mb-2">{{ __('message.region') }}<span
                                    class="text-danger">*</span></label>
                            <select class="form-select" name="region" style="width: 100%; height: 36px" required>
                                <option selected disabled>Select</option>
                                @foreach ($regions as $item)
                                <option {{ old('region')==$item->reg_number ? 'selected' : '' }} value="{{
                                    $item->reg_number }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('region')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="message-text" class="control-label mb-2">Parish:</label>
                            <select class="form-select" name="parish" style="width: 100%; height: 36px" required>
                                @if (old('parish'))
                                <option selected value="{{ old('parish') }}">{{
                                    \App\Models\Office::where('reg_number',
                                    old('parish'))->first()->name }}</option>
                                @endif
                            </select>
                            @error('parish')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- local Church --}}
                        <div class="col-md-6">
                            <label for="message-text" class="control-label mb-2">Local Church:</label>
                            <select class="form-select" name="local_church" style="width: 100%; height: 36px" required>
                                @if (old('local_church'))
                                <option selected value="{{ old('local_church') }}">{{
                                    \App\Models\Office::where('reg_number',
                                    old('local_church'))->first()->name }}</option>
                                @endif
                            </select>
                            @error('local_church')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <div class="hstack justify-content-start gap-2">
                            <button type="submit" class="btn btn-primary">Saba</button>
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
    jQuery("#datepicker-autoclose1").datepicker({
        autoclose: true,
        todayHighlight: true,
        startDate: '0d',
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
    $(document).ready(function () {
        var reg_number = "{{ auth()->guard('member')->user()->reg_no }}";
      $('#radio1').on('click', function () {
        $('input[name="reg_number"]').prop('disabled', true);
        $('input[name="reg_number"]').prop('value', reg_number);
      });
      $('#radio2').on('click', function () {
        $('input[name="reg_number"]').prop('disabled', false);
        $('input[name="reg_number"]').prop('value', '');
      });
    });

</script>
@include('frontend.officesAjaxCall')
@endsection
