@extends($active_theme)

@section('title')
    <title>{{ __('Complete Your Payment') }}</title>
@endsection

@section('frontend-content')
    <div class="wsus__breadcrumb" style="background: url({{ asset($breadcrumb->image) }});">
        <div class="wsus__breadcrumb_overlay pt_90 xs_pt_60 pb_95 xs_pb_65">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <nav aria-label="breadcrumb">
                            <h1>{{ __('Complete Payment') }}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('Complete Payment') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="wsus__booking_confirm mt_100 xs_mt_70 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4">
                    <div class="wsus__sidebar mb-4" id="sticky_sidebar">
                        <div class="wsus__booking_summery m-0">
                            <h3>{{ __('Total Payable') }}</h3>
                            <h3 class="mt-4">{{ $amount }} {{ $currencyCode }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8">
                    <div class="wsus__booking_area">
                        @includeIf($paymentViewPath, [
                            'type' => $type,
                            'orderId' => $orderId,
                            'payable_with_charge' => $amount,
                            'currency_code' => $currencyCode,
                        ])
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
