@extends('admin.master_layout')
@section('title')
    <title>{{ __('Complete Request') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Complete Request') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Complete Request') }}</div>
                </div>
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
                                                <th>{{ __('Client') }}</th>
                                                <th>{{ __('Total Amount') }}</th>
                                                <th>{{ __('Order Id') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($completeRequests as $index => $completeRequest)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>
                                                        <a
                                                            href="{{ route('admin.provider-show', $completeRequest->provider_id) }}">{{ $completeRequest->provider->name }}</a>
                                                    </td>
                                                    <td>
                                                        {{ currency($completeRequest->order->total_amount) }}
                                                    </td>
                                                    <td>{{ $completeRequest->order->order_id }}</td>
                                                    <td>

                                                        <a class="btn btn-primary btn-sm"
                                                            href="{{ route('admin.booking-show', $completeRequest->order->order_id) }}"><i
                                                                class="fa fa-eye" aria-hidden="true"></i></a>
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

    <script>
        "use strict";

        function deleteData(id) {
            $("#deleteForm").attr("action", '{{ url('admin/delete-provider-withdraw/') }}' + "/" + id)
        }
    </script>
@endsection
