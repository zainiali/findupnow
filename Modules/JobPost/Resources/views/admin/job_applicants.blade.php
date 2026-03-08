@extends('admin.master_layout')
@section('title')
    <title>{{ __('Job Applications') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Job Applications') }}</h1>
            </div>
            <div class="section-body">
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SN') }}</th>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Phone') }}</th>
                                                <th>{{ __('Email') }}</th>
                                                <th>{{ __('Created at') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($job_requests as $index => $job_request)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>{{ html_decode($job_request?->seller?->name) }}</td>
                                                    <td>{{ html_decode($job_request?->seller?->phone) }}</td>
                                                    <td>{{ html_decode($job_request?->seller?->email) }}</td>
                                                    <td>
                                                        {{ $job_request->created_at->format('Y-m-d') }}
                                                    </td>

                                                    <td>
                                                        @if ($job_request->status == 'approved')
                                                            <span
                                                                class="badge bg-success text-white">{{ __('Hired') }}</span>
                                                        @elseif ($job_request->status == 'pending')
                                                            <span
                                                                class="badge bg-danger text-white">{{ __('Pending') }}</span>
                                                        @else
                                                            <span
                                                                class="badge bg-danger text-white">{{ __('Rejected') }}</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if ($job_request->status == 'pending')
                                                            <a class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                                data-bs-target="#approvedOrder{{ $job_request->id }}"
                                                                href="javascript:;"><i class="fas fa-check"></i>
                                                                {{ __('Approved') }}</a>
                                                        @endif
                                                        <a class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#applicationModal{{ $job_request->id }}"
                                                            href="javascript:;"><i class="fa fa-eye"
                                                                aria-hidden="true"></i></a>

                                                        <a class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal" href="javascript:;"
                                                            onclick="deleteData({{ $job_request->id }})"><i
                                                                class="fa fa-trash" aria-hidden="true"></i></a>

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
        </section>
    </div>

    @foreach ($job_requests as $index => $job_request)
        <a class="btn btn-primary btn-sm" data-bs-toggle="modal"
            data-bs-target="#applicationModal{{ $job_request->id }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
        <div class="modal fade" id="applicationModal{{ $job_request->id }}" role="dialog"
            aria-labelledby="applicationModal{{ $job_request->id }}Label" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="applicationModal{{ $job_request->id }}Label">{{ __('Application') }}
                        </h5>
                        <hr style="color: #000">
                        <button class="btn btn-danger" data-dismiss="modal" type="button" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <td>{{ html_decode($job_request?->seller?->name) }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Phone') }}</th>
                                    <td>{{ html_decode($job_request?->seller?->phone) }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Email') }}</th>
                                    <td>{{ html_decode($job_request?->seller?->email) }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Created At') }}</th>
                                    <td>{{ $job_request->created_at->format('Y-m-d') }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Comment') }}</th>
                                    <td>{{ $job_request->description }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Status') }}</th>
                                    <td>
                                        @if ($job_request->status == 'approved')
                                            <span class="badge bg-success text-white">{{ __('Hired') }}</span>
                                        @elseif ($job_request->status == 'pending')
                                            <span class="badge bg-danger text-white">{{ __('Pending') }}</span>
                                        @else
                                            <span class="badge bg-danger text-white">{{ __('Rejected') }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Resume') }}</th>
                                    <td> <a href="{{ asset($job_request->resume) }}">Downlode Resume <i
                                                class="fas fa-file"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-dismiss="modal" type="button">{{ __('Close') }}</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="approvedOrder{{ $job_request->id }}" role="dialog" aria-hidden="true" tabindex="-1"
            style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Application Approved Confirmation</h5>
                        <button class="btn btn-danger" data-dismiss="modal" type="button" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are You sure Approved this Application</p>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <form action="{{ route('admin.job-application-approval', $job_request->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-danger" data-dismiss="modal" type="button">Close</button>
                            <button class="btn btn-primary" type="submit">Yes, Approved</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal -->
    <div class="modal fade" id="canNotDeleteModal" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true"
        tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    {{ __('You can not delete this seller. Because there are one or more products and shop account has been created in this seller.') }}
                </div>

                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal" type="button">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>

    <x-admin.delete-modal />
@endsection

@push('js')
    <script>
        "use strict"

        function deleteData(id) {
            $("#deleteForm").attr("action", "{{ url('admin/jobpost/job-application-delete') }}" + "/" + id)
        }
    </script>
@endpush
