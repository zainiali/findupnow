@extends('website.provider.master_layout')
@section('title')
    <title>{{ __('SSLCommerz Gateway') }}</title>
@endsection
@section('provider-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('SSLCommerz Gateway') }}</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('provider.store-coin-gate-gateway') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <x-admin.form-input id="crypto_api_key" name="crypto_api_key"
                                                    value="{{ $coinGate->crypto_api_key }}"
                                                    label="{{ __('CoinGate API Key') }}" required="true" />
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="crypto_receive_currency">{{ __('CoinGate Receiving Currency') }}
                                                <span class="text-danger">*</span></label>
                                            @php
                                                $rCurrencies = [
                                                    'BTC' => 'Bitcoin',
                                                    'EUR' => 'Euro',
                                                    'USD' => 'US Dollar',
                                                    'GBP' => 'British Pound',
                                                    'ETH' => 'Ethereum',
                                                ];

                                            @endphp
                                            <select class="form-control select2" id="crypto_receive_currency"
                                                name="crypto_receive_currency">
                                                @foreach ($rCurrencies as $currency => $name)
                                                    <option value="{{ $currency }}" @selected($currency == old('crypto_receive_currency', $coinGate?->crypto_receive_currency))>
                                                        {{ $name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <x-admin.form-switch name="crypto_status" label="{{ __('Status') }}"
                                            active_value="active" inactive_value="inactive" :checked="$coinGate->crypto_status == 'active'" />
                                    </div>

                                    <x-admin.update-button :text="__('Update')" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
