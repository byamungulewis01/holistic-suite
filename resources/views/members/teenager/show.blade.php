@extends('layouts.app')
@section('title', 'Profile')
@section('css')
<link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection
@section('body')
<div class="container-fluid">
    <div class="card overflow-hidden">
      <div class="card-body p-0">
        <div class="row align-items-center">
          <div class="col-lg-4 order-lg-1 order-2">
            <div class="d-flex align-items-center m-4">
              <div class="text-center">
                {{-- <h4 class="mb-0 fw-semibold lh-1 text-primary">REG: {{ $member->reg_no }}</h4> --}}
              </div>
            </div>
          </div>
        </div>
        <ul class="nav nav-pills user-profile-tab justify-content-end mt-2 bg-light-info rounded-2" id="pills-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6 active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="true">
              <i class="ti ti-user-circle me-2 fs-6"></i>
              <span class="d-none d-md-block">Profile</span>
            </button>
          </li>

        </ul>
      </div>
    </div>
    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade active show" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
        <div class="row">
          <div class="col-lg-5">
            <div class="card shadow-none border">
              <div class="card-body">
                <h4 class="fw-semibold mb-3 text-info">Introduction</h4>
                <ul class="list-unstyled mb-0">
                  <li class="d-flex align-items-center gap-3 mb-4">
                    <i class="ti ti-briefcase text-dark fs-6"></i>
                    <h6 class="fs-4 mb-0">{{ $member->name }}</h6>
                  </li>
                  <li class="d-flex align-items-center gap-3 mb-4">
                    <i class="ti ti-mail text-dark fs-6"></i>
                    <h6 class="fs-4 mb-0">{{ $member->email == null ? 'N/A' : $member->email }}</h6>
                  </li>
                  <li class="d-flex align-items-center gap-3 mb-4">
                    <i class="ti ti-phone text-dark fs-6"></i>
                    <h6 class="fs-4 mb-0">{{ $member->phone == null ? 'N/A' : $member->phone }}</h6>
                  </li>
                  <li class="d-flex align-items-center gap-3 mb-4">
                    <i class="ti ti-calendar text-dark fs-6"></i>
                    <h6 class="fs-4 mb-0">{{ $member->dateOfBirth }}</h6>
                  </li>
                  <li class="d-flex align-items-center gap-3 mb-2">
                    <i class="ti ti-map-pin text-dark fs-6"></i>
                    <h6 class="fs-4 mb-0">{{ $member->sector }}, {{ $member->cell }} , {{ $member->village }}</h6>
                  </li>
                </ul>
              </div>
            </div>
            {{-- <div class="card shadow-none border">
              <div class="card-body">
                <h4 class="fw-semibold mb-3">Photos</h4>
                <div class="row">
                  <div class="col-4">
                    <img src="../../dist/images/profile/user-1.jpg" alt="" class="rounded-2 img-fluid mb-9">
                  </div>
                  <div class="col-4">
                    <img src="../../dist/images/profile/user-2.jpg" alt="" class="rounded-2 img-fluid mb-9">
                  </div>
                  <div class="col-4">
                    <img src="../../dist/images/profile/user-3.jpg" alt="" class="rounded-2 img-fluid mb-9">
                  </div>
                  <div class="col-4">
                    <img src="../../dist/images/profile/user-4.jpg" alt="" class="rounded-2 img-fluid mb-9">
                  </div>
                  <div class="col-4">
                    <img src="../../dist/images/profile/user-5.jpg" alt="" class="rounded-2 img-fluid mb-9">
                  </div>
                  <div class="col-4">
                    <img src="../../dist/images/profile/user-6.jpg" alt="" class="rounded-2 img-fluid mb-9">
                  </div>
                  <div class="col-4">
                    <img src="../../dist/images/profile/user-7.jpg" alt="" class="rounded-2 img-fluid mb-6">
                  </div>
                  <div class="col-4">
                    <img src="../../dist/images/profile/user-8.jpg" alt="" class="rounded-2 img-fluid mb-6">
                  </div>
                  <div class="col-4">
                    <img src="../../dist/images/profile/user-1.jpg" alt="" class="rounded-2 img-fluid mb-6">
                  </div>
                </div>
              </div>
            </div> --}}
          </div>
          {{-- <div class="col-lg-7">
            <div class="card shadow-none border">
              <div class="card-body">
                <div class="form-floating mb-3">
                  <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 137px"></textarea>
                  <label for="floatingTextarea2" class="p-7">Share your thoughts</label>
                </div>
                <div class="d-flex align-items-center gap-2">
                  <a class="text-white d-flex align-items-center justify-content-center bg-primary p-2 fs-4 rounded-circle" href="javascript:void(0)">
                    <i class="ti ti-photo"></i>
                  </a>
                  <a href="javascript:void(0)" class="text-dark px-3 py-2">Photo / Video</a>
                  <a href="javascript:void(0)" class="d-flex align-items-center gap-2">
                    <div class="text-white d-flex align-items-center justify-content-center bg-secondary p-2 fs-4 rounded-circle">
                      <i class="ti ti-notebook"></i>
                    </div>
                    <span class="text-dark">Article</span>
                  </a>
                  <button class="btn btn-primary ms-auto">Post</button>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body border-bottom">
                <div class="d-flex align-items-center gap-3">
                  <img src="../../dist/images/profile/user-1.jpg" alt="" class="rounded-circle" width="40" height="40">
                  <h6 class="fw-semibold mb-0 fs-4">Mathew Anderson</h6>
                  <span class="fs-2"><span class="p-1 bg-light rounded-circle d-inline-block"></span> 15 min ago</span>
                </div>
                <p class="text-dark my-3">
                  Nu kek vuzkibsu mooruno ejepogojo uzjon gag fa ezik disan he nah. Wij wo pevhij tumbug rohsa ahpi ujisapse lo vap labkez eddu suk.
                </p>
                <img src="../../dist/images/products/s1.jpg" alt="" class="img-fluid rounded-4 w-100 object-fit-cover" style="height: 360px;">
                <div class="d-flex align-items-center my-3">
                  <div class="d-flex align-items-center gap-2">
                    <a class="text-white d-flex align-items-center justify-content-center bg-primary p-2 fs-4 rounded-circle" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Like">
                      <i class="ti ti-thumb-up"></i>
                    </a>
                    <span class="text-dark fw-semibold">67</span>
                  </div>
                  <div class="d-flex align-items-center gap-2 ms-4">
                    <a class="text-white d-flex align-items-center justify-content-center bg-secondary p-2 fs-4 rounded-circle" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Comment">
                      <i class="ti ti-message-2"></i>
                    </a>
                    <span class="text-dark fw-semibold">2</span>
                  </div>
                  <a class="text-dark ms-auto d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Share">
                    <i class="ti ti-share"></i>
                  </a>
                </div>
                <div class="position-relative">
                  <div class="p-4 rounded-2 bg-light mb-3">
                    <div class="d-flex align-items-center gap-3">
                      <img src="../../dist/images/profile/user-3.jpg" alt="" class="rounded-circle" width="33" height="33">
                      <h6 class="fw-semibold mb-0 fs-4">Deran Mac</h6>
                      <span class="fs-2"><span class="p-1 bg-muted rounded-circle d-inline-block"></span> 8 min ago</span>
                    </div>
                    <p class="my-3">Lufo zizrap iwofapsuk pusar luc jodawbac zi op uvezojroj duwage vuhzoc ja vawdud le furhez siva
                      fikavu ineloh. Zot afokoge si mucuve hoikpaf adzuk zileuda falohfek zoije fuka udune lub annajor gazo
                      conis sufur gu.
                    </p>
                    <div class="d-flex align-items-center">
                      <div class="d-flex align-items-center gap-2">
                        <a class="text-white d-flex align-items-center justify-content-center bg-primary p-2 fs-4 rounded-circle" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Like">
                          <i class="ti ti-thumb-up"></i>
                        </a>
                        <span class="text-dark fw-semibold">55</span>
                      </div>
                      <div class="d-flex align-items-center gap-2 ms-4">
                        <a class="text-white d-flex align-items-center justify-content-center bg-secondary p-2 fs-4 rounded-circle" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Reply">
                          <i class="ti ti-arrow-back-up"></i>
                        </a>
                        <span class="text-dark fw-semibold">0</span>
                      </div>
                    </div>
                  </div>
                  <div class="p-4 rounded-2 bg-light mb-3">
                    <div class="d-flex align-items-center gap-3">
                      <img src="../../dist/images/profile/user-4.jpg" alt="" class="rounded-circle" width="33" height="33">
                      <h6 class="fw-semibold mb-0 fs-4">Jonathan Bg</h6>
                      <span class="fs-2"><span class="p-1 bg-muted rounded-circle d-inline-block"></span> 5 min ago</span>
                    </div>
                    <p class="my-3">
                      Zumankeg ba lah lew ipep tino tugjekoj hosih fazjid wotmila durmuri buf hi sigapolu joit ebmi joge vo.
                      Horemo vogo hat na ejednu sarta afaamraz zi cunidce peroido suvan podene igneve.
                    </p>
                    <div class="d-flex align-items-center">
                      <div class="d-flex align-items-center gap-2">
                        <a class="text-dark d-flex align-items-center justify-content-center bg-light-dark p-2 fs-4 rounded-circle" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Like">
                          <i class="ti ti-thumb-up"></i>
                        </a>
                        <span class="text-dark fw-semibold">68</span>
                      </div>
                      <div class="d-flex align-items-center gap-2 ms-4">
                        <a class="text-white d-flex align-items-center justify-content-center bg-secondary p-2 fs-4 rounded-circle" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Reply">
                          <i class="ti ti-arrow-back-up"></i>
                        </a>
                        <span class="text-dark fw-semibold">1</span>
                      </div>
                    </div>
                  </div>
                  <div class="p-4 rounded-2 bg-light ms-7">
                    <div class="d-flex align-items-center gap-3">
                      <img src="../../dist/images/profile/user-5.jpg" alt="" class="rounded-circle" width="40" height="40">
                      <h6 class="fw-semibold mb-0 fs-4">Carry minati</h6>
                      <span class="fs-2"><span class="p-1 bg-muted rounded-circle d-inline-block"></span> just now</span>
                    </div>
                    <p class="my-3">
                      Olte ni somvukab ugura ovaobeco hakgoc miha peztajo tawosu udbacas kismakin hi. Dej
                      zetfamu cevufi sokbid bud mun soimeuha pokahram vehurpar keecris pepab voegmud
                      zundafhef hej pe.
                    </p>
                  </div>
                </div>
              </div>
              <div class="d-flex align-items-center gap-3 p-3">
                <img src="../../dist/images/profile/user-1.jpg" alt="" class="rounded-circle" width="33" height="33">
                <input type="text" class="form-control py-8" id="exampleInputtext" aria-describedby="textHelp" placeholder="Comment">
                <button class="btn btn-primary">Comment</button>
              </div>
            </div>
            <div class="card">
              <div class="card-body border-bottom">
                <div class="d-flex align-items-center gap-3">
                  <img src="../../dist/images/profile/user-5.jpg" alt="" class="rounded-circle" width="40" height="40">
                  <h6 class="fw-semibold mb-0 fs-4">Carry Minati</h6>
                  <span class="fs-2"><span class="p-1 bg-light rounded-circle d-inline-block"></span> now</span>
                </div>
                <p class="text-dark my-3">
                  Pucnus taw set babu lasufot lawdebuw nem ig bopnub notavfe pe ranlu dijsan liwfekaj lo az. Dom giat gu
                  sehiosi bikelu lo eb uwrerej bih woppoawi wijdiola iknem hih suzega gojmev kir rigoj.
                </p>
                <div class="d-flex align-items-center">
                  <div class="d-flex align-items-center gap-2">
                    <a class="text-white d-flex align-items-center justify-content-center bg-primary p-2 fs-4 rounded-circle" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Like">
                      <i class="ti ti-thumb-up"></i>
                    </a>
                    <span class="text-dark fw-semibold">1</span>
                  </div>
                  <div class="d-flex align-items-center gap-2 ms-4">
                    <a class="text-white d-flex align-items-center justify-content-center bg-secondary p-2 fs-4 rounded-circle" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Comment">
                      <i class="ti ti-message-2"></i>
                    </a>
                    <span class="text-dark fw-semibold">0</span>
                  </div>
                  <a class="text-dark ms-auto d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Share">
                    <i class="ti ti-share"></i>
                  </a>
                </div>
              </div>
              <div class="d-flex align-items-center gap-3 p-3">
                <img src="../../dist/images/profile/user-5.jpg" alt="" class="rounded-circle" width="33" height="33">
                <input type="text" class="form-control py-8" id="exampleInputtext" aria-describedby="textHelp" placeholder="Comment">
                <button class="btn btn-primary">Comment</button>
              </div>
            </div>
            <div class="card">
              <div class="card-body border-bottom">
                <div class="d-flex align-items-center gap-3">
                  <img src="../../dist/images/profile/user-2.jpg" alt="" class="rounded-circle" width="40" height="40">
                  <h6 class="fw-semibold mb-0 fs-4">Genelia Desouza</h6>
                  <span class="fs-2"><span class="p-1 bg-light rounded-circle d-inline-block"></span> 15 min ago</span>
                </div>
                <p class="text-dark my-3">
                  Faco kiswuoti mucurvi juokomo fobgi aze huweik zazjofefa kuujer talmoc li niczot lohejbo vozev zi huto. Ju
                  tupma uwujate bevolkoh hob munuap lirec zak ja li hotlanu pigtunu.
                </p>
                <div class="row">
                  <div class="col-sm-6">
                    <img src="../../dist/images/products/s2.jpg" alt="" class="img-fluid rounded-4 mb-3 mb-sm-0">
                  </div>
                  <div class="col-sm-6">
                    <img src="../../dist/images/products/s4.jpg" alt="" class="img-fluid rounded-4">
                  </div>
                </div>
                <div class="d-flex align-items-center my-3">
                  <div class="d-flex align-items-center gap-2">
                    <a class="text-dark d-flex align-items-center justify-content-center bg-light p-2 fs-4 rounded-circle" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Like">
                      <i class="ti ti-thumb-up"></i>
                    </a>
                    <span class="text-dark fw-semibold">320</span>
                  </div>
                  <div class="d-flex align-items-center gap-2 ms-4">
                    <a class="text-white d-flex align-items-center justify-content-center bg-secondary p-2 fs-4 rounded-circle" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Comment">
                      <i class="ti ti-message-2"></i>
                    </a>
                    <span class="text-dark fw-semibold">1</span>
                  </div>
                  <a class="text-dark ms-auto d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Share">
                    <i class="ti ti-share"></i>
                  </a>
                </div>
                <div class="p-4 rounded-2 bg-light">
                  <div class="d-flex align-items-center gap-3">
                    <img src="../../dist/images/profile/user-3.jpg" alt="" class="rounded-circle" width="33" height="33">
                    <h6 class="fw-semibold mb-0 fs-4">Ritesh Deshmukh</h6>
                    <span class="fs-2"><span class="p-1 bg-muted rounded-circle d-inline-block"></span> 15 min ago</span>
                  </div>
                  <p class="my-3">
                    Hintib cojno riv ze heb cipcep fij wo tufinpu bephekdab infule pajnaji. Jiran goetimip muovo go en
                    gaga zeljomim hozlu lezuvi ehkapod dec bifoom hag dootasac odo luvgit ti ella.
                  </p>
                  <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center gap-2">
                      <a class="text-white d-flex align-items-center justify-content-center bg-primary p-2 fs-4 rounded-circle" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Like">
                        <i class="ti ti-thumb-up"></i>
                      </a>
                      <span class="text-dark fw-semibold">65</span>
                    </div>
                    <div class="d-flex align-items-center gap-2 ms-4">
                      <a class="text-white d-flex align-items-center justify-content-center bg-secondary p-2 fs-4 rounded-circle" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Reply">
                        <i class="ti ti-arrow-back-up"></i>
                      </a>
                      <span class="text-dark fw-semibold">0</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="d-flex align-items-center gap-3 p-3">
                <img src="../../dist/images/profile/user-2.jpg" alt="" class="rounded-circle" width="33" height="33">
                <input type="text" class="form-control py-8" id="exampleInputtext" aria-describedby="textHelp" placeholder="Comment">
                <button class="btn btn-primary">Comment</button>
              </div>
            </div>
            <div class="card">
              <div class="card-body border-bottom">
                <div class="d-flex align-items-center gap-3">
                  <img src="../../dist/images/profile/user-1.jpg" alt="" class="rounded-circle" width="40" height="40">
                  <h6 class="fw-semibold mb-0 fs-4">Mathew Anderson</h6>
                  <span class="fs-2"><span class="p-1 bg-light rounded-circle d-inline-block"></span> 15 min ago</span>
                </div>
                <p class="text-dark my-3">
                  Faco kiswuoti mucurvi juokomo fobgi aze huweik zazjofefa kuujer talmoc li niczot lohejbo vozev zi huto. Ju
                  tupma uwujate bevolkoh hob munuap lirec zak ja li hotlanu pigtunu.
                </p>
                <iframe class="rounded-4 border border-2 mb-3" src="https://www.youtube.com/embed/d1-FRj20WBE" frameborder="0" width="100%" style="height: 300px;"></iframe>
                <div class="d-flex align-items-center">
                  <div class="d-flex align-items-center gap-2">
                    <a class="text-white d-flex align-items-center justify-content-center bg-primary p-2 fs-4 rounded-circle" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Like">
                      <i class="ti ti-thumb-up"></i>
                    </a>
                    <span class="text-dark fw-semibold">129</span>
                  </div>
                  <div class="d-flex align-items-center gap-2 ms-4">
                    <a class="text-white d-flex align-items-center justify-content-center bg-secondary p-2 fs-4 rounded-circle" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Comment">
                      <i class="ti ti-message-2"></i>
                    </a>
                    <span class="text-dark fw-semibold">0</span>
                  </div>
                  <a class="text-dark ms-auto d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Share">
                    <i class="ti ti-share"></i>
                  </a>
                </div>
              </div>
              <div class="d-flex align-items-center gap-3 p-3">
                <img src="../../dist/images/profile/user-1.jpg" alt="" class="rounded-circle" width="33" height="33">
                <input type="text" class="form-control py-8" id="exampleInputtext" aria-describedby="textHelp" placeholder="Comment">
                <button class="btn btn-primary">Comment</button>
              </div>
            </div>
          </div> --}}
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')

<!-- ---------------------------------------------- -->
<script src="{{ asset('dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dist/libs/datatables.net/js/dataTables.bootstrap5.min.js') }}"></script>
<script>
    $(function () {
        $("#datatable").DataTable({
            scrollX: true,
        });
    });

</script>
@endsection
