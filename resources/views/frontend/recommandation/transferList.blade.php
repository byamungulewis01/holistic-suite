@extends('layouts.frontend.app')

@section('title', 'Transfer')

@section('body')
<div class="col-md-12 col-lg-12 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body">
            <div class="d-sm-flex d-block align-items-center justify-content-between mb-3">
                <div class="mb-3 mb-sm-0">
                    <h5 class="card-title fw-semibold">Transfer Certificate </h5>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-middle text-nowrap mb-0">
                    <thead>
                        <tr class="text-muted fw-semibold">
                            <th scope="col">#</th>
                            <th scope="col">Applicant Names</th>
                            <th scope="col">Region</th>
                            <th scope="col">Parish</th>
                            <th scope="col">Church</th>
                            <th scope="col">Status</th>
                            <th scope="col">Apply Date</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="border-top">
                        @forelse ($transfer as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->member->name }}</td>
                            <td>{{ $item->region->name }}</td>
                            <td>{{ $item->parish->name }}</td>
                            <td>{{ $item->localChurch->name }}</td>
                            <td>
                                @if ($item->status == 1)
                                <span class="badge fw-semibold py-1 w-85 bg-light-primary text-primary">Pending</span>
                                @elseif($item->status == 2)
                                <span class="badge fw-semibold py-1 w-85 bg-light-success text-success">Approved</span>
                                @else
                                <span class="badge fw-semibold py-1 w-85 bg-light-danger text-danger">Reject</span>
                                @endif
                            </td>
                            <td>{{ $item->created_at->format('Y/m/d') }}</td>
                            <td class="d-flex justify-content-center gap-1">
                                @unless ($item->status != 1)
                                <button data-bs-toggle="modal" data-bs-target="#deleteRequest{{ $item->id }}"
                                    class="btn btn-sm btn-danger" title="Delete"><i class="ti ti-trash"></i></button>

                                @elseif($item->status == 2)
                                <a href="{{ route('member.certificate.transferCert',encrypt($item->id)) }}"
                                    class="btn btn-sm btn-success" target="_blank" title="Download"><i
                                        class="ti ti-download"></i></a>

                                @else
                                Rejected
                                @endunless

                                <div class="modal fade" id="deleteRequest{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="vertical-center-modal" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content modal-filled bg-light-danger">
                                            <div class="modal-body p-4">
                                                <form
                                                    action="{{ route('member.recommandation.destroyTransfer',$item->id) }}"
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
