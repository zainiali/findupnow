@extends('admin.master_layout')
@section('title')
    <title>{{ __('Basic Payment') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            {{-- Breadcrumb --}}
            <x-admin.breadcrumb title="{{ __('Basic Payment') }}" :list="[
                __('Dashboard') => route('admin.dashboard'),
                __('Settings') => route('admin.settings'),
                __('Basic Payment') => '#',
            ]" />
            <div class="section-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-pills flex-column" id="basicPaymentTab" role="tablist">
                                    @include('basicpayment::tabs.navbar')
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content" id="myTabContent4">
                                    @include('basicpayment::sections.stripe')
                                    @include('basicpayment::sections.paypal')
                                    @include('basicpayment::sections.direct-bank')
                                    @include('basicpayment::sections.razorpay')
                                    @include('basicpayment::sections.flutterwave')
                                    @include('basicpayment::sections.paystack')
                                    @include('basicpayment::sections.mollie')
                                    @include('basicpayment::sections.instamojo')
                                    @include('basicpayment::sections.sslcommerz')
                                    @include('basicpayment::sections.crypto')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('js')
    <script src="{{ asset('backend/js/jquery.uploadPreview.min.js') }}"></script>
    <script>
        "use strict";
        $.uploadPreview({
            input_field: "#stripe_image_upload",
            preview_box: "#stripe_image_preview",
            label_field: "#stripe_image_label",
            label_default: "{{ __('Choose Image') }}",
            label_selected: "{{ __('Change Image') }}",
            no_label: false,
            success_callback: null
        });
        $.uploadPreview({
            input_field: "#paypal_image_upload",
            preview_box: "#paypal_image_preview",
            label_field: "#paypal_image_label",
            label_default: "{{ __('Choose Image') }}",
            label_selected: "{{ __('Change Image') }}",
            no_label: false,
            success_callback: null
        });
        $.uploadPreview({
            input_field: "#bank_image_upload",
            preview_box: "#bank_image_preview",
            label_field: "#bank_image_label",
            label_default: "{{ __('Choose Image') }}",
            label_selected: "{{ __('Change Image') }}",
            no_label: false,
            success_callback: null
        });

        $.uploadPreview({
            input_field: "#flutterwave_image_upload",
            preview_box: "#flutterwave_image_preview",
            label_field: "#flutterwave_image_label",
            label_default: "{{ __('Choose Image') }}",
            label_selected: "{{ __('Change Image') }}",
            no_label: false,
            success_callback: null
        });

        $.uploadPreview({
            input_field: "#instamojo_image_upload",
            preview_box: "#instamojo_image_preview",
            label_field: "#instamojo_image_label",
            label_default: "{{ __('Choose Image') }}",
            label_selected: "{{ __('Change Image') }}",
            no_label: false,
            success_callback: null
        });

        $.uploadPreview({
            input_field: "#mollie_image_upload",
            preview_box: "#mollie_image_preview",
            label_field: "#mollie_image_label",
            label_default: "{{ __('Choose Image') }}",
            label_selected: "{{ __('Change Image') }}",
            no_label: false,
            success_callback: null
        });

        $.uploadPreview({
            input_field: "#paystack_image_upload",
            preview_box: "#paystack_image_preview",
            label_field: "#paystack_image_label",
            label_default: "{{ __('Choose Image') }}",
            label_selected: "{{ __('Change Image') }}",
            no_label: false,
            success_callback: null
        });

        $.uploadPreview({
            input_field: "#razorpay_image_upload",
            preview_box: "#razorpay_image_preview",
            label_field: "#razorpay_image_label",
            label_default: "{{ __('Choose Image') }}",
            label_selected: "{{ __('Change Image') }}",
            no_label: false,
            success_callback: null
        });

        $.uploadPreview({
            input_field: "#sslcommerz_image_upload",
            preview_box: "#sslcommerz_image_preview",
            label_field: "#sslcommerz_image_label",
            label_default: "{{ __('Choose Image') }}",
            label_selected: "{{ __('Change Image') }}",
            no_label: false,
            success_callback: null
        });

        $.uploadPreview({
            input_field: "#crypto_image_upload",
            preview_box: "#crypto_image_preview",
            label_field: "#crypto_image_label",
            label_default: "{{ __('Choose Image') }}",
            label_selected: "{{ __('Change Image') }}",
            no_label: false,
            success_callback: null
        });
    </script>
    <script>
        "use strict";
        //Tab active setup locally
        $(document).ready(function() {
            activeTabSetupLocally('basicPaymentTab')
        });
    </script>
@endpush
