@extends('website.provider.master_layout')
@section('title')
    <title>{{ __('Review Details') }}</title>
@endsection
@section('provider-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Review Details') }}</h1>

            </div>

            <div class="section-body">
                <a class="btn btn-primary" href="{{ route('provider.review-list') }}"><i class="fas fa-list"></i>
                    {{ __('Review List') }}</a>
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped table-bordered">
                                        <tr>
                                            <td>{{ __('Client') }}</td>
                                            <td>{{ $review->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Client Email') }}</td>
                                            <td>{{ $review->user->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Service') }}</td>
                                            <td><a
                                                    href="{{ route('provider.service.edit', $review->service_id) }}">{{ $review->service->name }}</a>
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

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
