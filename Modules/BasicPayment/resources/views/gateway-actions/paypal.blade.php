@php
    $paymentService = app(\Modules\BasicPayment\app\Services\PaymentMethodService::class);
    $paypal_status = $paymentService->isActive($paymentService::PAYPAL);
    $paymentUrl = route('pay.via-paypal', ['id' => $orderId, 'type' => $type]);
@endphp

@isset($token)
    @php
        if (!$token && request()->route()->hasParameter('token')) {
            $token = request()->route()->parameters['token'];
        }

        $paymentUrl = $token
            ? route('payment-api.paypal-webview', ['token' => $token, 'id' => $orderId, 'type' => $type])
            : route('pay.via-paypal', ['id' => $orderId, 'type' => $type]);
    @endphp
    <input name="token" form="payment-form" type="hidden" value="{{ $token }}">
@endisset

@if ($paymentService->isSupportedGateway($paymentService::PAYPAL) && $paypal_status)
    <div class="gap-2 mx-auto d-grid">
        <a class="btn btn-block btn-success" id="payBtn" href="{{ $paymentUrl }}">{{ __('Pay Now') }}
        </a>

        <script>
            "use strict";
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('payBtn').click();
            });
        </script>
    </div>
@endif
