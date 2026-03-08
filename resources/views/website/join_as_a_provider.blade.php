@extends($active_theme)

@section('title')
    <title>{{ __('Join as provider') }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ __('Join as provider') }}">
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
                            <h1>{{ __('Join as Provider') }}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('Join as provider') }}</li>
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
                    PROVIDER REGISTRATION START
                ==========================-->
    <section class="wsus__sign_in mt_90 xs_mt_60 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-10 col-xxl-10 m-auto">
                    <div class="wsus__sign_in_area">
                        <div class="row justify-content-center">
                            <div class="col-xl-10 col-lg-12">
                                <div class="wsus__review_input wsus__sign_in_text">
                                    <h2>{{ __('Join as Provider') }}</h2>
                                    <p>{{ __('Complete your provider registration in a few simple steps.') }}</p>

                                    <!-- Progress Steps -->
                                    <div class="registration-progress mb_40">
                                        <div class="progress-steps">
                                            <div class="step active" data-step="1">
                                                <div class="step-number">1</div>
                                                <div class="step-label">{{ __('Create Account') }}</div>
                                            </div>
                                            <div class="step" data-step="2">
                                                <div class="step-number">2</div>
                                                <div class="step-label">{{ __('Jobs Feed') }}</div>
                                            </div>
                                            <div class="step" data-step="3">
                                                <div class="step-number">3</div>
                                                <div class="step-label">{{ __('Payment') }}</div>
                                            </div>
                                            <div class="step" data-step="4">
                                                <div class="step-number">4</div>
                                                <div class="step-label">{{ __('Profile') }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <form id="providerRegistrationForm" method="POST" action="{{ route('request-provider') }}" enctype="multipart/form-data">
                                        @csrf

                                        <!-- Step 1: Create Account -->
                                        <div class="registration-step" id="step1">
                                            <h3 class="step-title">{{ __('Create Account') }}</h3>
                                            <div class="row">
                                                <div class="col-xl-6 col-md-6">
                                                    <fieldset>
                                                        <legend>{{ __('Name') }}*</legend>
                                                        <input name="name" type="text" id="provider_name" required>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <fieldset>
                                                        <legend>{{ __('Email') }}*</legend>
                                                        <input name="email" type="email" required>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <fieldset>
                                                        <legend>{{ __('Phone') }}*</legend>
                                                        <input name="phone" type="text" required
                                                            placeholder="{{ __('e.g. +92345689008876') }}">
                                                        <small class="text-muted d-block mt-1">{{ __('Enter + then your country code and number with no spaces (e.g. +92345689008876).') }}</small>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <fieldset>
                                                        <legend>{{ __('Address') }}*</legend>
                                                        <input name="address" type="text" required>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-12">
                                                    <button type="button" class="common_btn mt_20 w-100" id="step1NextBtn">
                                                        {{ __('Next') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Step 2: Jobs/Projects Feed -->
                                        <div class="registration-step" id="step2" style="display: none;">
                                            <h3 class="step-title">{{ __('Jobs / Projects Feed') }}</h3>
                                            <p class="mb_20">{{ __('Browse available projects. Client contact details will be visible after payment.') }}</p>
                                            <div class="row">
                                                @if($availableJobs->count() > 0)
                                                    @foreach($availableJobs as $job)
                                                        <div class="col-xl-6 col-lg-6 mb_20">
                                                            <div class="job-card-preview" style="border: 1px solid #ddd; border-radius: 8px; padding: 20px; background: #fff;">
                                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                                    <span class="job-type-badge" style="background: #007bff; color: #fff; padding: 4px 12px; border-radius: 4px; font-size: 12px;">
                                                                        {{ $job->job_type ?? 'Project' }}
                                                                    </span>
                                                                    @if($job->is_urgent == 'enable')
                                                                        <span style="background: #dc3545; color: #fff; padding: 4px 12px; border-radius: 4px; font-size: 12px;">
                                                                            {{ __('Urgent') }}
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                <h4 style="font-size: 18px; margin: 10px 0; color: #333;">
                                                                    {{ $job->title }}
                                                                </h4>
                                                                <div style="margin: 10px 0;">
                                                                    <p style="margin: 5px 0; color: #666;">
                                                                        <i class="fas fa-briefcase"></i>
                                                                        <strong>{{ __('Project Type') }}:</strong> {{ $job->category->name ?? 'N/A' }}
                                                                    </p>
                                                                    <p style="margin: 5px 0; color: #666;">
                                                                        <i class="fas fa-map-marker-alt"></i>
                                                                        <strong>{{ __('Location') }}:</strong> {{ $job->city->name ?? 'N/A' }}
                                                                    </p>
                                                                    @if($job->address)
                                                                        <p style="margin: 5px 0; color: #666;">
                                                                            <i class="fas fa-home"></i>
                                                                            <strong>{{ __('Address') }}:</strong> {{ \Illuminate\Support\Str::limit($job->address, 50) }}
                                                                        </p>
                                                                    @endif
                                                                    <p style="margin: 5px 0; color: #666;">
                                                                        <i class="fas fa-calendar"></i>
                                                                        <strong>{{ __('Posted') }}:</strong> {{ \Carbon\Carbon::parse($job->created_at)->format('M d, Y') }}
                                                                    </p>
                                                                    @if($job->regular_price > 0)
                                                                        <p style="margin: 5px 0; color: #28a745; font-weight: bold;">
                                                                            <i class="fas fa-dollar-sign"></i>
                                                                            {{ __('Budget') }}: {{ session()->get('currency_icon') ?? $setting->currency_icon ?? '$' }}{{ number_format($job->regular_price, 2) }}
                                                                        </p>
                                                                    @endif
                                                                </div>
                                                                <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #eee;">
                                                                    <p style="color: #999; font-size: 13px; margin: 0;">
                                                                        <i class="fas fa-lock"></i>
                                                                        {{ __('Client contact details are hidden. Complete payment to view full project details and contact information.') }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="col-xl-12">
                                                        <div style="text-align: center; padding: 40px; background: #f8f9fa; border-radius: 8px;">
                                                            <i class="fas fa-briefcase" style="font-size: 48px; color: #ccc; margin-bottom: 15px;"></i>
                                                            <p style="font-size: 16px; color: #666;">{{ __('No projects available at the moment.') }}</p>
                                                            <p style="font-size: 14px; color: #999;">{{ __('Complete your registration to be notified when new projects are posted.') }}</p>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="col-xl-12 mt_30">
                                                    <p style="text-align: center; color: #666; font-size: 14px;">
                                                        <i class="fas fa-info-circle"></i>
                                                        {{ __('Complete payment to unlock full project details and contact information.') }}
                                                    </p>
                                                </div>
                                                <div class="col-xl-12">
                                                    <button type="button" class="common_btn mt_20 w-100" id="step2NextBtn">
                                                        {{ __('Continue to Payment') }}
                                                    </button>
                                                </div>
                                                <div class="col-xl-12">
                                                    <button type="button" class="common_btn mt_20 w-100 btn-secondary" id="step2BackBtn">
                                                        {{ __('Back') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Step 3: Payment -->
                                        <div class="registration-step" id="step3" style="display: none;">
                                            <h3 class="step-title">{{ __('Choose Payment Plan') }}</h3>
                                            <p class="mb_20">{{ __('Select a subscription plan to continue.') }}</p>
                                            <div class="row">
                                                @foreach($subscriptionPlans as $plan)
                                                    <div class="col-xl-4 col-md-6 mb_20">
                                                        <div class="plan-card" data-plan-id="{{ $plan->id }}" data-plan-price="{{ $plan->plan_price }}">
                                                            <div class="plan-header">
                                                                <h4>{{ $plan->plan_name }}</h4>
                                                                <div class="plan-price">
                                                                    @if($plan->plan_price == 0)
                                                                        <span class="price-amount">{{ __('Free') }}</span>
                                                                    @else
                                                                        <span class="currency">{{ session()->get('currency_icon') ?? $setting->currency_icon ?? '$' }}</span>
                                                                        <span class="price-amount">{{ $plan->plan_price }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="plan-features">
                                                                <p><strong>{{ __('Expiration') }}:</strong> {{ $plan->expiration_date }} {{ __('Days') }}</p>
                                                                <p><strong>{{ __('Maximum Services') }}:</strong> {{ $plan->maximum_service == -1 ? __('Unlimited') : $plan->maximum_service }}</p>
                                                            </div>
                                                            <div class="plan-select">
                                                                <input type="radio" name="subscription_plan_id" value="{{ $plan->id }}" id="plan_{{ $plan->id }}" required>
                                                                <label for="plan_{{ $plan->id }}">{{ __('Select Plan') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="col-xl-12">
                                                    <button type="button" class="common_btn mt_20 w-100" id="step3NextBtn">
                                                        {{ __('Next') }}
                                                    </button>
                                                </div>
                                                <div class="col-xl-12">
                                                    <button type="button" class="common_btn mt_20 w-100 btn-secondary" id="step3BackBtn">
                                                        {{ __('Back') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Step 4: Profile -->
                                        <div class="registration-step" id="step4" style="display: none;">
                                            <h3 class="step-title">{{ __('Complete Your Profile') }}</h3>
                                            <div class="row">
                                                <div class="col-xl-6 col-md-6">
                                                    <fieldset>
                                                        <legend>{{ __('Company Name') }}</legend>
                                                        <input name="company_name" type="text">
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <fieldset>
                                                        <legend>{{ __('Services') }}*</legend>
                                                        <select name="services[]" id="services_select" class="select_2" multiple required>
                                                            @foreach($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <fieldset>
                                                        <legend>{{ __('Address') }}*</legend>
                                                        <input name="profile_address" type="text" required>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <fieldset>
                                                        <legend>{{ __('State / Province') }}*</legend>
                                                        <select class="select_2" id="state_id" name="state" required>
                                                            <option value="">{{ __('Select State') }}</option>
                                                        </select>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <fieldset>
                                                        <legend>{{ __('City') }}*</legend>
                                                        <select class="select_2" id="city_id" name="city" required>
                                                            <option value="">{{ __('Select City') }}</option>
                                                        </select>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <fieldset>
                                                        <legend>{{ __('Zip Code') }}*</legend>
                                                        <input name="zip_code" type="text" required>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <fieldset>
                                                        <legend>{{ __('Country') }}*</legend>
                                                        <select class="select_2" id="country_id" name="country" required>
                                                            <option value="">{{ __('Select Country') }}</option>
                                                            @foreach ($countries as $country)
                                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <fieldset>
                                                        <legend>{{ __('Phone') }}*</legend>
                                                        <input name="profile_phone" type="text" required
                                                            placeholder="{{ __('e.g. +92345689008876') }}">
                                                        <small class="text-muted d-block mt-1">{{ __('Enter + then your country code and number with no spaces (e.g. +92345689008876).') }}</small>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <fieldset>
                                                        <legend>{{ __('Email') }}*</legend>
                                                        <input name="profile_email" type="email" required>
                                                    </fieldset>
                                                </div>

                                                <!-- Licensed (Optional) -->
                                                <div class="col-xl-6 col-md-6">
                                                    <fieldset>
                                                        <legend>{{ __('Licensed') }} ({{ __('Optional') }})</legend>
                                                        <div class="requirement-options">
                                                            <label class="requirement-option">
                                                                <input type="radio" name="licensed" value="yes">
                                                                <span>{{ __('Yes') }}</span>
                                                            </label>
                                                            <label class="requirement-option">
                                                                <input type="radio" name="licensed" value="no">
                                                                <span>{{ __('No') }}</span>
                                                            </label>
                                                        </div>
                                                    </fieldset>
                                                </div>

                                                <!-- Insured (Optional) -->
                                                <div class="col-xl-6 col-md-6">
                                                    <fieldset>
                                                        <legend>{{ __('Insured') }} ({{ __('Optional') }})</legend>
                                                        <div class="requirement-options">
                                                            <label class="requirement-option">
                                                                <input type="radio" name="insured" value="yes">
                                                                <span>{{ __('Yes') }}</span>
                                                            </label>
                                                            <label class="requirement-option">
                                                                <input type="radio" name="insured" value="no">
                                                                <span>{{ __('No') }}</span>
                                                            </label>
                                                        </div>
                                                    </fieldset>
                                                </div>

                                                <!-- Coverage Radius -->
                                                <div class="col-xl-12">
                                                    <fieldset>
                                                        <legend>{{ __('Coverage Radius') }}*</legend>
                                                        <div class="coverage-radius-options">
                                                            <label class="coverage-option">
                                                                <input type="radio" name="coverage_radius" value="30" required>
                                                                <span class="coverage-label">
                                                                    <strong>30 {{ __('Miles') }}</strong>
                                                                </span>
                                                            </label>
                                                            <label class="coverage-option">
                                                                <input type="radio" name="coverage_radius" value="50" required>
                                                                <span class="coverage-label">
                                                                    <strong>50 {{ __('Miles') }}</strong>
                                                                </span>
                                                            </label>
                                                            <label class="coverage-option">
                                                                <input type="radio" name="coverage_radius" value="100" required>
                                                                <span class="coverage-label">
                                                                    <strong>100 {{ __('Miles') }}</strong>
                                                                </span>
                                                            </label>
                                                            <label class="coverage-option">
                                                                <input type="radio" name="coverage_radius" value="200" required>
                                                                <span class="coverage-label">
                                                                    <strong>200 {{ __('Miles') }}</strong>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </fieldset>
                                                </div>

                                                @if ($recaptchaSetting->status == 'active')
                                                    <div class="col-xl-12">
                                                        <div class="wsus__single_com mt_20">
                                                            <div class="g-recaptcha" data-sitekey="{{ $recaptchaSetting->site_key }}"></div>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="col-12">
                                                    <h4>{{ __('Terms and Conditions') }}</h4>
                                                    <div class="form-check">
                                                        <input id="terms_checkbox" name="agree" type="checkbox" required>
                                                        <label class="form-check-label" for="terms_checkbox">
                                                            {{ __('I agree with') }} <a href="{{ route('terms-and-conditions') }}">{{ __('Terms and Conditions') }}</a>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <button type="submit" class="common_btn mt_20 w-100" id="submitBtn">
                                                        {{ __('Submit') }}
                                                    </button>
                                                </div>
                                                <div class="col-xl-12">
                                                    <button type="button" class="common_btn mt_20 w-100 btn-secondary" id="step4BackBtn">
                                                        {{ __('Back') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================
                    PROVIDER REGISTRATION END
                ==========================-->

    <style>
        .registration-progress {
            margin-bottom: 40px;
        }
        .progress-steps {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            margin-bottom: 30px;
        }
        .progress-steps::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 2px;
            background: #e0e0e0;
            z-index: 0;
        }
        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 1;
            flex: 1;
        }
        .step-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e0e0e0;
            color: #999;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-bottom: 10px;
            transition: all 0.3s;
        }
        .step.active .step-number {
            background: #007bff;
            color: #fff;
        }
        .step.completed .step-number {
            background: #28a745;
            color: #fff;
        }
        .step-label {
            font-size: 12px;
            text-align: center;
            color: #999;
        }
        .step.active .step-label {
            color: #007bff;
            font-weight: bold;
        }
        .registration-step {
            animation: fadeIn 0.3s;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .step-title {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }
        .plan-card {
            border: 2px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            height: 100%;
        }
        .plan-card:hover {
            border-color: #007bff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .plan-card.selected {
            border-color: #007bff;
            background: #f0f8ff;
        }
        .plan-header h4 {
            margin-bottom: 15px;
            color: #333;
        }
        .plan-price {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 15px;
        }
        .plan-features {
            text-align: left;
            margin: 15px 0;
        }
        .plan-features p {
            margin: 5px 0;
            color: #666;
        }
        .plan-select {
            margin-top: 15px;
        }
        .plan-select input[type="radio"] {
            margin-right: 8px;
        }
        .requirement-options {
            display: flex;
            gap: 20px;
        }
        .requirement-option {
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        .requirement-option input[type="radio"] {
            margin-right: 8px;
        }
        .coverage-radius-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }
        .coverage-option {
            display: flex;
            align-items: center;
            padding: 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .coverage-option:hover {
            border-color: #007bff;
            background: #f8f9fa;
        }
        .coverage-option input[type="radio"] {
            margin-right: 10px;
        }
        .coverage-option input[type="radio"]:checked + .coverage-label {
            color: #007bff;
            font-weight: bold;
        }
        .btn-secondary {
            background: #6c757d;
            border-color: #6c757d;
        }
        .btn-secondary:hover {
            background: #5a6268;
            border-color: #545b62;
        }
        .job-card-preview {
            transition: all 0.3s;
        }
        .job-card-preview:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        .job-type-badge {
            text-transform: uppercase;
            font-size: 11px;
            font-weight: 600;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let currentStep = 1;
            const totalSteps = 4;

            // Check if returning from payment success
            @php
                $showStep4AfterPayment = isset($paymentCompleted) && $paymentCompleted && isset($currentStep) && $currentStep == 4;
            @endphp

            @if($showStep4AfterPayment)
                // Payment completed - show Step 4 directly
                currentStep = 4;
                // Mark steps 1, 2, and 3 as completed
                $('.step[data-step="1"]').addClass('completed');
                $('.step[data-step="2"]').addClass('completed');
                $('.step[data-step="3"]').addClass('completed');
                $('.step[data-step="4"]').addClass('active');
                // Show Step 4
                $('.registration-step').hide();
                $('#step4').show();
                // Show success message if any
                @if(session('message'))
                    setTimeout(function() {
                        alert('{{ session('message') }}');
                    }, 500);
                @endif
            @endif

            // Step navigation functions
            function showStep(step) {
                $('.registration-step').hide();
                $('#step' + step).show();
                updateProgress(step);
                currentStep = step;
            }

            function updateProgress(step) {
                $('.step').removeClass('active completed');
                for (let i = 1; i < step; i++) {
                    $('.step[data-step="' + i + '"]').addClass('completed');
                }
                $('.step[data-step="' + step + '"]').addClass('active');
            }

            // Plan card selection
            $('.plan-card').on('click', function() {
                $('.plan-card').removeClass('selected');
                $(this).addClass('selected');
                const planId = $(this).data('plan-id');
                $('#plan_' + planId).prop('checked', true);
            });

            // Step 1: Create Account
            $('#step1NextBtn').on('click', function() {
                const name = $('input[name="name"]').val();
                const email = $('input[name="email"]').val();
                const phone = $('input[name="phone"]').val();
                const address = $('input[name="address"]').val();

                if (!name || !email || !phone || !address) {
                    alert('{{ __("Please fill in all required fields") }}');
                    return;
                }

                // Validate email
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    alert('{{ __("Please enter a valid email address") }}');
                    return;
                }

                // Create account via AJAX
                const btn = $(this);
                btn.prop('disabled', true).text('{{ __("Creating Account...") }}');

                $.ajax({
                    url: '{{ route("provider.registration.create-account") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: name,
                        email: email,
                        phone: phone,
                        address: address
                    },
                    success: function(response) {
                        if (response.status == 1) {
                            showStep(2);
                        } else {
                            alert(response.message || '{{ __("Something went wrong") }}');
                            if (response.errors) {
                                let errorMsg = '';
                                $.each(response.errors, function(key, value) {
                                    errorMsg += value[0] + '\n';
                                });
                                alert(errorMsg);
                            }
                        }
                        btn.prop('disabled', false).text('{{ __("Next") }}');
                    },
                    error: function(xhr) {
                        let errorMsg = '{{ __("Error creating account") }}';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                            let errors = '';
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                errors += value[0] + '\n';
                            });
                            errorMsg = errors;
                        }
                        alert(errorMsg);
                        btn.prop('disabled', false).text('{{ __("Next") }}');
                    }
                });
            });

            // Step 2: Jobs/Projects
            $('#step2NextBtn').on('click', function() {
                showStep(3);
            });

            // Step 3: Payment
            $('#step3NextBtn').on('click', function() {
                const selectedPlanId = $('input[name="subscription_plan_id"]:checked').val();
                const selectedPlan = $('input[name="subscription_plan_id"]:checked').closest('.plan-card');
                const planPrice = selectedPlan.data('plan-price');

                if (!selectedPlanId) {
                    alert('{{ __("Please select a subscription plan") }}');
                    return;
                }

                // If free plan, go directly to step 4
                if (planPrice == 0) {
                    // Store plan in session and proceed to step 4
                    $.ajax({
                        url: '{{ route("provider.registration.store-plan") }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            subscription_plan_id: selectedPlanId
                        },
                        success: function(response) {
                            if (response.status == 1) {
                                $('#step3').hide();
                                $('#step4').show();
                                updateProgress(4);
                            } else {
                                alert(response.message || '{{ __("Something went wrong") }}');
                            }
                        },
                        error: function() {
                            alert('{{ __("Error processing request") }}');
                        }
                    });
                } else {
                    // Paid plan - redirect to payment page with return URL
                    // Get base URL without query parameters
                    const baseUrl = window.location.origin + window.location.pathname;
                    const returnUrl = encodeURIComponent(baseUrl + '?payment_success=1&step=4');
                    window.location.href = '{{ route("provider.subscription-payment", ":id") }}'.replace(':id', selectedPlanId) + '?return_url=' + returnUrl;
                }
            });

            // Back buttons
            $('#step2BackBtn').on('click', function() {
                showStep(1);
            });
            $('#step3BackBtn').on('click', function() {
                showStep(2);
            });
            $('#step4BackBtn').on('click', function() {
                showStep(3);
            });

            // Country/State/City dropdowns
            $("#country_id").on("change", function() {
                var countryId = $("#country_id").val();
                if (countryId) {
                    $.ajax({
                        type: "get",
                        url: "{{ url('/state-by-country/') }}" + "/" + countryId,
                        success: function(response) {
                            if ($("#state_id").hasClass("select2-hidden-accessible")) {
                                $("#state_id").select2('destroy');
                            }
                            $("#state_id").html(response.states || '<option value="">{{ __("Select State") }}</option>');
                            $("#state_id").select2();

                            // Clear city dropdown when country changes
                            if ($("#city_id").hasClass("select2-hidden-accessible")) {
                                $("#city_id").select2('destroy');
                            }
                            $("#city_id").html('<option value="">{{ __("Select City") }}</option>');
                            $("#city_id").select2();
                        },
                        error: function(err) {
                            console.error('Error loading states:', err);
                        }
                    })
                } else {
                    // Clear state and city if country is cleared
                    if ($("#state_id").hasClass("select2-hidden-accessible")) {
                        $("#state_id").select2('destroy');
                    }
                    $("#state_id").html('<option value="">{{ __("Select State") }}</option>');
                    $("#state_id").select2();

                    if ($("#city_id").hasClass("select2-hidden-accessible")) {
                        $("#city_id").select2('destroy');
                    }
                    $("#city_id").html('<option value="">{{ __("Select City") }}</option>');
                    $("#city_id").select2();
                }
            });

            // State change - load cities
            $(document).on('change', '#state_id', function() {
                var stateId = $(this).val();
                if (stateId) {
                    $.ajax({
                        type: "get",
                        url: "{{ url('/city-by-state/') }}" + "/" + stateId,
                        success: function(response) {
                            if ($("#city_id").hasClass("select2-hidden-accessible")) {
                                $("#city_id").select2('destroy');
                            }
                            $("#city_id").html(response.cities || '<option value="">{{ __("Select City") }}</option>');
                            $("#city_id").select2();
                        },
                        error: function(err) {
                            console.error('Error loading cities:', err);
                            if ($("#city_id").hasClass("select2-hidden-accessible")) {
                                $("#city_id").select2('destroy');
                            }
                            $("#city_id").html('<option value="">{{ __("Select City") }}</option>');
                            $("#city_id").select2();
                        }
                    })
                } else {
                    // Clear city if state is cleared
                    if ($("#city_id").hasClass("select2-hidden-accessible")) {
                        $("#city_id").select2('destroy');
                    }
                    $("#city_id").html('<option value="">{{ __("Select City") }}</option>');
                    $("#city_id").select2();
                }
            });

            // Form submission
            $('#providerRegistrationForm').on('submit', function(e) {
                e.preventDefault();

                // Validate terms checkbox
                if (!$('#terms_checkbox').is(':checked')) {
                    alert('{{ __("Please agree to the Terms and Conditions") }}');
                    return;
                }

                // Show loading
                $('#submitBtn').prop('disabled', true).text('{{ __("Submitting...") }}');

                // Submit form via AJAX
                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('request-provider') }}",
                    type: "POST",
                    data: formData,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        $('#submitBtn').prop('disabled', false).text('{{ __("Submit") }}');
                        if (response.status == 1) {
                            toastr.success(response.message);
                            setTimeout(function() {
                                if (response.redirect_url) {
                                    window.location.href = response.redirect_url;
                                } else {
                                    window.location.href = "{{ route('provider.dashboard') }}";
                                }
                            }, 1000);
                        }
                    },
                    error: function(xhr) {
                        $('#submitBtn').prop('disabled', false).text('{{ __("Submit") }}');
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            var errors = xhr.responseJSON.errors;
                            for (var field in errors) {
                                if (errors[field] && errors[field][0]) {
                                    toastr.error(errors[field][0]);
                                    break;
                                }
                            }
                        } else {
                            toastr.error('{{ __("Something went wrong. Please try again.") }}');
                        }
                    }
                });
            });
        });
    </script>
@endsection
