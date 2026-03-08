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
                            <h1>{{ __('Ready to Booking') }}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('Ready to Booking') }}</li>
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

    {{-- =========================
                                                                                                                                                                                                                                            BOOKING SERVICE START - COMMENTED OUT
                                                                                                                                                                                                                                        ========================== --}}
    {{-- <section class="wsus__booking_service mt_100 xs_mt_70 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8">
                    <div class="wsus__booking_area">
                        <ul class="booking_bar d-flex flex-wrap">
                            <li class="active">1 <span>{{ __('Service') }}</span></li>
                            <li>2 <span>{{ __('Information') }}</span></li>
                            <li>3 <span>{{ __('Confirmation') }}</span></li>
                        </ul>
                        <div class="wsus__booking_img">
                            <img class="img-fluid w-100" src="{{ asset($service->image) }}" alt="booking images">
                        </div>
                        <div class="wsus__booking_text">
                            <h2>{{ $service->name }}</h2>

                            <div class="row">
                                @if (count($what_you_will_get) > 0)
                                    <div class="col-xl-6">
                                        <div class="wsus__booking_list_text">
                                            <h3>{{ __('What you will get') }}:</h3>
                                            <ul class="list">
                                                @foreach ($what_you_will_get as $get_item)
                                                    <li>{{ $get_item }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                                @if (count($benifits) > 0)
                                    <div class="col-xl-6">
                                        <div class="wsus__booking_list_text">
                                            <h3>{{ __('Benifits of the Package') }}:</h3>
                                            <ul class="list">
                                                @foreach ($benifits as $benifit)
                                                    <li>{{ $benifit }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            @if ($additional_services->count() > 0)
                                <div class="wsus__service_cart">
                                    <h4>{{ __('Upgrade your order with extras') }}</h4>
                                    <div class="wsus__service_cart_bg">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th class="images">{{ __('images') }}</th>
                                                        <th class="name">{{ __('Service Name') }}</th>
                                                        <th class="price">{{ __('Unit Price') }}</th>
                                                        <th class="qty">{{ __('Quantity') }}</th>
                                                    </tr>

                                                    @foreach ($additional_services as $index => $additional_service)
                                                        <tr>
                                                            <td class="images">
                                                                <img class="img-fluid w-100"
                                                                    src="{{ asset($additional_service->image) }}"
                                                                    alt="cart images">
                                                            </td>
                                                            <td class="name">
                                                                <div class="form-check">
                                                                    <input class="form-check-input"
                                                                        id="flexCheckDefault-{{ $index }}"
                                                                        type="checkbox" value=""
                                                                        onclick="checkExtraService({{ $additional_service->id }},{{ $additional_service->price }},'{{ $additional_service->service_name }}')">
                                                                    <label class="form-check-label"
                                                                        for="flexCheckDefault-{{ $index }}">
                                                                        {{ $additional_service->service_name }}
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td class="price">
                                                                <p>
                                                                    {{ currency($additional_service->price) }}
                                                                </p>
                                                            </td>
                                                            <td class="qty">
                                                                <input id="service_qty_{{ $additional_service->id }}"
                                                                    type="number" value="{{ $additional_service->qty }}"
                                                                    min="1"
                                                                    onchange="qtyUpdate({{ $additional_service->id }}, {{ $additional_service->price }})">
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <ul class="wsus__booking_button_area d-flex">
                        <li><a class="common_btn" href="{{ route('service', $service->slug) }}">{{ __('Previous') }}</a>
                        </li>

                        <li><a class="common_btn" id="readyToBookingBtn" href="javascript:;">{{ __('Next') }}</a></li>
                    </ul>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <div class="wsus__sidebar" id="sticky_sidebar">

                        <div class="wsus__booking_calendar">
                            <div id="service_available_dates"></div>
                        </div>

                        <div class="wsus__booking_pic_up mt_25">
                            <h3>{{ __('Select Schedule') }}</h3>
                            <select id="schedule_box">
                                <option value="">{{ __('Select') }}</option>
                            </select>
                        </div>

                        <div class="wsus__booking_summery">
                            <h3>{{ __('Booking Summery') }}</h3>
                            <ul>
                                @foreach ($package_features as $package_feature)
                                    <li>{{ $package_feature }}</li>
                                @endforeach
                            </ul>
                            <div class="wsus__booking_cost">
                                <p class="package_fee">{{ __('Package Fee') }} <span>
                                        {{ currency($service->price) }}
                                    </span></p>
                                <ul class="extra_service_area">

                                </ul>
                                @php
                                    $extra_service = 0.0;
                                @endphp
                                <h4>{{ __('Extra Service') }} <span id="extra_service_price">
                                        {{ currency($extra_service) }}
                                    </span>

                                </h4>

                                <h5>{{ __('Total') }} <span id="total_price">
                                        {{ currency($service->price + $extra_service) }}
                                    </span>

                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <form id="submitReadyToBooking" action="{{ route('booking-information', $service->slug) }}">
        <input id="input_extra_total" name="extra_total" type="hidden" value="{{ round($extra_service, 2) }}">
        <input id="input_sub_total" name="sub_total" type="hidden" value="{{ round($service->price, 2) }}">
        <input id="input_total" name="total" type="hidden" value="{{ round($service->price + $extra_service, 2) }}">
        <input id="input_date" name="date" type="hidden" value="">
        <input id="schedule_time_slot" name="schedule_time_slot" type="hidden" value="">

        <div id="extra_input">
        </div>
    </form> --}}

    <!--=========================
                                                                                                                                                                                                                                            ZIP CODE LOCATION PAGE START
                                                                                                                                                                                                                                        ==========================-->
    <section class="wsus__booking_service mt_100 xs_mt_70 mb_100 xs_mb_70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-10">
                    <div class="zipcode-location-page">
                        <!-- Progress Indicator -->
                        <div class="step-indicator">
                            <div class="step-dot active" id="dot1"></div>
                            <div class="step-dot" id="dot2"></div>
                            <div class="step-dot" id="dot3"></div>
                            <div class="step-dot" id="dot4"></div>
                            <div class="step-dot" id="dot5"></div>
                            <div class="step-dot" id="dot6"></div>
                        </div>

                        <!-- Step 1: ZIP Code -->
                        <div id="step1" class="quote-step">
                            <div class="text-center mb-4">
                                <h2 class="fw-bold mb-2" style="font-size: 24px; color: #2d3748; line-height: 1.3;">
                                    Compare quotes from top-rated<br><span id="categoryTitle">{{ $service->name ?? 'Services' }}</span>
                                </h2>
                                <p class="text-muted" style="font-size: 15px; margin-top: 10px;">Enter the location of your project</p>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-10">
                                    <div class="position-relative mb-3">
                                        <input type="text"
                                               id="zipCode"
                                               class="contact-blue-input"
                                               placeholder="ZIP / Postal code"
                                               maxlength="10"
                                               value="{{ request('zip') }}">
                                        <div class="position-absolute" style="right: 15px; top: 50%; transform: translateY(-50%); display: flex; align-items: center; gap: 10px;">
                                            <span id="zipValidIcon" class="text-success" style="display: none; font-size: 28px; font-weight: bold;">✓</span>
                                            <button type="button" class="btn btn-link text-muted p-0" id="locationBtn" style="text-decoration: none;" title="Use my location">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                    <circle cx="12" cy="10" r="3"></circle>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div id="locationDisplay" class="mb-3" style="display: none; visibility: hidden; height: 0; overflow: hidden;">
                                        <div id="locationText"></div>
                                        <div id="locationCountry"></div>
                                    </div>

                                    <button type="button"
                                            id="step1NextBtn"
                                            class="btn btn-lg w-100 quote-next-btn"
                                            disabled>
                                        Next
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Category-Specific Questions -->
                        <div id="step2" class="quote-step" style="display: none;">
                            <h3 class="fw-bold mb-3" id="step2Question" style="font-size: 20px; color: #2d3748; line-height: 1.3;">What kind of service do you need?</h3>

                            <!-- Scrollable options area -->
                            <div class="options-scroll-area">
                                <div id="questionOptions">
                                    <!-- Dynamic options will be inserted here -->
                                </div>
                            </div>

                            <!-- Project Details Textarea -->
                            <div class="details-textarea-container mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#718096" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                </svg>
                                <textarea id="step2Description"
                                          placeholder="Tell us in your own words..."
                                          rows="1"
                                          maxlength="2000"></textarea>
                            </div>

                            <div class="row g-3">
                                <div class="col-6">
                                    <button type="button" id="step2BackBtn" class="btn btn-lg w-100 quote-back-btn">Back</button>
                                </div>
                                <div class="col-6">
                                    <button type="button" id="step2NextBtn" class="btn btn-lg w-100 quote-next-btn">Next</button>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Building your project (Progress Bar) -->
                        <div id="step3" class="quote-step text-center" style="display: none;">
                            <h2 class="fw-bold mb-4" style="font-size: 28px; color: #2d3748;">Building your project</h2>

                            <div class="progress-container">
                                <div class="progress-bar-fill" id="step3ProgressBar"></div>
                            </div>

                            <p class="mb-2 fw-semibold" style="color: #2d3748;">Local cost data...</p>
                            <p class="text-muted" style="font-size: 14px;">If this page does not redirect in 3 seconds, <a href="javascript:void(0)" id="manualRedirect" style="color: #378fff; text-decoration: none;">Click Here</a></p>
                        </div>

                        <!-- Step 4: Project Address -->
                        <div id="step4" class="quote-step" style="display: none;">
                            <div class="text-center mb-4">
                                <h2 class="fw-bold mb-2" style="font-size: 24px; color: #2d3748;">What's your project address?</h2>
                            </div>

                            <div class="quote-form-group">
                                <label>Street</label>
                                <div class="quote-input-container">
                                    <input type="text" id="streetAddress" class="contact-blue-input" placeholder="Enter your street address">
                                </div>
                            </div>

                            <div class="quote-form-group">
                                <label>City</label>
                                <div class="quote-input-container">
                                    <input type="text" id="cityAddress" class="contact-blue-input" placeholder="City, State">
                                </div>
                            </div>

                            <div class="quote-form-group">
                                <label>ZIP code</label>
                                <div class="quote-input-container">
                                    <input type="text" id="zipAddress" class="contact-blue-input" placeholder="ZIP code">
                                    <div class="pre-filled-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="#10b981">
                                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <p class="mb-4" id="addressAreaDisplay" style="display: none; visibility: hidden; height: 0; overflow: hidden;"></p>

                            <div class="row g-3">
                                <div class="col-6">
                                    <button type="button" id="step4BackBtn" class="btn btn-lg w-100 quote-back-btn">Back</button>
                                </div>
                                <div class="col-6">
                                    <button type="button" id="step4NextBtn" class="btn btn-lg w-100 quote-next-btn">Next</button>
                                </div>
                            </div>
                        </div>

                        <!-- Step 5: User Contact Details -->
                        <div id="step5" class="quote-step" style="display: none;">
                            <div class="text-center mb-4">
                                <h2 class="fw-bold mb-2" style="font-size: 24px; color: #2d3748;">We have matching pros in your area!</h2>
                                <p class="text-muted" style="font-size: 15px;">Project: <span class="fw-semibold" id="confirmProjectName"></span></p>
                            </div>
                            <div class="row g-2">
                                <div class="col-6">
                                    <div class="quote-form-group mb-2">
                                        <label>First Name</label>
                                        <div class="quote-input-container">
                                            <input type="text" id="firstName" class="contact-blue-input" placeholder="First Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="quote-form-group mb-2">
                                        <label>Last Name</label>
                                        <div class="quote-input-container">
                                            <input type="text" id="lastName" class="contact-blue-input" placeholder="Last Name">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="quote-form-group mb-2">
                                <label>Phone</label>
                                <div class="quote-input-container">
                                    <input type="tel" id="userPhone" class="contact-blue-input" placeholder="{{ __('e.g. +92345689008876') }}">
                                </div>
                                <small class="text-muted d-block mt-1">{{ __('Enter + then your country code and number with no spaces (e.g. +92345689008876).') }}</small>
                            </div>

                            <div class="quote-form-group mb-3">
                                <label>Email</label>
                                <div class="quote-input-container">
                                    <input type="email" id="userEmail" class="contact-blue-input" placeholder="Email Address">
                                </div>
                            </div>

                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="marketingOptIn" style="width: 20px; height: 20px; margin-top: 2px;">
                                <label class="form-check-label ps-2" for="marketingOptIn" style="font-size: 13px; color: #4a5568; line-height: 1.4;">
                                    Text me project cost guides, how-to articles, and advice.
                                </label>
                            </div>

                            <div class="row g-3">
                                <div class="col-6">
                                    <button type="button" id="step5BackBtn" class="btn btn-lg w-100 quote-back-btn">Back</button>
                                </div>
                                <div class="col-6">
                                    <button type="button" id="step5NextBtn" class="btn btn-lg w-100 quote-next-btn">Next</button>
                                </div>
                            </div>

                            <p class="mt-3 text-muted text-center" style="font-size: 10px; line-height: 1.4;">
                                By clicking Next, I agree to <a href="#" style="color: #378fff; text-decoration: none;">FindUpNow's Terms</a> and <a href="#" style="color: #378fff; text-decoration: none;">Privacy Policy</a>.
                            </p>
                        </div>

                        <!-- Step 6: OTP Verification -->
                        <div id="step6" class="quote-step text-center" style="display: none;">
                            <h2 class="fw-bold mb-2" style="font-size: 24px; color: #2d3748;">Verify your details</h2>
                            <p class="text-muted" style="font-size: 15px;">We've sent a 6-digit code to your contact info.</p>

                            <div class="otp-input-wrapper">
                                <input type="text" class="otp-digit" maxlength="1" data-index="0" inputmode="numeric">
                                <input type="text" class="otp-digit" maxlength="1" data-index="1" inputmode="numeric">
                                <input type="text" class="otp-digit" maxlength="1" data-index="2" inputmode="numeric">
                                <input type="text" class="otp-digit" maxlength="1" data-index="3" inputmode="numeric">
                                <input type="text" class="otp-digit" maxlength="1" data-index="4" inputmode="numeric">
                                <input type="text" class="otp-digit" maxlength="1" data-index="5" inputmode="numeric">
                            </div>

                            <p class="mb-4 text-muted" style="font-size: 14px;">Didn't receive it? <a href="javascript:void(0)" style="color: #378fff; text-decoration: none;">Resend Code</a></p>

                            <div class="row g-3">
                                <div class="col-6">
                                    <button type="button" id="step6BackBtn" class="btn btn-lg w-100 quote-back-btn">Back</button>
                                </div>
                                <div class="col-6">
                                    <button type="button" id="submitQuoteRequest" class="btn btn-lg w-100 quote-next-btn">Verify</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('css')
    <style>
        /* ZIP Code Location Page Styles */
        .zipcode-location-page {
            background: #ffffff;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        /* ZIP Code Input */
        #zipCode {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 16px 110px 16px 18px;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
        }

        #zipCode:focus {
            border-color: #ff5a5f;
            box-shadow: 0 4px 10px rgba(255, 90, 95, 0.12);
            outline: none;
        }

        #zipCode.valid {
            border-color: #10b981;
        }

        #zipValidIcon {
            animation: checkmarkPop 0.3s ease;
        }

        @keyframes checkmarkPop {
            0% { transform: scale(0); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        #locationDisplay {
            animation: slideDown 0.3s ease;
            padding: 10px 12px;
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            border-radius: 6px;
            border-left: 4px solid #10b981;
            margin-top: 15px;
        }

        #locationDisplay #locationText {
            font-size: 16px;
            font-weight: 600;
            color: #065f46;
            line-height: 1.4;
        }

        #locationDisplay #locationCountry {
            font-size: 13px;
            color: #059669;
            margin-top: 1px;
        }

        #locationDisplay i, #locationDisplay svg {
            color: #10b981;
        }

        /* Invalid state */
        #locationDisplay.invalid {
            background: linear-gradient(135deg, #fff5f5 0%, #fed7d7 100%) !important;
            border-left: 4px solid #f56565 !important;
        }

        #locationDisplay.invalid #locationText {
            color: #c53030 !important;
        }

        #locationDisplay.invalid #locationCountry {
            color: #e53e3e !important;
        }

        #locationDisplay.invalid svg {
            stroke: #f56565 !important;
        }

        #locationDisplay.invalid .fa-map-marker-alt {
            color: #f56565 !important;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #locationBtn {
            transition: all 0.2s;
        }

        #locationBtn:hover {
            transform: scale(1.1);
            color: #378fff !important;
        }

        /* Buttons */
        .quote-next-btn {
            background: linear-gradient(135deg, #378fff 0%, #2563eb 100%);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 14px;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(55, 143, 255, 0.25);
        }

        .quote-next-btn:hover:not(:disabled) {
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(55, 143, 255, 0.35);
        }

        .quote-next-btn:disabled {
            background: #cbd5e0;
            box-shadow: none;
            cursor: not-allowed;
        }

        .quote-back-btn {
            background-color: white;
            color: #2d3748;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 14px;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .quote-back-btn:hover {
            border-color: #cbd5e0;
            background-color: #f7fafc;
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
        }

        /* Radio Options Grid */
        #questionOptions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 20px;
        }

        .quote-option {
            flex: 0 0 calc(50% - 6px);
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 10px 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
            display: flex;
            align-items: center;
        }

        .quote-option:hover {
            border-color: #cbd5e0;
            background-color: #f7fafc;
            transform: translateX(3px);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }

        .quote-option.selected {
            border-color: #378fff;
            background-color: #f0f7ff;
            box-shadow: 0 4px 10px rgba(55, 143, 255, 0.12);
        }

        .quote-option input[type="radio"] {
            width: 18px;
            height: 18px;
            margin-top: 2px;
            accent-color: #378fff;
        }

        .quote-option label {
            font-size: 15px;
            cursor: pointer;
            width: 100%;
            margin: 0;
            color: #2d3748;
            font-weight: 500;
        }

        /* Step Transitions */
        .quote-step {
            animation: fadeIn 0.4s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Progress Indicator */
        .step-indicator {
            display: flex;
            justify-content: center;
            gap: 6px;
            margin-bottom: 30px;
        }

        .step-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #e2e8f0;
            transition: all 0.3s ease;
        }

        .step-dot.active {
            background-color: #378fff;
            width: 24px;
            border-radius: 4px;
        }

        /* Progress Bar for Step 3 */
        .progress-container {
            width: 100%;
            background-color: #f1f1f1;
            border-radius: 10px;
            height: 8px;
            margin: 20px 0;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            background-color: #378fff;
            width: 0%;
            transition: width 0.1s linear;
        }

        /* Form Control Improvements */
        .quote-form-group {
            margin-bottom: 20px;
        }

        .quote-form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #4a5568;
            font-size: 14px;
        }

        .quote-input-container {
            position: relative;
        }

        /* Refined Contact Inputs (Image 5) */
        .contact-blue-input {
            height: 50px !important;
            padding: 12px 15px !important;
            background-color: #f0f7ff !important;
            border: 1px solid #c2e0ff !important;
            border-radius: 8px !important;
            width: 100%;
            font-size: 15px;
            transition: border-color 0.3s;
        }

        .contact-blue-input:focus {
            border-color: #378fff !important;
            background-color: #ffffff !important;
            outline: none;
        }

        .zip-valid {
            color: #28a745 !important;
            font-weight: bold !important;
            border-color: #28a745 !important;
        }

        .zip-invalid {
            color: #dc3545 !important;
            font-weight: bold !important;
            border-color: #dc3545 !important;
        }

        /* OTP Input Styling */
        .otp-input-wrapper {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 30px 0;
        }

        .otp-digit {
            width: 45px;
            height: 55px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            background: #f8fafc;
            color: #2d3748;
            line-height: normal;
            padding: 0;
        }

        .otp-digit:focus {
            border-color: #378fff;
            background: white;
            outline: none;
        }

        .quote-input-container .pre-filled-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #10b981;
        }

        /* Refined Step 2 Textarea (Image 4) */
        .details-textarea-container {
            background-color: #f0f7ff;
            border: 1px solid #c2e0ff;
            border-radius: 12px;
            padding: 12px 15px;
            margin-top: 20px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            transition: border-color 0.3s;
        }

        .details-textarea-container:focus-within {
            border-color: #378fff;
            background-color: white;
        }

        .details-textarea-container svg {
            flex-shrink: 0;
            margin-top: 3px;
        }

        .details-textarea-container textarea {
            border: none;
            background: transparent;
            width: 100%;
            font-size: 15px;
            color: #2d3748;
            outline: none;
            resize: none;
            padding: 0;
            min-height: 44px;
        }

        .details-textarea-container textarea::placeholder {
            color: #a0aec0;
        }

        /* Category Title Highlight */
        #categoryTitle {
            color: #378fff;
            position: relative;
        }

        /* Step 2 Layout */
        #step2 {
            display: flex;
            flex-direction: column;
            min-height: 400px;
        }

        .options-scroll-area {
            overflow-y: auto;
            flex: 1;
            padding-right: 5px;
            margin-bottom: 15px;
            max-height: 400px;
        }

        /* Custom Scrollbar */
        .options-scroll-area::-webkit-scrollbar {
            width: 5px;
        }
        .options-scroll-area::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .options-scroll-area::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 10px;
        }
        .options-scroll-area::-webkit-scrollbar-thumb:hover {
            background: #a0aec0;
        }

        .sticky-details-footer {
            border-top: 1px solid #edf2f7;
            padding-top: 15px;
            margin-top: auto;
            background: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .zipcode-location-page {
                padding: 25px 20px;
            }

            .quote-option {
                flex: 0 0 100%;
            }

            #step2 {
                min-height: 300px;
            }

            .zipcode-location-page h2 {
                font-size: 22px !important;
            }

            .zipcode-location-page h3 {
                font-size: 18px !important;
            }
        }
    </style>
@endpush

@push('js')
    {{-- ========================= BOOKING JAVASCRIPT - COMMENTED OUT ========================== --}}
    {{-- <script>
        let currency_icon = "{{ session()->get('currency_icon') ?? $setting->currency_icon }}"
        let currency_position = "{{ $setting->currency_position }}"
        let extraService = [];

        (function($) {
            "use strict";
            $(document).ready(function() {
                $("#readyToBookingBtn").on("click", function() {
                    if (!$("#input_date").val()) {
                        toastr.error("{{ __('Please select a date') }}")
                        return;
                    }

                    if (!$("#schedule_time_slot").val()) {
                        toastr.error("{{ __('Please select a schedule') }}")
                        return;
                    }

                    $("#submitReadyToBooking").submit();
                })

                //Date and time
                $("#service_available_dates").flatpickr({
                    minDate: "today",
                    inline: true,
                    altInput: true,
                    altFormat: "F j, Y",
                    dateFormat: "d-m-Y"
                });

                $("#service_available_dates").on("change", function() {
                    let date_string = $(this).val();
                    $("#input_date").val(date_string)
                    let provider_id = "{{ $service->provider_id }}";
                    $.ajax({
                        type: 'get',
                        data: {
                            date: date_string,
                            provider_id: provider_id
                        },
                        url: "{{ route('get-available-schedule') }}",
                        success: function(response) {
                            if (response.is_available) {
                                $("#schedule_box").html(response.available_schedules);
                            } else {
                                let html = `<option value="">{{ __('Select') }}</option>`;
                                $("#schedule_box").html(html);
                                $("#schedule_time_slot").val('');

                                toastr.error("{{ __('Schedule Not Found') }}")
                            }
                        },
                        error: function(response) {
                            let html = `<option value="">{{ __('Select') }}</option>`;
                            $("#schedule_box").html(html);
                            $("#schedule_time_slot").val('');

                            toastr.error("{{ __('Something went wrong') }}")
                        }
                    });
                })

                $("#schedule_box").on("change", function() {
                    $("#schedule_time_slot").val($(this).val());
                })

            });
        })(jQuery);

        function toISODate(d) {
            const z = n => ('0' + n).slice(-2);
            return d.getFullYear() + '-' + z(d.getMonth() + 1) + '-' +
                z(d.getDate());
        }

        function checkExtraService(id, price, name) {

            if (!extraService.some(service => service.id == id)) {
                let qty = $("#service_qty_" + id).val();
                price = price * qty;
                let arr = {
                    id: id,
                    name: name,
                    price: price,
                    qty: qty
                };
                extraService.push(arr);
            } else {
                extraService = extraService.filter(service => service.id !== id)
            }
            loadExtraService();
        }

        function loadExtraService() {
            let html_service = '';
            let extra_price = 0;
            let extra_input = '';
            extraService.forEach(service => {
                extra_price += service.price;

                html_service += `
            <li>
                <p>${service.name} <b>x ${service.qty} </b></p> <span>${formatCurrency(service.price)}</span>
            </li>
            `;

                extra_input += `
            <input type="hidden" value="${service.id}" name="ids[]">
            <input type="hidden" value="${service.price}" name="prices[]">
            <input type="hidden" value="${service.qty}" name="quantities[]">
            <input type="hidden" value="${service.name}" name="names[]">
        `;
            });

            $(".extra_service_area").html(html_service);
            $("#extra_input").html(extra_input);

            $("#extra_service_price").html(formatCurrency(extra_price));
            $("#input_extra_total").val(extra_price);

            let sub_total = $("#input_sub_total").val();
            let total_price = sub_total * 1 + extra_price * 1;
            $("#total_price").html(formatCurrency(total_price));
            $("#input_total").val(total_price);

        }

        function qtyUpdate(id, new_price) {
            if (extraService.some(service => service.id == id)) {
                extraService = extraService.map(service => {
                    let qty = service.qty;
                    let price = service.price;
                    if (service.id == id) {
                        qty = $("#service_qty_" + id).val();
                        price = new_price * qty;
                    }
                    return {
                        ...service,
                        qty,
                        price
                    }
                })
                loadExtraService();
            }
        }
    </script>

    <script>
        "use strict";

        function formatCurrency(price) {
            let $currency_code = "{{ getSessionCurrency() }}";
            let $currency_icon = "{{ session()->get('currency_icon') }}";
            let currencyRate = parseFloat("{{ session()->get('currency_rate', 1) }}");
            let position = "{{ session()->get('currency_position') }}";

            if ($currency_code !== "usd") {
                price = (parseFloat(price) * currencyRate).toFixed(2);
            }

            let formattedPrice;

            switch (position) {
                case 'before_price':
                    formattedPrice = $currency_icon + price;
                    break;
                case 'before_price_with_space':
                    formattedPrice = $currency_icon + ' ' + price;
                    break;
                case 'after_price':
                    formattedPrice = price + $currency_icon;
                    break;
                case 'after_price_with_space':
                    formattedPrice = price + ' ' + $currency_icon;
                    break;
                default:
                    formattedPrice = $currency_icon + price;
                    break;
            }
            return formattedPrice;
        }
    </script> --}}

    <script>
        (function($) {
            "use strict";

            // Category-specific questions configuration
            const categoryQuestions = {
                'Handymen': {
                    question: 'What type of handyman service do you need?',
                    options: ['General repairs', 'Furniture assembly', 'TV mounting', 'Picture hanging', 'Other']
                },
                'Electrical': {
                    question: 'What type of electrical work do you need?',
                    options: ['Outlet/switch installation', 'Light fixture installation', 'Electrical panel work', 'Wiring repair', 'Other']
                },
                'HVAC': {
                    question: 'What HVAC service do you need?',
                    options: ['AC repair', 'Heating repair', 'Installation', 'Maintenance', 'Other']
                },
                'Plumbing': {
                    question: 'What plumbing service do you need?',
                    options: ['Leak repair', 'Drain cleaning', 'Fixture installation', 'Water heater', 'Other']
                },
                'Flooring': {
                    question: 'What type of flooring work do you need?',
                    options: ['Hardwood installation', 'Tile installation', 'Carpet installation', 'Floor repair', 'Other']
                },
                'Lawn Care': {
                    question: 'What lawn care service do you need?',
                    options: ['Mowing', 'Landscaping', 'Tree trimming', 'Fertilization', 'Other']
                },
                'Painting': {
                    question: 'What type of painting do you need?',
                    options: ['Interior painting', 'Exterior painting', 'Cabinet painting', 'Deck staining', 'Other']
                },
                'Windows': {
                    question: 'What window service do you need?',
                    options: ['Window replacement', 'Window repair', 'Window cleaning', 'Screen repair', 'Other']
                },
                'Appliances': {
                    question: 'What appliance service do you need?',
                    options: ['Refrigerator repair', 'Washer/dryer repair', 'Dishwasher repair', 'Oven repair', 'Other']
                },
                'Remodeling': {
                    question: 'What type of remodeling do you need?',
                    options: ['Kitchen remodel', 'Bathroom remodel', 'Basement finishing', 'Room addition', 'Other']
                },
                'Roofing': {
                    question: 'What roofing service do you need?',
                    options: ['Roof repair', 'Roof replacement', 'Roof inspection', 'Gutter installation', 'Other']
                },
                'Doors': {
                    question: 'What door service do you need?',
                    options: ['Door installation', 'Door repair', 'Garage door', 'Lock installation', 'Other']
                }
            };

            let currentCategory = '{{ $service->name ?? "Services" }}';
            @if($service->slug == 'custom-request')
                let currentCategorySlug = '{{ request("category") ?? "" }}';
            @else
                let currentCategorySlug = '{{ $service->category->slug ?? "" }}';
            @endif
            let currentStep = 1;

            // Initialize on page load
            $(document).ready(function() {
                // First reset form to clean state
                resetForm();

                // Update category title
                $('#categoryTitle').text(currentCategory);

                // Check URL parameters
                const urlParams = new URLSearchParams(window.location.search);
                const zipFromUrl = urlParams.get('zip');

                // If ZIP is pre-filled from URL, trigger validation and auto-advance
                if (zipFromUrl) {
                    $('#zipCode').val(zipFromUrl);
                    window.isAutoAdvancingZip = true;
                    // Small delay to ensure DOM is ready
                    setTimeout(function() {
                        $('#zipCode').trigger('input');
                    }, 100);
                }
            });

            // Global postal code validation patterns
            const postalCodePatterns = {
                'US': /^\d{5}(-\d{4})?$/,
                'CA': /^[A-Z]\d[A-Z]\s?\d[A-Z]\d$/i,
                'UK': /^[A-Z]{1,2}\d{1,2}[A-Z]?\s?\d[A-Z]{2}$/i,
                'AU': /^\d{4}$/,
                'DE': /^\d{5}$/,
                'FR': /^\d{5}$/,
                'IT': /^\d{5}$/,
                'ES': /^\d{5}$/,
                'NL': /^\d{4}\s?[A-Z]{2}$/i,
                'BE': /^\d{4}$/,
                'CH': /^\d{4}$/,
                'AT': /^\d{4}$/,
                'SE': /^\d{3}\s?\d{2}$/,
                'NO': /^\d{4}$/,
                'DK': /^\d{4}$/,
                'FI': /^\d{5}$/,
                'PL': /^\d{2}-\d{3}$/,
                'PT': /^\d{4}-\d{3}$/,
                'IE': /^[A-Z]\d{2}\s?[A-Z0-9]{4}$/i,
                'NZ': /^\d{4}$/,
                'JP': /^\d{3}-?\d{4}$/,
                'KR': /^\d{5}$/,
                'IN': /^\d{6}$/,
                'BR': /^\d{5}-?\d{3}$/,
                'MX': /^\d{5}$/,
                'AR': /^[A-Z]?\d{4}$/i,
                'ZA': /^\d{4}$/,
                'SG': /^\d{6}$/,
                'MY': /^\d{5}$/,
                'TH': /^\d{5}$/,
                'PH': /^\d{4}$/,
                'PK': /^\d{5}$/,
                'AE': /^\d{5}$/,
                'SA': /^\d{5}(-\d{4})?$/,
            };

            let validationTimeout;
            let currentCountry = 'US';
            let userCountryByIp = 'US';

            // Fetch user country by IP for more accurate ZIP detection
            $.get('https://ipapi.co/json/', function(data) {
                if (data && data.country_code) {
                    userCountryByIp = data.country_code;
                    console.log('Detected Country by IP:', userCountryByIp);
                }
            });

            // ZIP/Postal code validation with API lookup
            $('#zipCode').on('input', function() {
                const postalCode = $(this).val().trim();

                clearTimeout(validationTimeout);

                $('#zipCode').removeClass('valid is-invalid zip-valid zip-invalid');
                $('#zipValidIcon').hide();
                $('#step1NextBtn').prop('disabled', true);
                $('#locationDisplay').hide();

                if (postalCode.length < 3) {
                    return;
                }

                validationTimeout = setTimeout(() => {
                    validatePostalCode(postalCode);
                }, 500);
            });

            function validatePostalCode(postalCode) {
                $('#locationText').html('<span class="spinner-border spinner-border-sm me-2"></span>Validating...');
                $('#locationDisplay').show();

                let matchingCountries = getAllMatchingCountries(postalCode);

                if (matchingCountries.length === 0) {
                    handleValidationError();
                    return;
                }

                tryNextZippo(0, matchingCountries, postalCode);
            }

            function tryNextZippo(index, countries, postalCode) {
                if (index >= countries.length) {
                    tryNominatim(postalCode, countries[0]); // Pass the highest priority country as hint
                    return;
                }

                const countryCode = countries[index].toLowerCase();
                $.ajax({
                    url: `https://api.zippopotam.us/${countryCode}/${postalCode}`,
                    method: 'GET',
                    timeout: 3000,
                    success: function(data) {
                        if (data && data.places && data.places.length > 0) {
                            const place = data.places[0];
                            const city = place['place name'];
                            const state = place['state abbreviation'] || place['state'];
                            const countryName = data['country'];

                            updateLocationDisplay(city, state, countryName, data['country abbreviation']);
                        } else {
                            tryNextZippo(index + 1, countries, postalCode);
                        }
                    },
                    error: function() {
                        tryNextZippo(index + 1, countries, postalCode);
                    }
                });
            }

            function tryNominatim(postalCode, countryHint) {
                let url = `https://nominatim.openstreetmap.org/search?postalcode=${postalCode}&format=json&addressdetails=1&limit=1`;
                if (countryHint) {
                    url += `&countrycodes=${countryHint.toLowerCase()}`;
                }

                $.ajax({
                    url: url,
                    method: 'GET',
                    timeout: 5000,
                    success: function(data) {
                        if (data && data.length > 0) {
                            const result = data[0];
                            const addr = result.address;
                            const city = addr.city || addr.town || addr.village || addr.suburb || (addr.state_district && addr.state_district !== addr.state ? addr.state_district : addr.state);
                            const state = addr.state_district || addr.state;
                            const countryName = addr.country;
                            const countryCode = addr.country_code ? addr.country_code.toUpperCase() : '';

                            updateLocationDisplay(city, state, countryName, countryCode);
                        } else if (countryHint) {
                            // If failed with hint, try one last time globally
                            tryNominatim(postalCode, null);
                        } else {
                            handleValidationError();
                        }
                    },
                    error: function() {
                        if (countryHint) {
                            tryNominatim(postalCode, null);
                        } else {
                            handleValidationError();
                        }
                    }
                });
            }

            function updateLocationDisplay(city, state, countryName, countryCode) {
                let cityText = city;
                if (state && state !== city) {
                    cityText += ', ' + state;
                }

                $('#locationText').text(cityText);
                $('#locationCountry').text(countryName);
                $('#zipCode').addClass('valid zip-valid').removeClass('is-invalid zip-invalid');
                $('#zipValidIcon').show();
                $('#step1NextBtn').prop('disabled', false);
                currentCountry = countryCode || 'US';

                // Auto-advance if this was pre-filled from hero section
                if (window.isAutoAdvancingZip) {
                    window.isAutoAdvancingZip = false;
                    setTimeout(function() {
                        if ($('#zipCode').hasClass('valid')) {
                            $('#step1NextBtn').click();
                        }
                    }, 500);
                }
            }

            function getAllMatchingCountries(postalCode) {
                let matches = [];
                // Prioritize user's IP country if it matches the pattern
                if (postalCodePatterns[userCountryByIp] && postalCodePatterns[userCountryByIp].test(postalCode)) {
                    matches.push(userCountryByIp);
                }

                for (const [country, pattern] of Object.entries(postalCodePatterns)) {
                    // Avoid duplicate if already added as prioritized
                    if (country !== userCountryByIp && pattern.test(postalCode)) {
                        matches.push(country);
                    }
                }
                return matches;
            }

            function updateAddressStepData() {
                const zip = $('#zipCode').val();
                const cityState = $('#locationText').text();
                $('#zipAddress').val(zip);
                $('#cityAddress').val(cityState);
                $('#addressAreaDisplay').text(cityState + (currentCountry ? ', ' + currentCountry : ''));
            }

            function handleValidationError() {
                $('#locationText').text('Invalid postal code');
                $('#locationCountry').text('Please check the format and try again');
                $('#zipCode').removeClass('valid zip-valid').addClass('is-invalid zip-invalid');
                $('#zipValidIcon').hide();
                $('#step1NextBtn').prop('disabled', true);
            }

            // Location button with geolocation
            $('#locationBtn').on('click', function() {
                const btn = $(this);
                const originalHtml = btn.html();

                if (navigator.geolocation) {
                    btn.html('<span class="spinner-border spinner-border-sm"></span>').prop('disabled', true);

                    navigator.geolocation.getCurrentPosition(
                        function(position) {
                            const lat = position.coords.latitude;
                            const lon = position.coords.longitude;

                            $.ajax({
                                url: `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`,
                                method: 'GET',
                                success: function(data) {
                                    btn.html(originalHtml).prop('disabled', false);
                                    if (data && data.address && data.address.postcode) {
                                        $('#zipCode').val(data.address.postcode);
                                        $('#zipCode').trigger('input');
                                    } else {
                                        toastr.error('Could not detect postal code from your location');
                                    }
                                },
                                error: function() {
                                    btn.html(originalHtml).prop('disabled', false);
                                    toastr.error('Failed to detect location');
                                }
                            });
                        },
                        function(error) {
                            btn.html(originalHtml).prop('disabled', false);
                            toastr.error('Location access denied. Please enter postal code manually.');
                        }
                    );
                } else {
                    toastr.error('Geolocation is not supported by your browser');
                }
            });

            // Step 1 Next button
            $('#step1NextBtn').on('click', function() {
                showStep(2);
                loadCategoryQuestions();
            });

            // Step 2 functionality
            $('#step2BackBtn').on('click', function() {
                showStep(1);
            });

            $('#step2NextBtn').on('click', function() {
                const selectedService = $('input[name="serviceOption"]:checked').val();
                if (!selectedService) {
                    toastr.warning('Please select an option to continue');
                    return;
                }

                // If "Other" is selected, require description
                if (selectedService.toLowerCase() === 'other') {
                    const desc = $('#step2Description').val().trim();
                    if (desc.length === 0) {
                        toastr.warning('Please provide some details in the description');
                        return;
                    }
                }
                showStep(3);
                startProgressBar();
            });

            // Step 3 functionality (Progress Bar)
            let progressInterval;
            function startProgressBar() {
                let width = 0;
                const fill = $('#step3ProgressBar');
                fill.css('width', '0%');

                if (progressInterval) clearInterval(progressInterval);

                progressInterval = setInterval(() => {
                    if (width >= 100) {
                        clearInterval(progressInterval);
                        setTimeout(() => {
                            if (currentStep === 3) {
                                updateAddressStepData();
                                showStep(4);
                            }
                        }, 500);
                    } else {
                        width += 2;
                        fill.css('width', width + '%');
                    }
                }, 40);
            }

            $('#manualRedirect').on('click', function() {
                clearInterval(progressInterval);
                updateAddressStepData();
                showStep(4);
            });

            // Step 4 functionality (Address)
            $('#step4BackBtn').on('click', function() {
                showStep(2);
            });

            $('#step4NextBtn').on('click', function() {
                const street = $('#streetAddress').val().trim();
                if (!street) {
                    toastr.warning('Please enter your street address');
                    return;
                }
                const selectedService = $('input[name="serviceOption"]:checked').val();
                $('#confirmProjectName').text(selectedService || currentCategory);
                showStep(5);
            });

            // Step 5 functionality (Contact)
            $('#step5BackBtn').on('click', function() {
                showStep(4);
            });

            $('#step5NextBtn').on('click', function() {
                const fName = $('#firstName').val().trim();
                const lName = $('#lastName').val().trim();
                const phone = $('#userPhone').val().trim();
                const email = $('#userEmail').val().trim();

                if (!fName || !lName || !phone || !email) {
                    toastr.warning('Please fill in all contact details');
                    return;
                }

                // Email validation regex
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    toastr.warning('Please enter a valid email address');
                    $('#userEmail').addClass('is-invalid').focus();
                    return;
                } else {
                    $('#userEmail').removeClass('is-invalid');
                }

                // Phone validation regex
                const phoneRegex = /^[\d\s+\-()]{7,20}$/;
                if (!phoneRegex.test(phone)) {
                    toastr.warning('Please enter a valid phone number');
                    $('#userPhone').addClass('is-invalid').focus();
                    return;
                } else {
                    $('#userPhone').removeClass('is-invalid');
                }

                toastr.info('Sending verification code...');

                // Real OTP sending
                const otpTarget = phone;
                const otpType = 'phone';

                $.ajax({
                    url: "{{ route('send-otp') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        contact: otpTarget,
                        type: otpType
                    },
                    success: function(response) {
                        toastr.success('Verification code sent to ' + otpTarget);
                        showStep(6);
                        setTimeout(() => {
                            $('.otp-digit').first().focus();
                        }, 400);
                    },
                    error: function(xhr) {
                        let errorMessage = 'Failed to send verification code. Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        toastr.error(errorMessage);
                    }
                });
            });

            // Clear invalid status when typing
            $('#userEmail, #userPhone').on('input', function() {
                $(this).removeClass('is-invalid');
            });

            // OTP Input Navigation
            $('.otp-digit').on('keyup', function(e) {
                const key = e.key;
                const index = $(this).data('index');
                if (key >= 0 && key <= 9) {
                    $(this).val(key);
                    if (index < 3) {
                        $(`.otp-digit[data-index="${index + 1}"]`).focus();
                    }
                } else if (key === 'Backspace') {
                    if (index > 0) {
                        $(`.otp-digit[data-index="${index - 1}"]`).focus();
                    }
                }
            });

            $('#step6BackBtn').on('click', function() {
                showStep(5);
            });

            $('#submitQuoteRequest').on('click', function() {
                let otp = '';
                $('.otp-digit').each(function() {
                    otp += $(this).val();
                });

                if (otp.length < 4) {
                    toastr.warning('Please enter the 4-digit verification code');
                    return;
                }

                // Verify OTP first
                $.ajax({
                    url: "{{ route('verify-otp') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        otp: otp
                    },
                    success: function(response) {
                        toastr.success('Verification successful!');
                        submitFinalForm();
                    },
                    error: function(xhr) {
                        const message = xhr.responseJSON ? xhr.responseJSON.message : 'Invalid verification code';
                        toastr.error(message);
                    }
                });
            });

            function submitFinalForm() {
                const finalData = {
                    category: currentCategory,
                    zipCode: $('#zipCode').val(),
                    serviceType: $('input[name="serviceOption"]:checked').val(),
                    description: $('#step2Description').val(),
                    street: $('#streetAddress').val(),
                    city: $('#cityAddress').val(),
                    contact: {
                        first: $('#firstName').val(),
                        last: $('#lastName').val(),
                        phone: $('#userPhone').val().trim(),
                        email: $('#userEmail').val(),
                        marketing: $('#marketingOptIn').is(':checked')
                    }
                };

                console.log('Final Submission:', finalData);
                toastr.success('Your request has been submitted successfully!');
                resetForm();
            }

            function showStep(step) {
                currentStep = step;
                $('.quote-step').hide();
                $('#step' + step).fadeIn(300);
                $('.step-dot').removeClass('active');
                $('#dot' + step).addClass('active');
            }

            function loadCategoryQuestions() {
                if (!currentCategorySlug) {
                    // If no slug, just render default
                    renderDefaultOptions();
                    return;
                }

                // Show loading state
                $('#step2Question').text('Loading options...');
                $('#questionOptions').html('<div class="text-center p-4"><div class="spinner-border text-primary" role="status"></div></div>');

                $.ajax({
                    url: "{{ route('get-service-type-options') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        category: currentCategorySlug
                    },
                    success: function(response) {
                        if (response.status === 'success' && response.service_types) {
                            renderOptions(response.service_types);
                        } else {
                            renderDefaultOptions();
                        }
                    },
                    error: function() {
                        renderDefaultOptions();
                    }
                });
            }

            function renderOptions(options) {
                // Ensure "Other" is always at the end if not present
                const hasOther = options.some(opt => opt.trim().toLowerCase() === 'other');
                if (!hasOther) {
                    options.push('Other');
                }

                $('#step2Question').text(`What type of ${currentCategory.toLowerCase()} service do you need?`);

                let optionsHtml = '';
                options.forEach((option, index) => {
                    optionsHtml += `
                        <div class="quote-option" data-option="${option}">
                            <input class="form-check-input me-3" type="radio" name="serviceOption" id="option${index}" value="${option}" style="pointer-events: none;">
                            <label class="form-check-label mb-0" for="option${index}" style="pointer-events: none; cursor: pointer;">
                                ${option}
                            </label>
                        </div>
                    `;
                });

                $('#questionOptions').html(optionsHtml);

                // Add click handler to radio options
                $('.quote-option').on('click', function() {
                    $('.quote-option').removeClass('selected');
                    $(this).addClass('selected');
                    $(this).find('input[type="radio"]').prop('checked', true);
                });
            }

            function renderDefaultOptions() {
                const defaultOptions = ['General service', 'Repair', 'Installation', 'Maintenance', 'Emergency', 'Other'];
                renderOptions(defaultOptions);
            }

            function resetForm() {
                currentStep = 1;
                $('#zipCode').val('').removeClass('valid');
                $('#zipValidIcon').hide();
                $('#locationDisplay').hide();
                $('#step1NextBtn').prop('disabled', true);
                $('#step2Description').val('');
                $('.step-dot').removeClass('active');
                $('#dot1').addClass('active');
                $('#streetAddress').val('');
                $('#cityAddress').val('');
                $('#zipAddress').val('');
                $('#firstName').val('');
                $('#lastName').val('');
                $('#userPhone').val('');
                $('#userEmail').val('');
                $('#marketingOptIn').prop('checked', false);
                $('.otp-digit').val('');
                showStep(1);
            }

        })(jQuery);
    </script>
@endpush
