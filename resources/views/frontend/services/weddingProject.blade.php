@extends('layouts.frontend.app')

@section('title','Wedding Project')
@section('css')
<link rel="stylesheet" href="{{ asset('dist/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection
@section('body')

<div id="note-full-container" class="note-has-grid row mb-3">
    <div class="col-md-6 single-note-item all-category">
        <div class="card card-body">
            <span class="side-stick"></span>
            <h5 class="note-title text-truncate w-75 mb-3" data-noteheading="Gusaba
            Gutangiza Umushinga w'Ubukwe">Gusaba
                Gutangiza Umushinga w'Ubukwe </h5>
            <div class="note-content">
                <p class="note-inner-content"
                    data-notecontent="Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.">Umwana
                    Umusore n'inkumi batangiza umushinga w'ubukwe bangomba kuba bombi cyangwa umwe ari Umunyetorero
                    w'Itorero ADEPR . </p>

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
            <div class="card-body">
                <form id="multi-step-form" method="post" action="{{ route('member.memberStep.storeWeddingProject') }}"
                    enctype="multipart/form-data">
                    <!-- Step 1: First Page -->
                    @csrf
                    <div class="step" id="step-1">
                        <div class="row mb-3">
                            <label for="reg_number" class="form-label">Umunyamuryango Mwitorero<span
                                    class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <div class="hstack p-2 border rounded mb-3 mb-md-0">
                                    <div class="ms-0">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input primary cursor-pointer" checked type="radio"
                                                name="type" id="radio1" value="1">
                                            <label class="form-check-label cursor-pointer" for="radio1">Bombi</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="hstack p-2 border rounded mb-3 mb-md-0">
                                    <div class="ms-0">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input primary cursor-pointer" type="radio"
                                                name="type" id="radio2" value="2">
                                            <label class="form-check-label cursor-pointer" for="radio2">Umwe
                                                Muribo</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3" id="bothMember">
                            <div class="col-lg-6 ">
                                <div class="mb-3">
                                    <label for="boyReg_no" class="form-label">Umusore <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control number" minlength="9" maxlength="9"
                                        name="boyReg_no" id="boyReg_no" placeholder="Reg Number z'Umusore"
                                        value="{{ old('boyReg_no') }}" autocomplete="off">
                                    @error('boyReg_no')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="boy_father_name" class="form-label">Amazina Ya se <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="boy_father_name" value="{{ old('boy_father_name') }}"
                                        placeholder="Andika Amazina" id="boy_father_name" class="form-control"
                                        autocomplete="off">
                                    @error('boy_father_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="boy_mother_name" class="form-label">Amazina ya Nyina <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="boy_mother_name" value="{{ old('boy_mother_name') }}"
                                        placeholder="Andika Amazina" id="boy_mother_name" class="form-control"
                                        autocomplete="off">
                                    @error('boy_mother_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="girlReg_no" class="form-label">Umukobwa <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control number" minlength="9" maxlength="9"
                                        name="girlReg_no" value="{{ old('girlReg_no') }}" id="girlReg_no"
                                        placeholder="Reg Number z'umukobwa" value="{{ old('girlReg_no') }}"
                                        autocomplete="off">
                                    @error('girlReg_no')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="girl_father_name" class="form-label">Amazina Ya se <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="girl_father_name" value="{{ old('girl_father_name') }}"
                                        placeholder="Andika Amazina" id="girl_father_name" class="form-control"
                                        autocomplete="off">
                                    @error('girl_father_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="girl_mother_name" class="form-label">Amazina ya Nyina <span
                                            class="text-danger">*</span></label>
                                    <input type="text" value="{{ old('girl_mother_name') }}" name="girl_mother_name"
                                        placeholder="Andika Amazina" id="girl_mother_name" class="form-control"
                                        autocomplete="off">
                                    @error('girl_mother_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2" id="oneMember" style="display: none;">
                            <div class="col-lg-6 ">
                                <div class="mb-3">
                                    <label for="whoIsMember" class="form-label mb-3">Umunyamuryango Ni?</label>
                                    <br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input primary check-outline outline-primary cursor-pointer"
                                            type="radio" id="umusore" name="whoIsMember" value="umusore"
                                            @if(!old('whoIsMember') || old('whoIsMember')=='umusore' ) checked @endif>
                                        <label class="form-check-label cursor-pointer" for="umusore">Umusore</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input primary check-outline outline-primary cursor-pointer"
                                            type="radio" id="umukobwa" name="whoIsMember" value="umukobwa"
                                            @if(old('whoIsMember')=='umukobwa' ) checked @endif>
                                        <label class="form-check-label cursor-pointer" for="umukobwa">Umukobwa</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="reg_number" class="form-label">Reg Number <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control number" minlength="9" maxlength="9"
                                        name="reg_number" id="reg_number" placeholder="Enter Reg Number"
                                        value="{{ old('reg_number') }}" autocomplete="off">
                                    @error('reg_number')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="father_name" class="form-label">Amazina Ya se <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ old('father_name') }}"
                                        id="father_name" name="father_name" autocomplete="off" placeholder="Amazina">
                                    @error('father_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="mother_name" class="form-label">Amazina ya Nyina <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ old('mother_name') }}"
                                        id="mother_name" name="mother_name" autocomplete="off" placeholder="Amazina">
                                    @error('mother_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label for="name" class="form-label">Amazina <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ old('name') }}" name="name"
                                        id="name" placeholder="Amazina Yose" autocomplete="off">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control number" value="{{ old('phone') }}" minlength="10"
                                        maxlength="10" name="phone" id="phone" placeholder="Enter Phone Number"
                                        autocomplete="off">
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="fatherName" class="form-label">Amazina Yase <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ old('fatherName') }}"
                                        id="fatherName" name="fatherName" placeholder="Amazina" autocomplete="off">
                                    @error('fatherName')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="motherName" class="form-label">Amazina ya Nyina <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="motherName"
                                        value="{{ old('motherName') }}" name="motherName" placeholder="Amazina"
                                        autocomplete="off">
                                    @error('motherName')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="form-label">Aho Yarasanzwe Asengera <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <label for="religion">Idini<span class="text-danger">*</span></label>
                                    <select name="religion" class="form-select" style="height: 36px; width: 100%">
                                        <option value="" selected disabled>Select</option>
                                        @foreach (__('message.religions') as $item)
                                        <option {{ old('religion')==$item['id'] ? 'selected' : '' }}
                                            value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="certificate">Certificate <span class="text-danger">*</span></label>
                                    <input accept=".png,.jpg,.pdf" type="file" class="form-control" name="certificate" id="certificate" autocomplete="off">
                                    @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary next-step" type="button">Next</button>
                    </div>

                    <!-- Step 2: Second Page -->
                    <div class="step" id="step-2">
                        <h2 class="mb-3">Certificates</h2>
                        <div class="row mb-3">
                            <div class="col-lg-6 ">
                                <label class="form-label text-primary">UMUSORE </label>
                                <div class="mb-3">
                                    <label for="boy_certificate1">Irangamuntu <span class="text-danger">*</span></label>
                                    <input accept=".png,.jpg,.pdf" type="file" name="boy_certificate1" class="form-control">
                                    @error('boy_certificate1')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="boy_certificate2" class="form-label">Icyangobwa cya SIDA <span
                                            class="text-danger">*</span></label>
                                    <input accept=".png,.jpg,.pdf" type="file" name="boy_certificate2" class="form-control">
                                    @error('boy_certificate2')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="boy_certificate3" class="form-label">Attestation de Ceribate
                                        <span class="text-danger">*</span></label>
                                    <input accept=".png,.jpg,.pdf" type="file" name="boy_certificate3" class="form-control">
                                    @error('boy_certificate3')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 ">
                                <label class="form-label text-primary">UMUKOBWA </label>
                                <div class="mb-3">
                                    <label for="girl_certificate1">Irangamuntu <span class="text-danger">*</span></label>
                                    <input accept=".png,.jpg,.pdf" type="file" name="girl_certificate1" class="form-control">
                                    @error('girl_certificate1')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="girl_certificate2" class="form-label">Icyangobwa cya SIDA <span
                                            class="text-danger">*</span></label>
                                    <input accept=".png,.jpg,.pdf" type="file" name="girl_certificate2" class="form-control">
                                    @error('girl_certificate2')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="girl_certificate3" class="form-label">Attestation de Ceribate
                                        <span class="text-danger">*</span></label>
                                    <input accept=".png,.jpg,.pdf" type="file" class="form-control" name="girl_certificate3">
                                    @error('girl_certificate3')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <button class="btn btn-secondary prev-step" type="button">Previous</button>
                        <button class="btn btn-primary next-step" type="button">Next</button>
                    </div>

                    <!-- Step 3: Third Page -->
                    <div class="step" id="step-3">
                        <div class="row mb-3">
                            <label class="form-label text-primary">AMAKURU Y'UBUKWE </label>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="region" class="form-label mb-2">{{ __('message.region') }}<span
                                        class="text-danger">*</span></label>
                                <select class="form-select" name="region" style="width: 100%; height: 36px">
                                    <option>Select</option>
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
                                <select class="form-select" name="parish" style="width: 100%; height: 36px">
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
                                <select class="form-select" name="local_church" style="width: 100%; height: 36px">
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
                        <div class="col-md-12 mb-3">
                            <label for="datepicker-autoclose" class="form-label">Proposed Date <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input readonly name="proposedDate" type="text" class="form-control" id="datepicker-autoclose"
                                    value="{{ old('proposedDate') }}" autocomplete="off" placeholder="mm/dd/yyyy" />

                                <span class="input-group-text">
                                    <i class="ti ti-calendar fs-5"></i>
                                </span>
                            </div>
                            @error('proposedDate')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button class="btn btn-secondary prev-step" type="button">Previous</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('dist/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    $(document).ready(function () {
        var currentStep = 1;
        var totalSteps = $('.step').length;

        // Hide all steps except the first one
        $('.step').not(':first').hide();

        // Next button click event
        $('.next-step').on('click', function () {
            if (currentStep < totalSteps) {
                $('#step-' + currentStep).hide();
                currentStep++;
                $('#step-' + currentStep).show();
            }
        });

        // Previous button click event
        $('.prev-step').on('click', function () {
            if (currentStep > 1) {
                $('#step-' + currentStep).hide();
                currentStep--;
                $('#step-' + currentStep).show();
            }
        });
    });
</script>
<script>
    jQuery("#datepicker-autoclose").datepicker({
        autoclose: true,
        todayHighlight: true,
        startDate: '+6m',
    });
</script>

<script>
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
      $('#radio1').on('click', function () {
        $('#oneMember').hide()
        $('#bothMember').show()
    });
    $('#radio2').on('click', function () {
        $('#bothMember').hide()
        $('#oneMember').show()
      });
    });

</script>
@include('frontend.officesAjaxCall')
@endsection
