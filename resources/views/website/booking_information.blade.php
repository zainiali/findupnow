@extends($active_theme)
@section('title')
    <title>{{ $service->name }}</title>
    <title>{{ $service->seo_title }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ $service->seo_description }}">
@endsection

@section('frontend-content')
    <!--=========================
                                                                    BREADCRUMB START
                                                                ==========================-->
    <div class="wsus__breadcrumb" style="background: url({{ asset($breadcrumb->image) }});">
        <div class="wsus__breadcrumb_overlay pt_90 xs_pt_60 pb_95 xs_pb_65">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <nav aria-label="breadcrumb">
                            <h1>{{ __('Booking Information') }}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('Booking Information') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=========================
                                                                    BREADCRUMB END
                                                                ==========================-->

    <!--=========================
                                                                    BOOKING INFO START
                                                                ==========================-->
    <section class="wsus__booking_info mt_100 xs_mt_70 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="wsus__booking_area">
                        <ul class="booking_bar d-flex flex-wrap">
                            <li class="active">1 <span>{{ __('Service') }}</span></li>
                            <li class="active">2 <span>{{ __('Information') }}</span></li>
                            <li>3 <span>{{ __('Confirmation') }}</span></li>
                        </ul>
                        <div class="wsus__review_input mt_30 p-0 border-0">

                            @if ($setting->commission_type == 'subscription')
                                @if (Module::isEnabled('Subscription'))
                                    <form id="customer_info_form" action="{{ route('user.sub.payment', $service->slug) }}">
                                @endif
                            @else
                                <form id="customer_info_form" action="{{ route('user.sub.payment', $service->slug) }}">
                            @endif

                            <h3>{{ __('Booking Information') }}</h3>

                            <div class="row">
                                <div class="col-xl-6">
                                    <fieldset>
                                        <legend>{{ __('Name') }}*</legend>
                                        <input name="name" type="text">
                                    </fieldset>
                                </div>
                                <div class="col-xl-6">
                                    <fieldset>
                                        <legend>{{ __('email') }}</legend>
                                        <input name="email" type="text">
                                    </fieldset>
                                </div>
                                <div class="col-xl-6">
                                    <fieldset>
                                        <legend>{{ __('Phone') }}*</legend>
                                        <input name="phone" type="text"
                                            placeholder="{{ __('e.g. +92345689008876') }}">
                                        <small class="text-muted d-block mt-1">{{ __('Enter + then your country code and number with no spaces (e.g. +92345689008876).') }}</small>
                                    </fieldset>
                                </div>
                                <div class="col-xl-6">
                                    <fieldset>
                                        <legend>{{ __('post code') }}</legend>
                                        <input name="post_code" type="text">
                                    </fieldset>
                                </div>
                                <div class="col-xl-12">
                                    <fieldset>
                                        <legend>{{ __('your address') }}*</legend>
                                        <input name="address" type="text">
                                    </fieldset>
                                </div>
                                <div class="col-xl-12">
                                    <fieldset>
                                        <legend>{{ __('order note') }}</legend>
                                        <textarea name="order_note" rows="5" placeholder="{{ __('Write a order note') }}"></textarea>
                                    </fieldset>
                                </div>

                                <div class="col-xl-12">
                                    <div class="wsus__login_check d-flex flex-wrap mt_20">
                                        <div class="form-check">
                                            <input class="" id="flexCheckDefault" name="agree_with" type="checkbox"
                                                required>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                {{ __('I agree with') }} <a
                                                    href="{{ route('terms-and-conditions') }}">{{ __('Terms and Conditions') }}</a>
                                            </label>
                                        </div>

                                    </div>
                                </div>

                                <input name="extras" type="hidden" value="{{ $extras }}">
                            </div>
                            </form>
                        </div>
                    </div>
                    <ul class="wsus__booking_button_area d-flex">
                        <li><a class="common_btn"
                                href="{{ route('ready-to-booking', $service->slug) }}">{{ __('Previous') }}</a></li>
                        <li><a class="common_btn" id="customer_info_btn" href="javascript:;">{{ __('Next') }}</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <div class="wsus__sidebar" id="sticky_sidebar">
                        <div class="wsus__booking_summery m-0">
                            <h3>{{ __('Booking Summery') }}</h3>
                            <ul>
                                @foreach ($package_features as $package_feature)
                                    <li>{{ $package_feature }}</li>
                                @endforeach
                            </ul>
                            <div class="wsus__booking_cost">
                                <p>{{ __('Package Fee') }} <span>
                                        {{ currency($service->price) }}
                                    </span></p>
                                <ul>
                                    @if ($extra_services->ids)
                                        @foreach ($extra_services->ids as $index => $id)
                                            <li>
                                                <p>{{ $extra_services->names[$index] }}
                                                    <b>x{{ $extra_services->quantities[$index] }}</b>
                                                </p>
                                                <span>{{ currency($extra_services->prices[$index]) }}</span>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                                <h4>{{ __('Extra Service') }} <span>
                                        {{ currency($extra_services->extra_total) }}
                                    </span></h4>
                                <p>{{ __('Subtotal') }} <span>
                                        {{ currency($extra_services->sub_total) }}
                                    </span></p>
                                <h5>{{ __('Total') }} <span>
                                        {{ currency($extra_services->total) }}
                                    </span></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================
                                                                    BOOKING INFO END
                                                                ==========================-->

    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                $("#customer_info_btn").on("click", function() {
                    $("#customer_info_form").submit();
                })
            });
        })(jQuery);
    </script>

@endsection
