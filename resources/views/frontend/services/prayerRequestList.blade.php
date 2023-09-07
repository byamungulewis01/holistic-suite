@extends('layouts.frontend.app')

@section('title', 'Igaburo Murugo')

@section('body')
<div class="col-md-12 col-lg-12 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body">
            <div class="d-sm-flex d-block align-items-center justify-content-between mb-3">
                <div class="mb-3 mb-sm-0">
                    <h5 class="card-title fw-semibold">Icyifuzo cyo Gusengera </h5>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-middle text-nowrap mb-0">
                    <thead>
                        <tr class="text-muted fw-semibold">
                            <th scope="col">#</th>
                            <th scope="col">Reg Number</th>
                            <th scope="col">Names</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Service</th>
                            <th scope="col">Date</th>
                            <th scope="col">Icyifuzo / Isengesho</th>
                            <th scope="col">Status</th>
                            <th scope="col">Apply Date</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="border-top">
                        @forelse ($collections as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->member->reg_no }}</td>
                            <td>{{ $item->member->name }}</td>
                            <td>@if ($item->member->gender == 1) {{ __('message.gender.0.name') }}
                                @else {{ __('message.gender.1.name') }} @endif</td>
                            <td>
                                @php
                                $attr = __('message.attribute');
                                @endphp
                                {{ $item->service_type->$attr }}
                            </td>
                            <td>{{ $item->date }}</td>
                            <td>
                                <a href="" class="text-muted" data-bs-toggle="modal"
                                    data-bs-target="#viewMore{{ $item->id }}">View More</a>
                                <div class="modal fade" id="viewMore{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="bs-example-modal-lg" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header d-flex align-items-center">
                                                <h5 class="modal-title" id="myLargeModalLabel">
                                                    Isengesho / Icyifuzo
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <p>
                                                    {{ $item->prayers }}
                                                </p>

                                            </div>

                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            </td>
                            <td>
                                @if ($item->status == 1)
                                <span class="badge fw-semibold py-1 w-85 bg-light-primary text-primary">Pending</span>
                                @elseif($item->status == 2)
                                <span class="badge fw-semibold py-1 w-85 bg-light-success text-success">Approved</span>
                                @else
                                <span class="badge fw-semibold py-1 w-85 bg-light-danger text-danger">Reject</span>
                                @endif
                            </td>
                            <td>{{ $item->created_at->format('m/d/Y') }}</td>
                            <td class="d-flex justify-content-center gap-1">
                                @unless ($item->status != 1)
                                <button data-bs-toggle="modal" data-bs-target="#deleteRequest{{ $item->id }}"
                                    class="btn btn-sm btn-danger" title="Delete"><i class="ti ti-trash"></i></button>

                                @elseif($item->status == 2)
                                <a href="" data-bs-toggle="modal"
                                    data-bs-target="#approveComment{{ $item->id }}">Comment</a>
                                <div class="modal fade" id="approveComment{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="vertical-center-modal" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content modal-filled">
                                            <div class="modal-body p-4">
                                                <div>
                                                    <div class="mb-3">
                                                        <h4 class="mt-2 text-success">Approve Comment</h4>
                                                    </div>
                                                    <div class="mb-2">
                                                        <textarea rows="5" readonly
                                                            class="form-control">{{ $item->comment }}</textarea>
                                                    </div>
                                                    <div class="text-end">
                                                        <button type="button" class="btn btn-light font-medium"
                                                            data-bs-dismiss="modal">
                                                            Close
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                </div>
                                @else
                                <a href="" data-bs-toggle="modal"
                                    data-bs-target="#rejectComment{{ $item->id }}">Comment</a>
                                <div class="modal fade" id="rejectComment{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="vertical-center-modal" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content modal-filled">
                                            <div class="modal-body p-4">
                                                <div>
                                                    <div class="mb-3">
                                                        <h4 class="mt-2 text-danger">Reject Comment</h4>
                                                    </div>
                                                    <div class="mb-2">
                                                        <textarea rows="5" readonly
                                                            class="form-control">{{ $item->comment }}</textarea>
                                                    </div>
                                                    <div class="text-end">
                                                        <button type="button" class="btn btn-light font-medium"
                                                            data-bs-dismiss="modal">
                                                            Close
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                </div>
                                @endunless
                                <div class="modal fade" id="deleteRequest{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="vertical-center-modal" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content modal-filled bg-light-danger">
                                            <div class="modal-body p-4">
                                                <form
                                                    action="{{ route('member.memberStep.destroyPrayerRequest',$item->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="text-center text-danger">
                                                        <i class="ti ti-hexagon-letter-x fs-7"></i>
                                                        <h4 class="mt-2">Are you sure to delete?</h4>
                                                        <p class="mt-3">
                                                            You will not be able to recover this file data!
                                                        </p>
                                                        <button class="btn btn-light my-2">
                                                            Yes I'm sure
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

@endsection
