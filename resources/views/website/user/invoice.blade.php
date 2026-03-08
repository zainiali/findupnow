<div class="wsus__invoice_body mt-2">
    <div class="table-responsive">
        <table class="table">
            <tbody>
                <tr>
                    <th class="package">{{ __('Include Services') }}</th>
                    <th class="price"></th>
                    <th class="qnty"></th>
                    <th class="total"></th>
                </tr>
                <tr>
                    <td class="package">
                        @foreach ($package_features as $package_feature)
                            <p>{{ $package_feature }}</p>
                        @endforeach
                    </td>
                    <td class="price"></td>
                    <td class="qnty"></td>
                    <td class="total"></td>
                </tr>
                @if (count($additional_services) > 0)
                    <tr class="border_none">
                        <th class="package">{{ __('Additional Service') }}</th>
                        <th class="qnty">{{ __('Quantity') }}</th>
                        <th class="total">{{ __('Total') }}</th>
                    </tr>
                    @foreach ($additional_services as $additional_service)
                        <tr>
                            <td class="package">
                                <p>{{ $additional_service->service_name }}</p>
                            </td>
                            <td class="qnty">
                                <b>{{ $additional_service->qty }}</b>
                            </td>
                            <td class="total">
                                <b>
                                    {{ currency($additional_service->price) }}
                                </b>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<div class="wsus__invoice_footer">
    <div class="row">
        <div class="col-xl-6">
            <div class="wsus__invoice_footer_info">
                <h3>{{ __('Booking Information') }}</h3>
                <p> <span>{{ __('Schedule date') }}: </span> {{ date('d-M-Y', strtotime($order->booking_date)) }}</p>

                <p> <span>{{ __('Schedule Time') }}: </span> {{ $order->schedule_time_slot }}</p>

                <p> <span>{{ __('Booking Id') }}: </span> {{ $order->order_id }}</p>
                <p> <span>{{ __('Name') }}: </span> {{ html_decode($booking_address->name) }}</p>
                <p> <span>{{ __('Phone') }}: </span> {{ html_decode($booking_address->phone) }}</p>
                <p> <span>{{ __('Email') }}: </span> {{ html_decode($booking_address->email) }}</p>
                <p> <span>{{ __('Address') }}: </span> {{ html_decode($booking_address->address) }}</p>
                <p> <span>{{ __('Post Code') }}: </span> {{ html_decode($booking_address->post_code) }}</p>
                <p> <span>{{ __('Booking Created') }}: </span> {{ $order->created_at->format('d-m-Y') }}</p>
                <p> <span>{{ __('Booking Created Time') }}: </span> {{ $order->created_at->format('h:i A') }}</p>
                <p> <span>{{ __('Booking Note') }}: </span> {{ html_decode($order->order_note) }}</p>
                <p> <span>{{ __('Provider') }} :</span> <a
                        href="{{ route('providers', $provider->user_name) }}">{{ $provider->name }}</a></p>
                <p> <span>{{ __('Service') }} :</span> <a
                        href="{{ route('service', $order->service->slug) }}">{{ $order->service->name }}</a></p>
            </div>

        </div>
        <div class="col-xl-6">

            <div class="wsus__invoice_footer_info">
                <h3>{{ __('Payment Information') }}</h3>
                <p> <span>{{ __('Payment Status') }}: </span>
                    @if ($order->payment_status == 'pending')
                        {{ __('Pending') }}
                    @elseif ($order->payment_status == 'success')
                        {{ __('Success') }}
                    @endif
                </p>
                <p> <span>{{ __('Payment Method') }}: </span> {{ $order->payment_method }}</p>
                <p> <span>{{ __('Transaction') }}: </span> {{ html_decode($order->transection_id) }}</p>

                <p> <span>{{ __('Sub Total') }} :</span>
                    {{ currency($order->sub_total) }}
                </p>
                <p> <span>{{ __('Additional') }} :</span>
                    {{ currency($order->additional_amount) }}
                </p>

                <p> <span>{{ __('Discount') }} (-) :</span>
                    {{ currency($order->coupon_discount) }}
                </p>

                <p> <span>{{ __('Total Amount') }} :</span>
                    {{ currency($order->total_amount) }}
                </p>

                <p> <span>{{ __('Total Payable') }} :</span>
                    {{ $order->payable_amount }} {{ $order->payable_currency }}
                </p>

                <p> <span>{{ __('Order Status') }}</span> :
                    @if ($order->order_status == 'awaiting_for_provider_approval')
                        {{ __('awaiting for provider approval') }}
                    @elseif ($order->order_status == 'approved_by_provider')
                        {{ __('Approved') }}
                    @elseif ($order->order_status == 'order_decliened_by_provider')
                        {{ __('Declined by provider') }}
                    @elseif ($order->order_status == 'order_decliened_by_client')
                        {{ __('Declined by you') }}
                    @elseif ($order->order_status == 'complete')
                        {{ __('Complete') }}
                    @endif
                </p>

                <div class="order_request_btn_area">
                    @if ($order->order_status == 'approved_by_provider')
                        @if ($order->order_status != 'complete')
                            <button class="common_btn order_request_btn" data-bs-toggle="modal"
                                data-bs-target="#order_compelete" type="button">
                                {{ __('Mark as complete') }}
                            </button>

                            <button class="common_btn order_request_btn" data-bs-toggle="modal"
                                data-bs-target="#order_declined" type="button">
                                {{ __('Decliend Order') }}
                            </button>
                        @endif

                    @endif

                    @if ($order->order_status == 'order_decliened_by_client' || $order->order_status == 'order_decliened_by_provider')
                        @if (!$refundRequest)
                            <button class="common_btn order_request_btn" data-bs-toggle="modal"
                                data-bs-target="#exampleModal_invoice" type="button">
                                {{ __('Send Refund Request') }}
                            </button>
                        @endif

                    @endif
                </div>

            </div>
        </div>
    </div>
</div>

@if ($refundRequest)
    <div class="wsus__invoice_footer_request">
        <h4>{{ __('Rofund Request') }}</h4>
        <p><span>{{ __('Request Date') }}</span> {{ $refundRequest->created_at->format('h:i A, d-M-Y') }}</p>
        <p><span>{{ __('Resone') }}</span> {!! html_decode(clean(nl2br($refundRequest->resone))) !!}</p>
        <p><span>{{ __('Account Information') }}</span> {!! html_decode(clean(nl2br($refundRequest->account_information))) !!}</p>
        <p><span>{{ __('Refund Status') }}</span>
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
        </p>
    </div>
@endif

<!-- Modal -->
<div class="modal fade" id="exampleModal_invoice" aria-labelledby="exampleModalLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Refund Request') }}
                </h5>
                <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="wsus__review_input">
                    <form action="{{ route('send-refund-request') }}" method="POST">
                        @csrf

                        <input name="order_id" type="hidden" value="{{ $order->id }}">
                        <div class="row">
                            <div class="col-xl-12">
                                <fieldset>
                                    <legend>{{ __('Resone') }}*</legend>
                                    <textarea name="resone" required rows="5"></textarea>
                                </fieldset>
                            </div>
                            <div class="col-xl-12">
                                <fieldset>
                                    <legend>{{ __('Account Information for get payment') }}*</legend>
                                    <textarea name="account_information" required rows="5"></textarea>
                                </fieldset>
                                <button class="common_btn mt_20" type="submit">{{ __('Submit') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="order_compelete" aria-labelledby="exampleModalLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ __('Are you realy want to complete this booking ?') }}
                </h5>
                <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="wsus__review_input">
                    <a class="common_btn mt_20"
                        href="{{ route('mark-as-a-complete', $order->id) }}">{{ __('Yes, Complete') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="order_declined" aria-labelledby="exampleModalLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ __('Are you realy want to Declined this booking ?') }}
                </h5>
                <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="wsus__review_input">
                    <a class="common_btn mt_20"
                        href="{{ route('mark-as-a-declined', $order->id) }}">{{ __('Yes, Declined') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
