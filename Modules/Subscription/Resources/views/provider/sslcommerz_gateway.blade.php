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
                                <form action="{{ route('provider.store-sslcommerz-gateway') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <x-admin.form-input id="sslcommerz_store_id" name="sslcommerz_store_id"
                                                value="{{ $sslcommerz->sslcommerz_store_id }}"
                                                label="{{ __('Store ID') }}" />
                                        </div>

                                        <div class="form-group col-md-12">
                                            <x-admin.form-input id="sslcommerz_store_password"
                                                name="sslcommerz_store_password"
                                                value="{{ $sslcommerz->sslcommerz_store_password }}"
                                                label="{{ __('Store Password') }}" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <x-admin.form-switch name="sslcommerz_status" label="{{ __('Status') }}"
                                            active_value="active" inactive_value="inactive" :checked="$sslcommerz->sslcommerz_status == 'active'" />
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
