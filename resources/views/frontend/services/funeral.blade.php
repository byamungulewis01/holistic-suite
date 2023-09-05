@extends('layouts.frontend.app')

@section('title','Gusaba Gushyingura')
@section('css')
<link rel="stylesheet" href="{{ asset('dist/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection
@section('body')

<div id="note-full-container" class="note-has-grid row mb-3">
    <div class="col-md-6 single-note-item all-category">
        <div class="card card-body">
            <span class="side-stick"></span>
            <h5 class="note-title text-truncate w-75 mb-3" data-noteheading="Gusaba Gushyigura"> Gusaba Gushyigura
            </h5>
            <div class="note-content">
                <p class="note-inner-content">Iyi serivise ihabwa umuntu witabye Imana yari umunyetorero w'itorero ADEPR
                </p>
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
            <form action="{{ route('member.memberStep.storeFuneral') }}" method="POST">
                @csrf
                <div class="card-header">
                    <h5 class="card-title mb-0">Gusaba Gushyingura</h5>
                </div>
                <div class="card-body">
                    <div class="row g-4 mb-3">
                        <div class="col-lg-12">
                            <label for="reg_number" class="form-label">Numero Yuwitabye Imana <span class="text-danger">*</span></label>
                            <input type="text" class="form-control number" minlength="9" maxlength="9" name="reg_number" id="reg_number" placeholder="Enter Reg Number"
                                value="{{ old('reg_number') }}" required autocomplete="off" autofocus>
                            @error('reg_number')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-6">
                            <div>
                                <label for="datepicker-autoclose" class="form-label">Itariki yitabiyeho Imana <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input name="dateOfDeath" type="text" class="form-control" id="datepicker-autoclose" autocomplete="off"
                                        required value="{{ old('dateOfDeath') }}" placeholder="mm/dd/yyyy" />

                                    <span class="input-group-text">
                                        <i class="ti ti-calendar fs-5"></i>
                                    </span>
                                </div>
                                @error('dateOfDeath')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="datepicker-autoclose" class="form-label">Igihe cyo Gushyingura<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input name="dateOfFuneral" type="text" class="form-control" id="datepicker-autoclose1" autocomplete="off"
                                        required value="{{ old('dateOfFuneral') }}" placeholder="mm/dd/yyyy" />

                                    <span class="input-group-text">
                                        <i class="ti ti-calendar fs-5"></i>
                                    </span>
                                </div>
                                @error('dateOfFuneral')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div>
                                <label for="exampleFormControlTextarea1" class="form-label"> Icyahitanye Nyakwigendera  <span class="text-danger">*</span></label>
                                <textarea class="form-control" placeholder="Mumagambo Make icyahitanye Umukristo" id="exampleFormControlTextarea1" name="deathCourse" rows="3"></textarea>
                                @error('deathCourse')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12 mt-3">
                            <div class="hstack justify-content-end gap-2">
                                <button type="submit" class="btn btn-primary">Saba</button>
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

</script>
@endsection
