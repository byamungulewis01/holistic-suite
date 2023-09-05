@extends('layouts.frontend.app')

@section('title','Icyemezo cyo Kwimuka')
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
            <form action="{{ route('member.recommandation.storeTransfer') }}" method="POST">
                @csrf
                <div class="card-header">
                    <h5 class="card-title mb-0">Icyifuzo cyo gusengera</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="hstack p-2 border rounded mb-3 mb-md-0">
                                <div class="ms-0">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input primary cursor-pointer" checked type="radio" name="requestedBy"
                                            id="radio1" value="1">
                                        <label class="form-check-label cursor-pointer" for="radio1">Ninjye Wisabira</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="hstack p-2 border rounded mb-3 mb-md-0">
                                <div class="ms-0">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input primary cursor-pointer" type="radio" name="requestedBy"
                                            id="radio2" value="2">
                                        <label class="form-check-label cursor-pointer" for="radio2">Gusabira undi</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
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
                        <div class="col-md-6">
                            <label for="region" class="form-label">{{ __('message.region') }}<span
                                    class="text-danger">*</span></label>
                            <select class="form-select" name="region" style="width: 100%; height: 36px" required>
                                <option>Select</option>
                                @foreach ($regions as $item)
                                <option value="{{ $item->reg_number }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('region')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="message-text" class="control-label">Parish:</label>
                            <select class="form-select" name="parish" style="width: 100%; height: 36px" required>

                            </select>
                            @error('parish')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- local Church --}}
                        <div class="col-md-6">
                            <label for="message-text" class="control-label">Local Church:</label>
                            <select class="form-select" name="local_church" style="width: 100%; height: 36px" required>

                            </select>
                            @error('local_church')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        {{-- description --}}
                        <label for="message-text" class="control-label">Reason:</label>
                        <textarea rows="3" class="form-control" name="reason" id="message-text"
                            placeholder="Reason"></textarea>
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
<script>
    $(document).ready(function () {
        $('select[name="region"]').on('change', function () {
            var parishID = $(this).val();
            var url = '{{ route("office.getParishes", ":id") }}';
            if (parishID) {
                $.ajax({
                    url: url.replace(':id', parishID),
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="parish"]').empty();
                        $('select[name="local_church"]').empty();

                        $('select[name="parish"]').append(
                            '<option value="">Select</option>');
                        $.each(data, function (key, value) {
                            $('select[name="parish"]').append('<option value="' +
                                value.reg_number + '">' + value.name +
                                '</option>');
                        });
                    }
                });
            } else {
                $('select[name="parish"]').empty();
            }
        });
        $('select[name="parish"]').on('change', function () {
            var churchID = $(this).val();
            var url = '{{ route("office.getChurches", ":id") }}';
            if (churchID) {
                $.ajax({
                    url: url.replace(':id', churchID),
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="local_church"]').empty();
                        $('select[name="local_church"]').append(
                            '<option value="">Select</option>');
                        $.each(data, function (key, value) {
                            $('select[name="local_church"]').append(
                                '<option value="' +
                                value.reg_number + '">' + value.name +
                                '</option>');
                        });
                    }
                });
            } else {
                $('select[name="local_church"]').empty();
            }
        });

    });

</script>
@endsection