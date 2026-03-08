@extends($active_theme)

@section('title')
    <title>{{ __('Subscription Plan') }}</title>
@endsection

@section('title')
    <meta name="description" content="{{ __('Subscription Plan') }}">
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
                            <h1>{{ __('Subscription Plan') }}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('Subscription Plan') }}</li>
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

    <!--============================
                        PRICING PART START
                    ==============================-->
    <section class="wsus__pricing pt_75 xs_pt_45 pb_100 xs_pb_70">
        <div class="container">
            <div class="row">
                @foreach ($plans as $index => $plan)
                    <div class="col-xl-4 col-md-6">
                        <div class="wsus__single_pricing">
                            <span class="wsus_price_head">{{ $plan->plan_name }}</span>
                            <p class="wsus__pricing_tk">
                                {{ currency($plan->plan_price) }}

                                <span>
                                    @if ($plan->expiration_date == 'monthly')
                                        {{ __('Monthly') }}
                                    @elseif ($plan->expiration_date == 'yearly')
                                        {{ __('Yearly') }}
                                    @elseif ($plan->expiration_date == 'lifetime')
                                        {{ __('Lifetime') }}
                                    @endif

                                </span>
                            </p>
                            <ul>

                                @if ($plan->maximum_service == -1)
                                    <li>{{ __('Unlimited Services') }}</li>
                                @else
                                    <li>{{ $plan->maximum_service }} {{ __('Services') }}</li>
                                @endif

                                <li>{{ __('Unlimited Booking') }}</li>
                                <li>{{ __('Custom Working Schedule') }}</li>
                                <li>{{ __('Support Ticket') }}</li>
                                <li>{{ __('Live Chat') }}</li>
                            </ul>

                            @if ($plan->plan_price == 0)
                                <a class="common_btn"
                                    href="{{ route('provider.subscription.free-enroll', $plan->id) }}">{{ __('Trail Now') }}</a>
                            @else
                                <a class="common_btn"
                                    href="{{ route('provider.subscription-payment', $plan->id) }}">{{ __('Purchase Now') }}</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--============================
                        PRICING PART END
                    ==============================-->
@endsection
