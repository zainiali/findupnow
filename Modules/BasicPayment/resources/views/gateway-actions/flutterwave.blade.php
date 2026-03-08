@php
    $paymentService = app(\Modules\BasicPayment\app\Services\PaymentMethodService::class);
    $status = $paymentService->isActive($paymentService::FLUTTERWAVE);

    $paymentUrl = route('pay.via-flutterwave', ['uuid' => $orderId, 'type' => $type]);

    $returnUrl =
        $type == 'order' ? route('dashboard', ['id' => $orderId]) : route('provider.purchase-history-show', $orderId);

    $failedUrl = back()->getTargetUrl();
@endphp

@isset($token)
    @php
        if (!$token && request()->route()->hasParameter('token')) {
            $token = request()->route()->parameters['token'];
        }

        $paymentUrl = $token
            ? route('payment-api.flutterwave-webview', ['token' => $token, 'uuid' => $orderId, 'type' => $type])
            : route('pay.via-flutterwave', ['uuid' => $orderId, 'type' => $type]);

        $returnUrl = route('payment-api.webview-success-payment', ['token' => $token]);
        $failedUrl = route('payment-api.webview-failed-payment', ['token' => $token]);
    @endphp
@endisset

@if ($status)
    <div class="gap-2 mx-auto d-grid">
        <button class="btn btn-lg btn-primary" id="payBtn" onclick="flutterwavePayment()">
            {{ __('Pay Now') }}
        </button>

        <script>
            "use strict";
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('payBtn').click();
            });
        </script>
    </div>

    <script src="https://checkout.flutterwave.com/v3.js"></script>

    <script>
        "use strict";

        function flutterwavePayment() {
            if ("{{ config('app.app_mode') }}" == 'DEMO') {
                toastr.error("{{ __('This Is Demo Version. You Can Not Change Anything') }}");
                return;
            }

            FlutterwaveCheckout({
                public_key: "{{ $paymentService->getGatewayDetails($paymentService::FLUTTERWAVE)->flutterwave_public_key }}",
                tx_ref: "{{ substr(rand(0, time()), 0, 10) }}",
                amount: "{{ $payable_with_charge }}",
                currency: "{{ $currency_code }}",
                country: "{{ $country_code ?? 'NG' }}",
                payment_options: " ",
                customer: {
                    email: "{{ auth()->user()->email ?? 'unknown@email.com' }}",
                    phone_number: "{{ auth()->user()->phone ?? '0000000000' }}",
                    name: "{{ auth()->user()->name ?? 'Test' }}",
                },
                callback: function(data) {
                    var tnx_id = data.transaction_id;
                    var _token = "{{ csrf_token() }}";
                    $.ajax({
                        type: 'post',
                        data: {
                            tnx_id,
                            _token,
                            token: "{{ $token ?? '' }}",
                        },
                        url: "{{ $paymentUrl }}",
                        success: function(response) {
                            window.location.href =
                                "{{ $returnUrl }}";
                        },
                        error: function(err) {
                            toastr.error("{{ __('Payment failed, please try again') }}");
                            window.location.href = "{{ $failedUrl }}";
                        }
                    });
                },
                customizations: {
                    title: "{{ $paymentService->getGatewayDetails($paymentService::FLUTTERWAVE)->flutterwave_app_name }}",
                    logo: "{{ asset($paymentService->getGatewayDetails($paymentService::FLUTTERWAVE)->flutterwave_image) }}",
                },
            });

        }
    </script>
@endif
