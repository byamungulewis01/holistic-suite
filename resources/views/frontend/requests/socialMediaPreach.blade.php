@extends('layouts.frontend.app')

@section('title','Preach on Social Media')
@section('css')
<link rel="stylesheet" href="{{ asset('dist/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/libs/select2/dist/css/select2.min.css') }}">
@endsection
@section('body')

<div id="note-full-container" class="note-has-grid row mb-3">
    <div class="col-md-6 single-note-item all-category">
        <div class="card card-body">
            <span class="side-stick"></span>
            <h5 class="note-title text-truncate w-75 mb-3" data-noteheading="Icyifuzo cyo gusengera">Gusaba Uruhushya rwo Kubwiriza Kuri Social Media
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
            <form action="{{ route('member.request.storeSocialMediaPreach') }}" method="POST">
                @csrf
                <div class="card-header">
                    <h5 class="card-title mb-0">Gusaba kubwiriza kuri Social Media</h5>
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
                    <div class="mb-3">
                        <label for="reg_number" class="form-label">Numero Y'Umukristo <span
                                class="text-danger">*</span></label>
                        <input type="text" disabled class="form-control number" minlength="9" maxlength="9"
                            name="reg_number" id="reg_number" placeholder="Enter Reg Number"
                            value="{{ auth()->guard('member')->user()->reg_no }}" required autocomplete="off" autofocus>
                        @error('reg_number')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="socialMedia" class="form-label">Social Medias<span class="text-danger">*</span></label>
                        @php
                            $socialMedias = ['Whatsapp','Youtube','Tweeter','Facebook','Instagram'
                            ]
                        @endphp
                        <select name="socialMedia[]" id="socialMedia" class="select2 form-select" multiple="multiple"
                            style="height: 36px; width: 100%" data-placeholder="Hitamo Social media" required>
                            @foreach ($socialMedias as $item)
                            <option @if(in_array($item, old('socialMedia', []))) selected @endif
                                value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                        @error('socialMedia')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-12">
                        <div>
                            <label for="exampleFormControlTextarea1" class="form-label"> Insanganyamatsiko<span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control" placeholder="Insanganyamatsiko" required
                                id="exampleFormControlTextarea1" name="motor" rows="3"></textarea>
                            @error('motor')
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
<script src="{{ asset('dist/libs/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('dist/libs/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('dist/js/forms/select2.init.js') }}"></script>

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
@endsection
