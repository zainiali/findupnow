@extends('website.provider.master_layout')
@section('title')
    <title>{{ __('Subscription Plan') }}</title>
@endsection
@section('provider-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Subscription Plan') }}</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    @foreach ($plans as $index => $plan)
                        <div class="col-12 col-md-4 col-lg-4">
                            <div class="pricing pricing-highlight">
                                <div class="pricing-title">
                                    {{ $plan->plan_name }}
                                </div>
                                <div class="pricing-padding">
                                    <div class="pricing-price">
                                        <div>{{ currency($plan->plan_price) }}</div>
                                        <div>
                                            @if ($plan->expiration_date == 'monthly')
                                                {{ __('Monthly') }}
                                            @elseif ($plan->expiration_date == 'yearly')
                                                {{ __('Yearly') }}
                                            @elseif ($plan->expiration_date == 'lifetime')
                                                {{ __('Lifetime') }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="pricing-details">
                                        <div class="pricing-item">
                                            <div class="pricing-item-icon"><i class="fas fa-check"></i></div>

                                            @if ($plan->maximum_service == -1)
                                                <div class="pricing-item-label">{{ __('Unlimited Services') }}</div>
                                            @else
                                                <div class="pricing-item-label">{{ $plan->maximum_service }}
                                                    {{ __('Services') }}</div>
                                            @endif

                                        </div>

                                        <div class="pricing-item">
                                            <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                            <div class="pricing-item-label">{{ __('Unlimited Booking') }}</div>
                                        </div>

                                        <div class="pricing-item">
                                            <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                            <div class="pricing-item-label">{{ __('Custom Working Schedule') }}</div>
                                        </div>

                                        <div class="pricing-item">
                                            <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                            <div class="pricing-item-label">{{ __('Support Ticket') }}</div>
                                        </div>

                                        <div class="pricing-item">
                                            <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                            <div class="pricing-item-label">{{ __('Live Chat') }}</div>
                                        </div>

                                    </div>
                                </div>
                                <div class="pricing-cta">
                                    @if ($plan->plan_price == 0)
                                        <a href="{{ route('provider.subscription.free-enroll', $plan->id) }}">{{ __('Trail Now') }}
                                            <i class="fas fa-arrow-right"></i></a>
                                    @else
                                        <a href="{{ route('provider.subscription-payment', $plan->id) }}">{{ __('Purchase Now') }}
                                            <i class="fas fa-arrow-right"></i></a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
