@php
    $paymentService = app(\Modules\BasicPayment\app\Services\PaymentMethodService::class);
    $status = $paymentService->isActive($paymentService::PAYSTACK);
    $paystack_public_key = $paymentService->getGatewayDetails($paymentService::PAYSTACK)->paystack_public_key ?? '';
    $paymentUrl = route('pay.via-paystack', ['uuid' => $orderId, 'type' => $type]);
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
            ? route('payment-api.paystack-webview', ['token' => $token, 'uuid' => $orderId, 'type' => $type])
            : route('pay.via-paystack', ['uuid' => $orderId, 'type' => $type]);

        $returnUrl = route('payment-api.webview-success-payment', ['token' => $token]);
        $failedUrl = route('payment-api.webview-failed-payment', ['token' => $token]);
    @endphp
@endisset

{{-- Paystack Payment --}}
@if ($status)
    <div class="gap-2 mx-auto d-grid">
        <button class="btn btn-lg btn-primary" id="paystackPaymentBtn" type="button"
            onclick="payWithPaystack()">{{ __('Pay Now') }}</button>

        <script>
            "use strict";
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('paystackPaymentBtn').click();
            });
        </script>
    </div>

    <script src="https://js.paystack.co/v1/inline.js"></script>

    <script>
        "use strict";

        function payWithPaystack() {
            if ("{{ config('app.app_mode') }}" == 'DEMO') {
                toastr.error("{{ __('This Is Demo Version. You Can Not Change Anything') }}");
                return;
            }

            var handler = PaystackPop.setup({
                key: '{{ $paystack_public_key }}',
                email: '{{ auth()->user()->email ?? 'unknown@email.com' }}',
                amount: '{{ $payable_with_charge * 100 }}',
                currency: "{{ $currency_code }}",
                callback: function(response) {
                    let reference = response.reference;
                    let tnx_id = response.transaction;
                    let _token = "{{ csrf_token() }}";

                    $.ajax({
                        type: "post",
                        data: {
                            reference,
                            tnx_id,
                            _token,
                        },
                        url: "{{ $paymentUrl }}",
                        success: function(response) {
                            window.location.href =
                                "{{ $returnUrl }}";
                        },
                        error: function(response) {
                            toastr.error("{{ __('Payment failed, please try again') }}");
                            window.location.href = "{{ $failedUrl }}";
                        }
                    });
                },
                onClose: function() {
                    toastr.error('window closed');
                }
            });
            handler.openIframe();
        }
    </script>
@endif
