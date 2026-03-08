@php
    $paymentService = app(\Modules\BasicPayment\app\Services\PaymentMethodService::class);
    $bank_status = $paymentService->isActive($paymentService::BANK_PAYMENT);
    $bank_information = $paymentService->getGatewayDetails($paymentService::BANK_PAYMENT)->bank_information ?? '';
    $paymentUrl = route('pay.via-bank');
@endphp

@isset($token)
    @php
        if (!$token && request()->route()->hasParameter('token')) {
            $token = request()->route()->parameters['token'];
        }

        $paymentUrl = $token ? route('payment-api.bank-webview', ['token' => $token]) : route('pay.via-bank');
    @endphp
@endisset

{{-- Bank Payment --}}
@if ($bank_status)
    {!! nl2br($bank_information) !!}

    <form action="{{ $paymentUrl }}" method="post">
        @csrf
        <input name="order_uuid" type="hidden" value="{{ $orderId }}">
        <input name="order_type" type="hidden" value="{{ $type ?? 'order' }}">
        <!-- Bank Name -->
        <div class="my-1 form-group">
            <label for="bank_name">{{ __('Bank Name') }} <span
                    class="text-danger">*</span></label>
            <input class="form-control" id="bank_name" name="bank_name" type="text"
                placeholder="{{ __('Your bank name') }}" required>
        </div>

        <!-- Account Number -->
        <div class="my-1 form-group">
            <label for="account_number">{{ __('Account Number') }} <span
                    class="text-danger">*</span></label>
            <input class="form-control" id="account_number" name="account_number" type="text"
                placeholder="{{ __('Your bank account number') }}" required>
        </div>

        <!-- Routing Number -->
        <div class="my-1 form-group">
            <label for="routing_number">{{ __('Routing Number') }}</label>
            <input class="form-control" id="routing_number" name="routing_number" type="text"
                placeholder="{{ __('Your bank routing number') }}">
        </div>

        <!-- Branch -->
        <div class="my-1 form-group">
            <label for="branch">{{ __('Branch') }} <span
                    class="text-danger">*</span></label>
            <input class="form-control" id="branch" name="branch" type="text"
                placeholder="{{ __('Your bank branch name') }}" required>
        </div>

        <!-- Transaction -->
        <div class="my-1 form-group">
            <label for="transaction">{{ __('Transaction') }} <span
                    class="text-danger">*</span></label>
            <input class="form-control" id="transaction" name="transaction" type="text"
                placeholder="{{ __('Provide your transaction') }}" required>
        </div>

        <button class="mt-2 btn btn-primary">{{ __('Submit') }}</button>
    </form>
@endif
