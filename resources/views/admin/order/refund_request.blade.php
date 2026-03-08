@extends('admin.master_layout')
@section('title')
    <title>{{ __('Refund Request') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Refund Request') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Refund Request') }}</div>
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
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($refundRequests as $index => $refundRequest)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>
                                                        <a
                                                            href="{{ route('admin.customer-show', $refundRequest->client_id) }}">{{ $refundRequest->client->name }}</a>
                                                    </td>
                                                    <td>
                                                        {{ currency($refundRequest?->order?->total_amount ?? 0) }}
                                                    </td>
                                                    <td>{{ $refundRequest?->order?->order_id ?? '' }}</td>

                                                    <td>
                                                        @if ($refundRequest->status == 'awaiting_for_admin_approval')
                                                            {{ __('awaiting for admin approval') }}
                                                        @elseif ($refundRequest->status == 'decliened_by_admin')
                                                            {{ __('Decliened by admin') }}
                                                        @else
                                                            {{ __('Complete') }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary btn-sm"
                                                            href="{{ route('admin.booking-show', $refundRequest?->order?->order_id ?? 0) }}"><i
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
