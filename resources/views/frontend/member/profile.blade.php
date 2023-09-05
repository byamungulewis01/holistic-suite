@extends('layouts.frontend.app')

@section('title','Profile')
@php
$attr = __('message.attribute');
@endphp
@section('body')
<div class="card overflow-hidden">
    <div class="card-body p-0">
      <div class="row align-items-center">
        <div class="col-lg-4 order-lg-1 order-2">
          <div class="d-flex align-items-center m-4">
            <div class="text-center">
              <h4 class="mb-0 fw-semibold lh-1 text-primary">{{ __('church/member.reg') }}: {{ $member->reg_no }}</h4>
            </div>
          </div>
        </div>
      </div>
      <ul class="nav nav-pills user-profile-tab justify-content-end mt-2 bg-light-info rounded-2" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6 active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="true">
            <i class="ti ti-user-circle me-2 fs-6"></i>
            <span class="d-none d-md-block">{{ __('church/member.profile') }}</span>
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6" id="pills-followers-tab" data-bs-toggle="pill" data-bs-target="#pills-followers" type="button" role="tab" aria-controls="pills-followers" aria-selected="false" tabindex="-1">
            <i class="ti ti-heart me-2 fs-6"></i>
            <span class="d-none d-md-block">{{ __('church/member.family') }}</span>
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6" id="pills-friends-tab" data-bs-toggle="pill" data-bs-target="#pills-friends" type="button" role="tab" aria-controls="pills-friends" aria-selected="false" tabindex="-1">
            <i class="ti ti-settings me-2 fs-6"></i>
            <span class="d-none d-md-block">{{ __('church/member.step') }}</span>
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6" id="pills-gallery-tab" data-bs-toggle="pill" data-bs-target="#pills-gallery" type="button" role="tab" aria-controls="pills-gallery" aria-selected="false" tabindex="-1">
            <i class="ti ti-pin me-2 fs-6"></i>
            <span class="d-none d-md-block">{{ __('church/member.class') }}</span>
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6" id="pills-group-tab" data-bs-toggle="pill" data-bs-target="#pills-group" type="button" role="tab" aria-controls="pills-group" aria-selected="false" tabindex="-1">
            <i class="ti ti-users me-2 fs-6"></i>
            <span class="d-none d-md-block">{{ __('church/member.group') }}</span>
          </button>
        </li>
      </ul>
    </div>
  </div>
  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade active show" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
      <div class="row">
        <div class="col-lg-6">
          <div class="card shadow-none border">
            <div class="card-body">
              <h4 class="fw-semibold mb-3 text-info">{{ __('church/member.introduction') }}</h4>
              <ul class="list-unstyled mb-0">
                <li class="d-flex align-items-center gap-3 mb-4">
                  <i class="ti ti-user text-dark fs-6"></i>
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
                <li class="d-flex align-items-center gap-3 mb-4">
                  <i class="ti ti-id-badge text-dark fs-6"></i>
                  <h6 class="fs-4 mb-0">{{ $member->marital_status->$attr }}</h6>
                </li>
                <li class="d-flex align-items-center gap-3 mb-4">
                  <i class="ti ti-eye text-dark fs-6"></i>
                  @foreach (__('message.relation') as $item)
                   @if ($item['id'] == $member->relation)
                   <h6 class="fs-4 mb-0">{{ $item['name'] }}</h6>
                   @endif
                  @endforeach
                </li>
                <li class="d-flex align-items-center gap-3 mb-2">
                  <i class="ti ti-map-pin text-dark fs-6"></i>
                  <h6 class="fs-4 mb-0">{{ $member->sector }}, {{ $member->cell }} , {{ $member->village }}</h6>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-6 d-flex align-items-stretch">
          <div class="card w-100">
            <div class="card-body">

              <div class="row mb-3">
                  <div class="col-md-6">
                    <div class="hstack p-3 border rounded mb-3 mb-md-0">
                      <div class="ms-0">
                        <h6 class="mb-0 fs-3">{{ __('church/member.insurance') }}</h6>
                        <span class="fs-2">{{ $member->insurance->$attr }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="hstack p-3 border rounded">
                      <div class="ms-3">
                        <h6 class="mb-0 fs-3">{{ __('church/member.saving') }}</h6>
                        <span class="fs-2">{{ $member->saving_type->$attr }}</span>
                      </div>
                    </div>
                  </div>
              </div>

              <h5 class="card-title fw-semibold">{{ __('church/member.ministry') }}</h5>
              <div class="mt-1 pb-3 border-bottom">
                <div class="hstack gap-2 mt-1">
                  @foreach (explode(',', $member->ministry_id) as $min)
                  @php
                  $ministries = \App\Models\Member::ministry($min);
                  $englishMinistries = $ministries->pluck(__('message.attribute'))->implode(', ');
                  @endphp
                  <span class="bg-light-primary text-primary badge">{{ $englishMinistries }}</span>
                  @endforeach
                </div>
              </div>
              <div class="py-3 border-bottom">
                <div class="d-flex align-items-center">
                  <h5 class="card-title fw-semibold">{{ __('church/member.field') }}</h5>
                </div>
                <div class="hstack gap-3 mt-1">
                  @foreach (explode(',', $member->field_id) as $min)
                  @php
                  $fields = \App\Models\Member::field($min);
                  $englishfields = $fields->pluck(__('message.attribute'))->implode(', ');
                  @endphp
                  <span class="bg-light-primary text-primary badge">
                      {{ $englishfields }} </span>
                  @endforeach
                </div>
              </div>

              <table class="table table-border text-nowrap align-middle mb-0">
                  <tbody>
                    <tr class="bg-light">
                      <td class="rounded-start bg-transparent">
                          <div>
                            <h6 class="mb-1">{{ __('church/member.disability') }}</h6>
                            <span class="fs-3">{{ $member->disability }}</span>
                          </div>
                      </td>
                      <td class="bg-transparent">
                          <div>
                              <h6 class="mb-1">{{ __('church/member.training') }}</h6>
                              <span class="fs-3">{{ $member->training }}</span>
                            </div>
                      </td>
                    </tr>
                    <tr class="bg-light">
                      <td class="rounded-start bg-transparent">
                          <div>
                            <h6 class="mb-1">{{ __('church/member.professional') }}</h6>
                            <span class="fs-3">{{ $member->professional }}</span>
                          </div>
                      </td>
                      <td class="bg-transparent">
                          <div>
                              <h6 class="mb-1">{{ __('church/member.employee') }}</h6>
                              <span class="fs-3">{{ $member->employer }}</span>
                            </div>
                      </td>
                    </tr>
                  </tbody>
                </table>

            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="pills-followers" role="tabpanel" aria-labelledby="pills-followers-tab" tabindex="0">
      <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
        <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center">{{ __('church/member.family') }} <span class="badge text-bg-secondary fs-2 rounded-4 py-1 px-2 ms-2">{{ $families->count() }}</span></h3>

      </div>
      <div class="row">
          @forelse ($families as $item)
          <div class="col-md-6 col-xl-4">
            <div class="card">
              <div class="card-body p-4 d-flex align-items-center gap-3">
                <img src="{{ asset('dist/images/profile/default.jpg') }}" alt="" class="rounded-circle" width="40" height="40">
                <div>
                  <h5 class="fw-semibold mb-1">{{ ($item->member_id == NULL) ? $item->child->name : $item->member->name }}</h5>
                  {{-- badge --}}
                  @if ($item->member_id == NULL)
                  <span class="badge bg-primary">{{ __('church/member.head') }}</span>
                  @else
                      @if ($item->member->relation == 1)
                      <span class="badge bg-danger">{{ __('church/member.head') }}</span>
                      @elseif($item->member->relation == 2)
                      <span class="badge bg-warning">{{ __('church/member.spouse') }}</span>
                      @elseif($item->member->relation == 3)
                      <span class="badge bg-primary">{{ __('church/member.child') }}</span>
                      @else
                      <span class="badge bg-info">{{ __('church/member.familyOther') }}</span>
                      @endif

                  @endif
                  <span class="fs-3 d-flex align-items-center"><i class="ti ti-pin text-dark fs-3 me-1"></i>{{ ($item->member_id == NULL) ? 'N/A': $item->member->reg_no }}</span>

                </div>
              </div>

            </div>
          </div>
          @empty
          <div class="col-md-6 col-xl-4">
              <div class="card">
                <div class="card-body p-4 d-flex align-items-center gap-3">

                  <div>
                    <h5 class="fw-semibold mb-1">No Family Yet</h5>
                    {{-- badge --}}

                  </div>
                </div>

              </div>
            </div>
          @endforelse
      </div>
    </div>
    <div class="tab-pane fade" id="pills-friends" role="tabpanel" aria-labelledby="pills-friends-tab" tabindex="0">
      <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold">Member Steps</h5>
            <p class="card-subtitle mb-0">Member Steps contain the following items:</p>
            <div class="table-responsive mt-4">
              <table class="table table-borderless text-nowrap align-middle mb-0">
                <tbody>
                  <tr>
                    <td colspan="6"></td>
                  </tr>
                  <tr class="bg-light">
                    <td class="rounded-start bg-light-dark">
                      <div class="d-flex align-items-center gap-3">

                        <div>
                          <h6 class="mb-0"><strong>PRAYER FOR CHILD</strong></h6>
                          <span class="fs-3">STEP 1</span>
                        </div>
                      </div>
                    </td>
                    <td class="bg-light-dark">
                      <div>
                          <h6 class="mb-1">Prayer Date</h6>
                          <span class="fs-3">{{ ($childPrayer != NULL) ? $childPrayer->date : 'Not yet' }}</span>
                      </div>
                    </td>
                    <td class="bg-light-dark">
                      <div>
                          <h6 class="mb-1">Region Name</h6>
                          <span class="fs-3">{{ ($childPrayer != NULL) ? $childPrayer->region->name : 'Not yet' }}</span>
                      </div>
                    </td>
                    <td class="bg-light-dark">
                      <div>
                          <h6 class="mb-1">Parish Name</h6>
                          <span class="fs-3">{{ ($childPrayer != NULL) ? $childPrayer->parish->name : 'Not yet' }}</span>
                      </div>
                      </td>
                    <td class="bg-light-dark">
                      <div>
                          <h6 class="mb-1">Prayer Date</h6>
                          <span class="fs-3">{{ ($childPrayer != NULL) ? $childPrayer->localChurch->name : 'Not yet' }}</span>
                      </div>
                    </td>

                  </tr>
                  <tr>
                    <td colspan="6"></td>
                  </tr>
                  <tr class="bg-light-info">
                    <td class="bg-light-info rounded-start">
                      <div class="d-flex align-items-center gap-3">

                        <div>
                          <h6 class="mb-1"><strong>BAPTSIM</strong></h6>
                          <span class="fs-3">STEP 2</span>
                        </div>
                      </div>
                    </td>
                    <td class="bg-transparent">
                        <div>
                          <h6 class="mb-1">Baptism Date</h6>
                          <span class="fs-3">{{ ($baptism != NULL) ? $baptism->date : 'Not yet' }}</span>
                        </div>
                    </td>
                    {{-- <td class="bg-transparent"> $100.1254 <i class="ti ti-chevron-up text-success ms-1 fs-4"></i>
                    </td> --}}
                    <td class="bg-transparent">
                      <div>
                          <h6 class="mb-1">Region Name</h6>
                          <span class="fs-3">{{ ($baptism != NULL) ? $baptism->region->name : 'Not yet' }}</span>
                      </div>
                    </td>
                    <td class="bg-transparent">
                      <div>
                          <h6 class="mb-1">Parish Name</h6>
                          <span class="fs-3">{{ ($baptism != NULL) ? $baptism->parish->name : 'Not yet' }}</span>
                      </div>
                    </td>
                    <td class="bg-transparent">
                      <div>
                          <h6 class="mb-1">Local Church Name</h6>
                          <span class="fs-3">{{ ($baptism != NULL) ? $baptism->localChurch->name : 'Not yet' }}</span>
                      </div>
                    </td>

                  </tr>
                  <tr>
                    <td colspan="6"></td>
                  </tr>
                  <tr class="bg-light-success">
                    <td class="rounded-start bg-light-success">
                        <div class="mb-2">
                          <h6 class="mb-1"><strong>MARIAGE</strong></h6>
                          <span class="fs-3">Step 3</span>
                        </div>
                        <div>
                          <h6 class="mb-1"><strong>Spouse Name</strong></h6>
                          <span class="fs-3">{{ ($marriage != NULL) ? $marriage->spouse_name : 'Not yet' }}</span>
                        </div>

                    </td>
                    <td class="bg-transparent">
                      <div>
                          <h6 class="mb-1">Mariage Date</h6>
                          <span class="fs-3">{{ ($marriage != NULL) ? $marriage->date : 'Not yet' }}</span>
                        </div>
                    </td>
                    <td class="bg-transparent">
                      <div>
                          <h6 class="mb-1">Region Name</h6>
                          <span class="fs-3">{{ ($marriage != NULL) ? $marriage->region->name : 'Not yet' }}</span>
                      </div>
                    </td>
                    <td class="bg-transparent">
                      <div>
                          <h6 class="mb-1">Parish Name</h6>
                          <span class="fs-3">{{ ($marriage != NULL) ? $marriage->parish->name : 'Not yet' }}</span>
                      </div>
                    </td>
                    <td class="bg-transparent">
                      <div>
                          <h6 class="mb-1">Local Church Name</h6>
                          <span class="fs-3">{{ ($marriage != NULL) ? $marriage->localChurch->name : 'Not yet' }}</span>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab" tabindex="0">
      <div class="card">
          <div class="card-body p-4">
            <h5 class="card-title fw-semibold">Member Step </h5>
            <p class="card-subtitle mb-0">Member Steps / Class Archieved </p>
            <div class="card shadow-none mt-9 mb-0">
              <div class="table-responsive">
                <table class="table text-nowrap align-middle mb-0">
                  <thead>
                    <tr>
                      <th class="ps-0">#</th>
                      <th>Member Step</th>
                      <th>Teacher</th>
                      <th>Step/Trainig</th>
                      <th>From - To</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody class="text-dark">
                      @foreach ($classes as $item)
                      <tr>

                        <td>
                          {{ $loop->iteration }}
                        </td>
                        <td>{{ $item->class->name }}</td>
                        <td>
                         {{ $item->class->teacher->name }}
                        </td>
                        <td>
                          @if ($item->class->step_id == 1)
                          {{ __('message.steps.0.name') }}
                          @elseif($item->class->step_id == 2)
                          {{ __('message.steps.1.name') }}
                          @elseif($item->class->step_id == 3)
                          {{ __('message.trainings.0.name') }}
                          @elseif($item->class->step_id == 4)
                          {{ __('message.trainings.1.name') }}
                          @elseif($item->class->step_id == 5)
                          {{ __('message.trainings.2.name') }}
                          @else

                          @endif
                      </td>
                        <td>
                          <div class="d-flex align-items-center gap-2">
                              <span class="fs-3">{{ explode(' - ',$item->class->period)[0] }}</span>
                              <span>
                                <i class="ti ti-arrow-right text-success fs-4"></i>
                              </span>
                              <span class="fs-3">{{ explode(' - ',$item->class->period)[1] }}</span>
                            </div>
                        </td>
                        <td> @if ($item->class->status == 1)
                          <span class="mb-1 badge font-medium bg-light-info text-info">{{ __('message.callingStatus.0.name') }}</span>
                          @else
                          <span class="mb-1 badge font-medium bg-light-danger text-danger">{{ __('message.callingStatus.1.name') }}</span>
                          @endif</td>
                        <td>
                          <div class="dropdown">
                            <a class="text-decoration-none" href="javascript:void(0)" id="nft2" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="ti ti-dots fs-4"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="nft2" style="">
                              <li>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                  <i class="ti ti-link me-1 fs-6"></i>https://www.abc.com/sfsdf767s </a>
                              </li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                      @endforeach

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-group" role="tabpanel" aria-labelledby="pills-group-tab" tabindex="0">

    </div>
  </div>
  @endsection

