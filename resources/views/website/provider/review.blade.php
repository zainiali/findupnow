@extends('website.provider.master_layout')
@section('title')
    <title>{{ __('Review List') }}</title>
@endsection
@section('provider-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Review List') }}</h1>

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
                                                <th width="5%">{{ __('SN') }}</th>
                                                <th width="15%">{{ __('Client') }}</th>
                                                <th width="30%">{{ __('Service') }}</th>
                                                <th width="5%">{{ __('Rating') }}</th>
                                                <th width="10%">{{ __('Status') }}</th>
                                                <th width="20%">{{ __('Created At') }}</th>
                                                <th width="10%">{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reviews as $index => $review)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>{{ $review->user->name }}</td>
                                                    <td><a
                                                            href="{{ route('provider.service.edit', $review->service_id) }}">{{ $review->service->name }}</a>
                                                    </td>

                                                    <td>{{ $review->rating }}</td>
                                                    <td>
                                                        @if ($review->status == 1)
                                                            <span class="badge badge-success">{{ __('Active') }}</span>
                                                        @else
                                                            <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $review->created_at->format('H:i A, d-m-Y') }}
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary btn-sm"
                                                            href="{{ route('provider.show-review', $review->id) }}"><i
                                                                class="fa fa-eye" aria-hidden="true"></i></a>
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
@endsection
