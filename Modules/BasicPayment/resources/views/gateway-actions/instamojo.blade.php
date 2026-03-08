@php
    $paymentMethodEnum = app(\Modules\BasicPayment\app\Services\PaymentMethodService::class);
    $status = $paymentMethodEnum->isActive($paymentMethodEnum::INSTAMOJO);

    $paymentUrl = route('pay.via-instamojo', ['uuid' => $orderId, 'type' => $type]);
@endphp

@isset($token)
    @php
        if (!$token && request()->route()->hasParameter('token')) {
            $token = request()->route()->parameters['token'];
        }

        $paymentUrl = $token
            ? route('payment-api.instamojo-webview', ['token' => $token, 'uuid' => $orderId, 'type' => $type])
            : route('pay.via-instamojo', ['uuid' => $orderId, 'type' => $type]);
    @endphp
@endisset

@if ($status)
    <div class="gap-2 mx-auto d-grid">
        <a class="btn btn-lg btn-primary" id="payBtn" href="{{ $paymentUrl }}">
            {{ __('Pay Now') }}
        </a>

        <script>
            "use strict";
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('payBtn').click();
            });
        </script>
    </div>
@endif
