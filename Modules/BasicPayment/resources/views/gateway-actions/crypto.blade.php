@php
    $paymentService = app(\Modules\BasicPayment\app\Services\PaymentMethodService::class);
    $status = $paymentService->isActive($paymentService::CRYPTO);
    $paymentUrl = route('pay.via-crypto', ['uuid' => $orderId, 'type' => $type]);
@endphp

@if ($status)
    @isset($token)
        @php
            if (!$token && request()->route()->hasParameter('token')) {
                $token = request()->route()->parameters['token'];
            }

            $paymentUrl = $token
                ? route('payment-api.via-crypto', ['token' => $token, 'uuid' => $orderId, 'type' => $type])
                : route('pay.via-crypto', ['uuid' => $orderId, 'type' => $type]);
        @endphp
    @endisset

    <a class="btn btn-primary" id="cryptoPayBtn" href="{{ $paymentUrl }}">
        {{ __('Pay with CoinGate') }}
    </a>

    <script>
        "use strict";
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('cryptoPayBtn').click();
        });
    </script>
@else
    <div class="alert alert-danger">
        {{ __('CoinGate payment gateway is not active.') }}
    </div>
@endif
