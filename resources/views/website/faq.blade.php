@extends($active_theme)
@section('title')
    <title>{{ __('FAQ') }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ __('FAQ') }}">
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
                            <h1>{{ __('FAQ') }}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('FAQ') }}</li>
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
                    FAQ START
                ==========================-->
    <section class="wsus__faq mt_90 xs_mt_60 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 m-auto">
                    <div class="wsus__section_heading text-center mb_30">
                        <h2>{{ __('Frequently Asked Questions') }}</h2>
                        <p style="font-size: 16px; line-height: 1.8; color: #666; margin-bottom: 15px;">
                            {{ __('This section has been created to answer the most common questions and provide quick, clear information about our services and processes. Our goal is to make your experience as simple and transparent as possible.') }}
                        </p>
                        <p style="font-size: 16px; line-height: 1.8; color: #666;">
                            {{ __('If you do not find the answer you are looking for, please feel free to contact our support team. We are always happy to help and provide any additional information you may need.') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-6 col-md-12 col-lg-6">
                    <div class="wsus__faq_area">
                        <div class="accordion accordion-flush" id="accordionFlushExample">

                            @foreach ($faqs as $index => $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne-{{ $faq->id }}">
                                        <button class="accordion-button collapsed" data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapseOne-{{ $faq->id }}" type="button"
                                            aria-expanded="false" aria-controls="flush-collapseOne-{{ $faq->id }}">
                                            {{ ++$index }}. {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div class="accordion-collapse collapse" id="flush-collapseOne-{{ $faq->id }}"
                                        data-bs-parent="#accordionFlushExample"
                                        aria-labelledby="flush-headingOne-{{ $faq->id }}">
                                        <div class="accordion-body">
                                            {!! clean($faq->answer) !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 mt_20 xs_mt_0">
                    <div class="wsus__sidebar" id="sticky_sidebar">
                        <div class="wsus__review_input contact_input">
                            <h4>{{ __('Feel Free to Get in Touch') }}</h4>
                            <form method="POST" action="{{ route('send-contact-message') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6 col-md-6">
                                        <fieldset>
                                            <legend>{{ __('Name') }}*</legend>
                                            <input name="name" type="text">
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <fieldset>
                                            <legend>{{ __('phone') }}</legend>
                                            <input name="phone" type="text"
                                                placeholder="{{ __('e.g. +92345689008876') }}">
                                            <small class="text-muted d-block mt-1">{{ __('Enter + then your country code and number with no spaces (e.g. +92345689008876).') }}</small>
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-12">
                                        <fieldset>
                                            <legend>{{ __('email') }}*</legend>
                                            <input name="email" type="email">
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-12">
                                        <fieldset>
                                            <legend>{{ __('subject') }}*</legend>
                                            <input name="subject" type="text">
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-12">
                                        <fieldset>
                                            <legend>{{ __('message') }}*</legend>
                                            <textarea name="message" rows="4"></textarea>
                                        </fieldset>
                                    </div>

                                    @if ($recaptchaSetting->status == 'active')
                                        <div class="col-xl-12">
                                            <div class="wsus__single_com mt_20">
                                                <div class="g-recaptcha" data-sitekey="{{ $recaptchaSetting->site_key }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-xl-12">
                                        <button class="common_btn mt_20" type="submit">{{ __('Send message') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================
                    FAQ END
                ==========================-->
@endsection
