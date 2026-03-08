@extends('website.provider.master_layout')
@section('title')
    <title>{{ __('Subscription Payment') }}</title>
@endsection
@section('provider-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Subscription Payment') }}</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-md-8 col-lg-9">
                        <div class="row payment_methods justify-content-start">
                            <h5>{{ __('Select a Payment Method') }}</h5>
                            @forelse ($paymentMethods as $key => $payment)
                                @if ($payment->status)
                                    <div class="col-md-3 col-lg-2">
                                        <div class="form-group payment_method">
                                            <label for="payment_method_{{ $key }}"
                                                @if (!$payment->isCurrencySupported) title="{{ str($payment->name)->title() . ' ' }}{{ __('does not support the currency:') . ' ' }}{{ getSessionCurrency() }}" @endif>
                                                <input id="payment_method_{{ $key }}" name="payment_method"
                                                    form="payment_form" type="radio" value="{{ $key }}"
                                                    @disabled(!$payment->isCurrencySupported)>
                                                <img class="img-fluid" src="{{ $payment->logo }}"
                                                    alt="{{ str($payment->name)->title() }}">
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <div class="col-md-12">
                                    <div class="form-group payment_method">
                                        <p>{{ __('No payment method available') }}</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        <div class="row confirm_pay_btn">
                            <div class="col-12 text-center">
                                <form id="payment_form"
                                    action="{{ route('provider.subscription-order-store', $plan->id) }}" method="post">
                                    @csrf
                                    <button class="btn btn-success" form="payment_form"
                                        type="submit">{{ __('Confirm & Pay') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <div class="pricing pricing-highlight">
                            <div class="pricing-title">
                                {{ $plan->plan_name }}
                            </div>
                            <div class="pricing-padding p-0 mt-3">
                                <div class="pricing-price mb-4">
                                    <div>
                                        {{ $setting->currency_icon }}{{ sprintf('%0.2f', $plan->plan_price) }}
                                        <span>
                                            @if ($plan->expiration_date == 'monthly')
                                                {{ __('Monthly') }}
                                            @elseif ($plan->expiration_date == 'yearly')
                                                {{ __('Yearly') }}
                                            @elseif ($plan->expiration_date == 'lifetime')
                                                {{ __('Lifetime') }}
                                            @endif
                                        </span>
                                    </div>

                                </div>
                                <div class="pricing-details">
                                    <div class="pricing-item">
                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>

                                        @if ($plan->maximum_service == -1)
                                            <div class="pricing-item-label">{{ __('Unlimited Services') }}</div>
                                        @else
                                            <div class="pricing-item-label">{{ $plan->maximum_service }}
                                                {{ __('Services') }}</div>
                                        @endif

                                    </div>

                                    <div class="pricing-item">
                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                        <div class="pricing-item-label">{{ __('Unlimited Booking') }}</div>
                                    </div>

                                    <div class="pricing-item">
                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                        <div class="pricing-item-label">{{ __('Custom Working Schedule') }}</div>
                                    </div>

                                    <div class="pricing-item">
                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                        <div class="pricing-item-label">{{ __('Support Ticket') }}</div>
                                    </div>

                                    <div class="pricing-item">
                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                        <div class="pricing-item-label">{{ __('Live Chat') }}</div>
                                    </div>

                                </div>
                                <div class="prices">
                                    @include('subscription::user.grand-total', [
                                        'grand_total' => $plan->plan_price,
                                    ])
                                </div>
                            </div>

                        </div>
                    </div>
                    {{-- <div class="col-12 text-center">
                        <form id="payment_form" action="{{ route('provider.subscription-order-store', $plan->id) }}"
                            method="post">
                            @csrf
                            <button class="btn btn-success" form="payment_form"
                                type="submit">{{ __('Confirm & Pay') }}</button>
                        </form>
                    </div> --}}
                </div>
            </div>
        </section>
    </div>
@endsection

@push('css')
    <style>
        .row.payment_methods {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

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

        .payment_methods .form-group img {
            border: 2px solid transparent;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
                        amount: '{{ $plan->plan_price }}'
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
