@extends('layouts.frontend.app')

@section('title','Home')
@section('body')

<div id="note-full-container" class="note-has-grid row mb-3">
    <h3 class="text-muted mb-3">IMIHANGO YERA Y'ITORERO ADEPR</h3>
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
            <div class="d-flex align-items-center">

                <div class="ms-auto">
                    <a href="{{ route('member.memberStep.childrenPrays') }}" class="btn btn-sm btn-primary">Saba</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 single-note-item all-category note-important">
        <div class="card card-body">
            <span class="side-stick"></span>
            <h5 class="note-title text-truncate w-75 mb-3" data-noteheading="Gusaba Gutangiza Umushinga w'Ubukwe">Gusaba
                Gutangiza Umushinga w'Ubukwe</h5>
            <div class="note-content">
                <p class="note-inner-content">
                    Umusore n'inkumi batangiza umushinga w'ubukwe bangomba kuba bombi cyangwa umwe ari Umunyetorero
                    w'Itorero ADEPR .
                </p>

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
            <div class="d-flex align-items-center">

                <div class="ms-auto">
                    <a href="{{ route('member.memberStep.weddingProject') }}" class="btn btn-sm btn-primary">Saba</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 single-note-item all-category note-social">
        <div class="card card-body">
            <span class="side-stick"></span>
            <h5 class="note-title text-truncate w-75 mb-3" data-noteheading="Gusaba Gushyigura"> Gusaba Gushyingura
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
            <div class="d-flex align-items-center">

                <div class="ms-auto">
                    <a href="{{ route('member.memberStep.funeral') }}" class="btn btn-sm btn-primary">Saba</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 single-note-item all-category note-business">
        <div class="card card-body">
            <span class="side-stick"></span>
            <h5 class="note-title text-truncate w-75 mb-3" data-noteheading="Gusaba Igaburo ryera mu rugo">Igaburo ryera
                mu rugo</h5>
            <div class="note-content">
                <p class="note-inner-content" data-notecontent="Gusaba gutangiza umushinga w'Ubukwe.">Gusaba Igaburo
                    ryera Uri Murugo Mugihe Ufite Impamvu Idatuma Uterana nabandi . </p>

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
            <div class="d-flex align-items-center">
                <div class="ms-auto">
                    <a href="{{ route('member.memberStep.holyCommunion') }}" class="btn btn-sm btn-primary">Saba</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 single-note-item all-category note-social">
        <div class="card card-body">
            <span class="side-stick"></span>
            <h5 class="note-title text-truncate w-75 mb-3" data-noteheading="Icyifuzo cyo gusengera">Icyifuzo cyo
                gusengera</h6>
                <div class="note-content">
                    <p class="note-inner-content">Gusaba amasangesho/Gutanga ikifuzo cyo gusengera Mumateraniro
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
                <div class="d-flex align-items-center">

                    <div class="ms-auto">
                        <a href="{{ route('member.memberStep.prayerRequest') }}" class="btn btn-sm btn-primary">Saba</a>
                    </div>
                </div>
        </div>
    </div>
</div>
<div id="note-full-container" class="note-has-grid row mb-3">
    <h3 class="text-muted mb-3">IBYEMEZO /RECOMMANDATION</h3>
    <div class="col-md-12 single-note-item all-category">
        <div class="card card-body">
            <span class="side-stick"></span>
            <div class="note-content">
                <div class="row">
                    <div class="col-md-4">
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex align-items-center gap-1 mb-2">
                                <a class="text-decoration-none"
                                    href="{{ route('member.recommandation.transfer') }}">Icyemezo cyo Kwimuka</a>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-2">
                                <a class="text-decoration-none"
                                    href="{{ route('member.recommandation.guterana') }}">Icyemezo cyo Guterana</a>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-2">
                                <a class="text-decoration-none"
                                    href="{{ route('member.recommandation.gusabaAkazi') }}">Icyemezo cyo Gusaba
                                    akazi</a>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-2">
                                <a class="text-decoration-none" href="{{ route('member.request.suggestion') }}">Gutanga
                                    Igitekerezo,Ikifuzo cyangwa Ikibazo</a>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-2">
                                <a class="text-decoration-none"
                                    href="{{ route('member.request.praiseRequest') }}">Gusaba umwanya wo gushima Imana
                                    mu Iteraniro</a>
                            </li>

                        </ul>
                    </div>
                    <div class="col-md-8">
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex align-items-center gap-1 mb-2">
                                <a class="text-decoration-none"
                                    href="{{ route('member.request.preachRequest') }}">Gusaba uruhushya rwo kujya
                                    kubwiriza</a>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-2">
                                <a class="text-decoration-none"
                                    href="{{ route('member.request.socialMediaPreach') }}">Gusaba uruhushya rwo
                                    kubwiriza kuri social
                                    media</a>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-2">
                                <a class="text-decoration-none" href="{{ route('member.request.choirMove') }}">Gusabira
                                    korali uruhushya rwo gusohoka</a>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-2">
                                <a class="text-decoration-none"
                                    href="{{ route('member.request.leaderMeetRequest') }}">Gusaba umwanya wo guhura
                                    n'Umushumba wa
                                    Paruwase, Ururembo cyangwa Umushumba Mukururu</a>
                            </li>

                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- <div class="modal fade" id="vertical-center-modal" tabindex="-1" aria-labelledby="vertical-center-modal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Vertically centered Modal
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4>Overflowing text to show scroll behavior</h4>
                <p>
                    Praesent commodo cursus magna, vel scelerisque
                    nisl consectetur et. Vivamus sagittis lacus vel
                    augue laoreet rutrum faucibus dolor auctor.
                </p>
                <p>
                    Aenean lacinia bibendum nulla sed consectetur.
                    Praesent commodo cursus magna, vel scelerisque
                    nisl consectetur et. Donec sed odio dui. Donec
                    ullamcorper nulla non metus auctor fringilla.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-danger text-danger font-medium waves-effect text-start"
                    data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div> --}}
@endsection
