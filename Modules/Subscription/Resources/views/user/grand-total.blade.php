<p class="d-none" id="insertTotalAmounts"></p>
@isset($gatewayFee)
    <p id="gateway_fee_element">{{ __('Gateway Fee') }} (+) <span id="gateway_fee">
            {{ currency($gatewayFee) }}
        </span></p>
@endisset

<h5 id="grand_total_element">{{ __('Total') }} <span id="grand_total">
        {{ currency($grand_total) }}
    </span></h5>
