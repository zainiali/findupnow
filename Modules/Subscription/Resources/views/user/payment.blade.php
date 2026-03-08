@extends($active_theme)
@section('title')
    <title>{{ $service->name }}</title>
    <title>{{ $service->seo_title }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ $service->seo_description }}">
@endsection

@section('frontend-content')
    <!--=========================
                                                                                                                                                                                                                                                                                                                                                                                            BREADCRUMB START
                                                                                                                                                                                                                                                                                                                                                                                        ==========================-->
    <div class="wsus__breadcrumb" style="background: url({{ asset($breadcrumb->image) }});">
        <div class="wsus__breadcrumb_overlay pt_90 xs_pt_60 pb_95 xs_pb_65">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <nav aria-label="breadcrumb">
                            <h1>{{ __('Booking Information') }}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('Booking Information') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=========================
                                                                                                                                                                                                                                                                                                                                                                                            BREADCRUMB END
                                                                                                                                                                                                                                                                                                                                                                                        ==========================-->

    <!--=========================
                                                                                                                                                                                                                                                                                                                                                                                            BOOKING CONFIRM START
                                                                                                                                                                                                                                                                                                                                                                                        ==========================-->
    <section class="wsus__booking_confirm mt_100 xs_mt_70 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8">
                    <div class="wsus__booking_area">
                        <ul class="booking_bar d-flex flex-wrap">
                            <li class="active">1 <span>{{ __('Service') }}</span></li>
                            <li class="active">2 <span>{{ __('Information') }}</span></li>
                            <li class="active">3 <span>{{ __('Confirmation') }}</span></li>
                        </ul>
                        <div class="wsus__booking_img">
                            <img class="img-fluid w-100" src="{{ asset($service->image) }}" alt="booking images">
                        </div>
                        <div class="wsus__service_booking">
                            <h3>{{ __('Booking Information') }}</h3>
                            <p><span>{{ __('Name') }}:</span> {{ html_decode($customer->name) }}</p>
                            <p><span>{{ __('Email') }}:</span> {{ html_decode($customer->email) }}</p>
                            <p><span>{{ __('Phone') }}:</span> {{ html_decode($customer->phone) }}</p>
                            <p><span>{{ __('Address') }}:</span> {{ html_decode($customer->address) }}</p>
                            <p><span>{{ __('Date') }}:</span> {{ $extra_services->date }}</p>
                            <p><span>{{ __('Post Code') }}:</span> {{ html_decode($customer->post_code) }}</p>
                            <p><span>{{ __('Order Note') }}:</span> {{ html_decode($customer->order_note) }}</p>
                        </div>
                    </div>

                    <div class="wsus__booking_payment d-flex flex-wrap">
                        <div class="row payment_methods">
                            <h5>{{ __('Select a Payment Method') }}</h5>
                            @forelse ($paymentMethods as $key => $payment)
                                @if ($payment->status)
                                    <div class="col-md-3 form-group payment_method">
                                        <label for="payment_method_{{ $key }}"
                                            @if (!$payment->isCurrencySupported) title="{{ str($payment->name)->title() . ' ' }}{{ __('does not support the currency:') . ' ' }}{{ getSessionCurrency() }}" @endif>
                                            <input id="payment_method_{{ $key }}" name="payment_method"
                                                form="payment_form" type="radio" value="{{ $key }}"
                                                @disabled(!$payment->isCurrencySupported)>
                                            <img src="{{ $payment->logo }}" alt="{{ str($payment->name)->title() }}">
                                        </label>
                                    </div>
                                @endif
                            @empty
                                <div class="col-md-12 form-group payment_method">
                                    <p>{{ __('No payment method available') }}</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <div class="wsus__sidebar" id="sticky_sidebar">
                        <div class="wsus__booking_summery m-0">
                            <h3>{{ __('Booking Summery') }}</h3>
                            <ul>
                                @foreach ($package_features as $package_feature)
                                    <li>{{ $package_feature }}</li>
                                @endforeach
                            </ul>
                            <div class="wsus__booking_cost">
                                <p>{{ __('Package Fee') }} <span>
                                        {{ currency($service->price) }}
                                    </span></p>
                                <ul>
                                    @if ($extra_services->ids)
                                        @foreach ($extra_services->ids as $index => $id)
                                            <li>
                                                <p>{{ $extra_services->names[$index] }}
                                                    <b>x{{ $extra_services->quantities[$index] }}</b>
                                                </p>
                                                <span>{{ currency($extra_services->prices[$index]) }}</span>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                                <h4>{{ __('Extra Service') }} <span>
                                        {{ currency($extra_services->extra_total) }}
                                    </span></h4>
                                <p>{{ __('Subtotal') }} <span>
                                        {{ currency($extra_services->sub_total) }}
                                    </span></p>
                                <p>{{ __('Discount') }} (-) <span>
                                        {{ currency($coupon_discount) }}
                                    </span></p>

                                @include('subscription::user.grand-total', ['grand_total' => $grand_total])

                                <form
                                    action="{{ session()->has('coupon_code') && session()->has('offer_percentage') ? route('remove-coupon') : route('apply-coupon') }}">
                                    <input name="coupon" type="text"
                                        value="{{ old('coupon', session('coupon_code')) }}"
                                        placeholder="{{ __('Coupon Code') }}" autocomplete="off" required>

                                    <input name="provider_id" type="hidden" value="{{ $service->provider_id }}">

                                    @if (session()->has('coupon_code') && session()->has('offer_percentage'))
                                        <button class="common_btn bg-danger">{{ __('Remove') }}</button>
                                    @else
                                        <button class="common_btn ">{{ __('Apply') }}</button>
                                    @endif
                                </form>

                                <form id="payment_form" action="{{ route('user.sub.complete.booking') }}" method="post">
                                    @csrf
                                    <input name="slug" type="hidden" value="{{ $service->slug }}">
                                    <button class="btn btn-success" form="payment_form"
                                        type="submit">{{ __('Confirm & Pay') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('css')
    <style>
        .payment_methods .form-group {
            padding: 10px;
            margin: 10px 0;
        }

        .payment_methods .form-group label {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .payment_methods .form-group input[type="radio"] {
            display: none;
        }

        .payment_method label {
            display: block !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            height: 95px;
        }

        .payment_methods .form-group img {
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .payment_methods .form-group input[type="radio"]:checked+img {
            border-color: #356DF1;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            transform: scale(1.1);
        }

        .payment_methods .form-group input[type="radio"]:disabled+img {
            opacity: 0.5;
            cursor: not-allowed;
            box-shadow: none;
        }

        #show_free_msg {
            background-color: #efeff8;
            padding: 1px;
        }
    </style>
@endpush

@push('js')
    <script>
        "use strict";

        $(document).ready(function() {
            $('input[name="payment_method"]').change(function() {
                var paymentMethod = $(this).val();

                if ("{{ config('app.app_mode') }}" == 'DEMO') {
                    toastr.error("{{ __('This Is Demo Version. You Can Not Change Anything') }}");
                    return;
                }

                $.ajax({
                    url: "{{ route('user.sub.get-amount-conversion') }}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        method: paymentMethod,
                        amount: '{{ $grand_total }}'
                    },
                    success: function(response) {
                        $('#gateway_fee_element').remove();
                        $('#grand_total_element').remove();
                        $('#insertTotalAmounts').after(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        toastr.error("{{ __('Something went wrong') }}!");
                    }
                });
            });
        });
    </script>
@endpush
