@extends('admin.master_layout')
@section('title')
    <title>{{ __('Booking Details') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Booking Details') }}</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h6>{{ __('Schedule Date') }}</h6>
                                <hr>
                                <p>{{ __('Date') }} : {{ date('d-M-Y', strtotime($order->booking_date)) }}</p>
                                <p>{{ __('Time') }} : {{ $order->schedule_time_slot }}</p>

                                <h6 class="mt-4">{{ __('Booking Information') }}</h6>
                                <hr>
                                <p>{{ __('Booking Id') }} : {{ $order->order_id }}</p>
                                <p>{{ __('Name') }} : {{ html_decode($booking_address->name) }}</p>
                                <p>{{ __('Phone') }} : {{ html_decode($booking_address->phone) }}</p>
                                <p>{{ __('Email') }} : {{ html_decode($booking_address->email) }}</p>
                                <p>{{ __('Address') }} : {{ html_decode($booking_address->address) }}</p>
                                <p>{{ __('Post Code') }} : {{ html_decode($booking_address->post_code) }}</p>
                                <p>{{ __('Booking Created') }} : {{ $order->created_at->format('d-m-Y') }}</p>
                                <p>{{ __('Booking Created Time') }} : {{ $order->created_at->format('h:i A') }}</p>

                                @if ($order->order_note)
                                    <h6 class="mt-4">{{ __('Booking Note') }}</h6>
                                    <hr>
                                    <p>{!! html_decode(clean(nl2br($order->order_note))) !!}</p>
                                @endif

                                <h6 class="mt-4">{{ __('Client Details') }}</h6>
                                <hr>
                                <p>{{ __('Name') }} : <a
                                        href="{{ route('admin.customer-show', $client->id) }}">{{ $client->name }}</a></p>
                                <p>{{ __('Phone') }} : {{ $client->Phone }}</p>
                                <p>{{ __('Email') }} : {{ $client->email }}</p>
                                <p>{{ __('Address') }} : {{ $client->address }}</p>

                                <h6 class="mt-4">{{ __('Provider Details') }}</h6>
                                <hr>
                                <p>{{ __('Name') }} : <a
                                        href="{{ route('admin.provider-show', $provider->id) }}">{{ $provider->name }}</a>
                                </p>
                                <p>{{ __('Phone') }} : {{ $provider->Phone }}</p>
                                <p>{{ __('Email') }} : {{ $provider->email }}</p>
                                <p>{{ __('Address') }} : {{ $provider->address }}</p>

                                <h6 class="mt-4">{{ __('Payment Information') }}</h6>
                                <hr>

                                <p> {{ __('Transaction') }}: {{ html_decode($order->transection_id) }}</p>

                                @if ($order->payment_status == 'pending')
                                    <p>{{ __('Payment Status') }} : <span
                                            class="badge badge-danger">{{ __('Pending') }}</span>
                                    @elseif ($order->payment_status == 'success')
                                    <p>{{ __('Payment Status') }} : <span
                                            class="badge badge-success">{{ __('Success') }}</span>
                                @endif
                                <p>{{ __('Payment Gateway') }} : {{ $order->payment_method }}</p>
                                <p>{{ __('Sub Total') }} :
                                    {{ currency($order->sub_total) }}
                                </p>
                                <p>{{ __('Additional') }} :
                                    {{ currency($order->additional_amount) }}
                                </p>
                                <p>{{ __('Discount') }} (-) :
                                    {{ currency($order->coupon_discount) }}
                                </p>

                                <p>{{ __('Total Amount') }} :
                                    {{ currency($order->total_amount) }}
                                </p>

                                <p>{{ __('Total Payable') }} :
                                    {{ $order->payable_amount_without_rate }} {{ $order->payable_currency }}
                                </p>

                                @if ($setting->commission_type != 'subscription')
                                    @if ($order->payment_status == 'pending')
                                        <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#approvedPayment-{{ $order->id }}">{{ __('Approve Payment') }}</button>
                                    @endif
                                @endif

                                <h6 class="mt-4">{{ __('Order Status') }}</h6>
                                <hr>
                                <p>{{ __('Status') }} :
                                    @if ($order->order_status == 'awaiting_for_provider_approval')
                                        {{ __('awaiting for provider approval') }}
                                    @elseif ($order->order_status == 'approved_by_provider')
                                        {{ __('Approved') }}
                                    @elseif ($order->order_status == 'order_decliened_by_provider')
                                        {{ __('Declined by provider') }}
                                    @elseif ($order->order_status == 'order_decliened_by_client')
                                        <span class="badge badge-danger">{{ __('Declined by Client') }}</span>
                                    @elseif ($order->order_status == 'complete')
                                        {{ __('Complete') }}
                                    @endif
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Include Services') }}</th>
                                        </tr>
                                    </thead>
                                    @if ($package_features)
                                        @foreach ($package_features as $package_feature)
                                            <tr>
                                                <td>{{ $package_feature }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </table>

                                @if (count($additional_services) > 0)
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Additional Service') }}</th>
                                                <th>{{ __('Quantity') }}</th>
                                                <th>{{ __('Price') }}</th>
                                            </tr>
                                        </thead>
                                        @foreach ($additional_services as $additional_service)
                                            <tr>
                                                <td>{{ $additional_service->service_name }}</td>
                                                <td>{{ $additional_service->qty }}</td>
                                                <td>
                                                    {{ currency($additional_service->price) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                @endif

                                @if ($order->order_status == 'awaiting_for_provider_approval')
                                    <a class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#declinedOrder-{{ $order->id }}" href="javascript:;"><i
                                            class="fas fa-times"></i> {{ __('Declined') }}</a>

                                    <a class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#approvedOrder-{{ $order->id }}" href="javascript:;"><i
                                            class="fas fa-check"></i> {{ __('Approved') }}</a>
                                @endif

                                <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                    data-bs-toggle="modal" data-bs-target="#declinedOrder-{{ $order->id }}"
                                    href="javascript:;" onclick="deleteData({{ $order->id }})"><i
                                        class="fas fa-trash    "></i> {{ __('Delete Booking') }}</a>

                                @if ($order->order_status != 'complete')
                                    <a class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#markAsCompelete-{{ $order->id }}" href="javascript:;"><i
                                            class="fas fa-check"></i> {{ __('Mark as complete') }}</a>
                                @endif

                            </div>
                        </div>

                        @if ($refundRequest)
                            <div class="card mt-3">
                                <div class="card-body">
                                    <h6>{{ __('Rofund Request by Client') }}</h6>
                                    <table class="table">
                                        <tr>
                                            <td>{{ __('Request Date') }}</td>
                                            <td>{{ $refundRequest->created_at->format('h:i A, d-M-Y') }}</td>
                                        </tr>

                                        <tr>
                                            <td>{{ __('Resone') }}</td>
                                            <td>
                                                {!! html_decode(clean(nl2br($refundRequest->resone))) !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>{{ __('Account Information') }}</td>
                                            <td>
                                                {!! html_decode(clean(nl2br($refundRequest->account_information))) !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>{{ __('Refund Status') }}</td>
                                            <td>
                                                @if ($order->complete_by_admin == 'Yes')
                                                    {{ __('Refund request declined and order completed by admin') }}
                                                @else
                                                    @if ($refundRequest->status == 'awaiting_for_admin_approval')
                                                        {{ __('awaiting for admin approval') }}
                                                    @elseif ($refundRequest->status == 'decliened_by_admin')
                                                        {{ __('Decliened by admin') }}
                                                    @else
                                                        {{ __('Complete') }}
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>

                                    </table>

                                    @if ($order->complete_by_admin != 'Yes')
                                        @if ($refundRequest->status == 'awaiting_for_admin_approval')
                                            <a class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#declinedRefundRequest-{{ $refundRequest->id }}"
                                                href="javascript:;"><i class="fas fa-times"></i> {{ __('Declined') }}</a>
                                        @endif

                                        @if ($order->order_status != 'complete')
                                            @if ($refundRequest->status != 'complete')
                                                <a class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#approvedRefundRequest-{{ $refundRequest->id }}"
                                                    href="javascript:;"><i class="fas fa-check"></i>
                                                    {{ __('Approved') }}</a>
                                            @endif
                                        @endif
                                    @endif

                                </div>
                            </div>
                        @endif

                        @if ($completeRequest)
                            <div class="card mt-3">
                                <div class="card-body">
                                    <h6>{{ __('Order Complete Request by Provider') }}</h6>
                                    <table class="table">
                                        <tr>
                                            <td>{{ __('Request Date') }}</td>
                                            <td>{{ $completeRequest->created_at->format('h:i A, d-M-Y') }}</td>
                                        </tr>

                                        <tr>
                                            <td>{{ __('Resone') }}</td>
                                            <td>
                                                {!! html_decode(clean(nl2br($completeRequest->resone))) !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>{{ __('Order status') }}</td>
                                            <td>
                                                @if ($order->complete_by_admin == 'Yes')
                                                    {{ __('Order completed by admin') }}
                                                @endif
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </section>
    </div>

    <x-admin.delete-modal />

    <div class="modal fade" id="declinedOrder-{{ $order->id }}" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Booking Declined Confirmation') }}</h5>
                    <button class="btn btn-danger" data-dismiss="modal" type="button" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Are You sure declined this booking') }}</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <form action="{{ route('admin.booking-declined', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-danger" data-dismiss="modal" type="button">{{ __('Close') }}</button>
                        <button class="btn btn-primary" type="submit">{{ __('Yes, Declined') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="approvedOrder-{{ $order->id }}" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Booking Approved Confirmation') }}</h5>
                    <button class="btn btn-danger" data-dismiss="modal" type="button" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Are You sure approved this booking') }}</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <form action="{{ route('admin.booking-approved', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-danger" data-dismiss="modal" type="button">{{ __('Close') }}</button>
                        <button class="btn btn-primary" type="submit">{{ __('Yes, Approved') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="approvedPayment-{{ $order->id }}" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Payment Approved Confirmation') }}</h5>
                    <button class="btn btn-danger" data-dismiss="modal" type="button" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Are You sure approved this payment') }}</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <form action="{{ route('admin.payment-approved', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-danger" data-dismiss="modal" type="button">{{ __('Close') }}</button>
                        <button class="btn btn-primary" type="submit">{{ __('Yes, Approved') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="markAsCompelete-{{ $order->id }}" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Booking Complete Confirmation') }}</h5>
                    <button class="btn btn-danger" data-dismiss="modal" type="button" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Are You sure complete this booking') }}</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <form action="{{ route('admin.booking-mark-as-complete', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-danger" data-dismiss="modal" type="button">{{ __('Close') }}</button>
                        <button class="btn btn-primary" type="submit">{{ __('Yes, complete') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if ($refundRequest)
        <div class="modal fade" id="declinedRefundRequest-{{ $refundRequest->id }}" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Refund Request Declined Confirmation') }}</h5>
                        <button class="btn btn-danger" data-dismiss="modal" type="button" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('Are You sure declined this refund request') }}</p>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <form action="{{ route('admin.refund-request-declined', $refundRequest->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-danger" data-dismiss="modal"
                                type="button">{{ __('Close') }}</button>
                            <button class="btn btn-primary" type="submit">{{ __('Yes, Declined') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="approvedRefundRequest-{{ $refundRequest->id }}" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Refund Request Approved Confirmation') }}</h5>
                        <button class="btn btn-danger" data-dismiss="modal" type="button" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('Are You sure approved this refund request') }}</p>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <form action="{{ route('admin.refund-request-approved', $refundRequest->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-danger" data-dismiss="modal"
                                type="button">{{ __('Close') }}</button>
                            <button class="btn btn-primary" type="submit">{{ __('Yes, Approved') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script>
        "use strict";

        function deleteData(id) {
            $("#deleteForm").attr("action", '{{ url('admin/delete-order/') }}' + "/" + id)
        }
    </script>
@endsection
