@extends('admin.master_layout')
@section('title')
    <title>{{ __('Review Details') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Review Details') }}</h1>

            </div>

            <div class="section-body">
                <a class="btn btn-primary" href="{{ route('admin.review-list') }}"><i class="fas fa-list"></i>
                    {{ __('Review List') }}</a>
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped table-bordered">
                                        <tr>
                                            <td>{{ __('Client') }}</td>
                                            <td><a
                                                    href="{{ route('admin.customer-show', $review->user_id) }}">{{ $review->user->name }}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Client Email') }}</td>
                                            <td>{{ $review->user->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Service') }}</td>
                                            <td><a
                                                    href="{{ route('admin.service.edit', $review->service_id) }}">{{ $review->service->name }}</a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>{{ __('Provider') }}</td>
                                            <td>
                                                @if ($review->provider)
                                                    <a href="{{ route('admin.provider-show', $review->provider_id) }}">{{ $review->provider->name }}</a>
                                                @else
                                                    <span class="text-danger">{{ __('Provider Not Found') }}</span>
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>{{ __('Rating') }}</td>
                                            <td>{{ $review->rating }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Review') }}</td>
                                            <td>{{ html_decode($review->review) }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Created At') }}</td>
                                            <td>{{ $review->created_at->format('H:i A, d-m-Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Status') }}</td>
                                            <td>
                                                @if ($review->status == 1)
                                                    <span class="badge badge-success">{{ __('Active') }}</span>
                                                @else
                                                    <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>{{ __('Change Status') }}</td>
                                            <form id="updateReview"
                                                action="{{ route('admin.update-review', $review->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <td>
                                                    <select class="form-control" id="" name="status">
                                                        <option value="1"
                                                            {{ $review->status == 1 ? 'selected' : '' }}>
                                                            {{ __('Active') }}</option>
                                                        <option value="0"
                                                            {{ $review->status == 0 ? 'selected' : '' }}>
                                                            {{ __('Inactive') }}</option>
                                                    </select>
                                                </td>
                                            </form>
                                        </tr>

                                    </table>
                                    <div class="d-flex justify-content-between">
                                        <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            href="javascript:;" onclick="deleteData({{ $review->id }})"><i
                                                class="fa fa-trash" aria-hidden="true"></i> {{ __('Delete') }}</a>

                                        <button class="btn btn-primary" id="updateBtn" form="updateReview"
                                            type="submit">{{ __('Update Status') }}</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
    <x-admin.delete-modal />
@endsection

@push('js')
    <script>
        "use strict";

        function deleteData(id) {
            $("#deleteForm").attr("action", '{{ url('admin/delete-service-review/') }}' + "/" + id)
        }

        (function($) {
            "use strict";
            $(document).ready(function() {
                $("#updateBtn").on("click", function() {
                    $("#updateReview").submit();
                })
            });
        })(jQuery);
    </script>
@endpush
