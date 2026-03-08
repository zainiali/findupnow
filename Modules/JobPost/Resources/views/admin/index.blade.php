@extends('admin.master_layout')
@section('title')
    <title>{{ __('All Job Post') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('All Job Post') }}</h1>

            </div>

            <div class="section-body">
                <a class="btn btn-primary" href="{{ route('admin.jobpost.create') }}">{{ __('Create New') }}</a>
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SN') }}</th>
                                                <th>{{ __('User') }}</th>
                                                <th>{{ __('Title') }}</th>
                                                <th>{{ __('Price') }}</th>
                                                <th>{{ __('Admin Approval') }}</th>
                                                <th>{{ __('Applications') }}</th>
                                                <th>{{ __('Visibility') }}</th>
                                                <th>{{ __('Job Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($job_posts as $index => $job_post)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td><a
                                                            href="{{ route('admin.customer-show', $job_post->user_id) }}">{{ html_decode($job_post?->user?->name) }}</a>
                                                    </td>
                                                    <td><a href="{{ route('job-detils', $job_post->slug) }}"
                                                            target="blank">{{ html_decode($job_post->title) }}</a></td>
                                                    <td> {{ currency($job_post->regular_price) }}</td>
                                                    <td>
                                                        @if ($job_post->approved_by_admin == 'approved')
                                                            <span
                                                                class="badge bg-success text-white">{{ __('Approved') }}</span>
                                                        @else
                                                            <span
                                                                class="badge bg-danger text-white">{{ __('Awaiting') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.job-post-applicants', $job_post->id) }}">{{ __('Click here') }}
                                                            ({{ $job_post->total_job_application }})
                                                        </a>
                                                    </td>

                                                    <td>
                                                        @if ($job_post->status == 'enable')
                                                            <span
                                                                class="badge bg-success text-white">{{ __('Visible') }}</span>
                                                        @else
                                                            <span
                                                                class="badge bg-danger text-white">{{ __('Hidden') }}</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if ($job_post->checkJobStatus($job_post->id) == 'approved')
                                                            <span
                                                                class="badge bg-success text-white">{{ __('Hired') }}</span>
                                                        @elseif ($job_post->checkJobStatus($job_post->id) == 'pending')
                                                            <span
                                                                class="badge bg-warning text-white">{{ __('Not Hired') }}</span>
                                                        @else
                                                            <span
                                                                class="badge bg-danger text-white">{{ __('Rejected') }}</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <a class="btn btn-primary btn-sm"
                                                            href="{{ route('admin.jobpost.edit', $job_post->id) }}"><i
                                                                class="fa fa-edit" aria-hidden="true"></i></a>

                                                        <a class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal" href="javascript:;"
                                                            onclick="deleteData({{ $job_post->id }})"><i
                                                                class="fa fa-trash" aria-hidden="true"></i></a>

                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                {{ $job_posts->links() }}
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>

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
            $("#deleteForm").attr("action", "{{ url('admin/jobpost/jobpost/') }}" + "/" + id)
        }
    </script>
@endpush
