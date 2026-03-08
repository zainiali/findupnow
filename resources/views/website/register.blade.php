@extends($active_theme)
@section('title')
    <title>{{ __('Register') }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ __('Register') }}">
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
                            <h1>{{ __('Registration') }}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('Register') }}</li>
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
                    REGISTRATION START
                ==========================-->
    <section class="wsus__sign_in mt_90 xs_mt_60 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-10 col-xxl-10 m-auto">
                    <div class="wsus__sign_in_area">
                        <div class="row justify-content-center">
                            <div class="col-xl-8 col-lg-10">
                                <div class="wsus__review_input wsus__sign_in_text">
                                    <h2>{{ __('Registration') }}</h2>
                                    <p>{{ __('Register your account and post your project in just a few steps.') }}</p>

                                    <!-- Progress Steps -->
                                    <div class="registration-progress mb_40">
                                        <div class="progress-steps">
                                            <div class="step active" data-step="1">
                                                <div class="step-number">1</div>
                                                <div class="step-label">{{ __('Basic Info') }}</div>
                                            </div>
                                            <div class="step" data-step="2">
                                                <div class="step-number">2</div>
                                                <div class="step-label">{{ __('OTP Verify') }}</div>
                                            </div>
                                            <div class="step" data-step="3">
                                                <div class="step-number">3</div>
                                                <div class="step-label">{{ __('Project Type') }}</div>
                                            </div>
                                            <div class="step" data-step="4">
                                                <div class="step-number">4</div>
                                                <div class="step-label">{{ __('Timeline') }}</div>
                                            </div>
                                            <div class="step" data-step="5">
                                                <div class="step-number">5</div>
                                                <div class="step-label">{{ __('Requirements') }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <form id="clientRegistrationForm" method="POST" action="{{ route('store-register') }}">
                                        @csrf

                                        <!-- Step 1: Basic Information -->
                                        <div class="registration-step" id="step1">
                                            <h3 class="step-title">{{ __('Basic Information') }}</h3>
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <fieldset>
                                                        <legend>{{ __('Name') }}*</legend>
                                                        <input name="name" type="text" id="reg_name" required>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-12">
                                                    <fieldset>
                                                        <legend>{{ __('Email') }}*</legend>
                                                        <input name="email" type="email" id="reg_email" required>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-12">
                                                    <fieldset>
                                                        <legend>{{ __('Phone Number') }}*</legend>
                                                        <input name="phone" type="tel" id="reg_phone" required
                                                            placeholder="{{ __('e.g. +92345689008876') }}">
                                                        <small class="d-block text-muted mt-1">{{ __('Enter + then your country code and number with no spaces (e.g. +92345689008876).') }}</small>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-12">
                                                    <fieldset>
                                                        <legend>{{ __('Address') }}*</legend>
                                                        <input name="address" type="text" id="reg_address" required>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-12">
                                                    <button type="button" class="common_btn mt_20 w-100" id="step1NextBtn">
                                                        {{ __('Continue') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Step 2: OTP Verification -->
                                        <div class="registration-step" id="step2" style="display: none;">
                                            <h3 class="step-title">{{ __('OTP Verification') }}</h3>
                                            <p class="mb_20">{{ __('We sent a verification code to your phone number. Please enter it below.') }}</p>
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <fieldset>
                                                        <legend>{{ __('Enter 4-digit OTP') }}*</legend>
                                                        <div class="otp-input-group">
                                                            <input type="text" class="otp-digit" data-index="0" maxlength="1" required>
                                                            <input type="text" class="otp-digit" data-index="1" maxlength="1" required>
                                                            <input type="text" class="otp-digit" data-index="2" maxlength="1" required>
                                                            <input type="text" class="otp-digit" data-index="3" maxlength="1" required>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-12">
                                                    <button type="button" class="common_btn mt_20" id="resendOTPBtn">
                                                        {{ __('Resend OTP') }}
                                                    </button>
                                                </div>
                                                <div class="col-xl-12">
                                                    <button type="button" class="common_btn mt_20 w-100" id="step2NextBtn">
                                                        {{ __('Verify & Continue') }}
                                                    </button>
                                                </div>
                                                <div class="col-xl-12">
                                                    <button type="button" class="common_btn mt_20 w-100 btn-secondary" id="step2BackBtn">
                                                        {{ __('Back') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Step 3: Project Type -->
                                        <div class="registration-step" id="step3" style="display: none;">
                                            <h3 class="step-title">{{ __('What kind of project do you have?') }}</h3>
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <fieldset>
                                                        <legend>{{ __('Select Project Category') }}*</legend>
                                                        <select name="category_id" id="reg_category" required>
                                                            <option value="">{{ __('Select a category') }}</option>
                                                            @php
                                                                $categories = \App\Models\Category::where('status', 1)->with('translation')->get();
                                                            @endphp
                                                            @foreach($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-12">
                                                    <button type="button" class="common_btn mt_20 w-100" id="step3NextBtn">
                                                        {{ __('Continue') }}
                                                    </button>
                                                </div>
                                                <div class="col-xl-12">
                                                    <button type="button" class="common_btn mt_20 w-100 btn-secondary" id="step3BackBtn">
                                                        {{ __('Back') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Step 4: Timeline -->
                                        <div class="registration-step" id="step4" style="display: none;">
                                            <h3 class="step-title">{{ __('When do you need it?') }}</h3>
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="timeline-options">
                                                        <label class="timeline-option">
                                                            <input type="radio" name="timeline" value="immediate" required>
                                                            <span class="timeline-label">
                                                                <strong>{{ __('Immediate') }}</strong>
                                                                <small>{{ __('I need this done as soon as possible') }}</small>
                                                            </span>
                                                        </label>
                                                        <label class="timeline-option">
                                                            <input type="radio" name="timeline" value="1_month" required>
                                                            <span class="timeline-label">
                                                                <strong>{{ __('1 Month') }}</strong>
                                                                <small>{{ __('Within the next month') }}</small>
                                                            </span>
                                                        </label>
                                                        <label class="timeline-option">
                                                            <input type="radio" name="timeline" value="3_months" required>
                                                            <span class="timeline-label">
                                                                <strong>{{ __('3 Months') }}</strong>
                                                                <small>{{ __('Within the next 3 months') }}</small>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <button type="button" class="common_btn mt_20 w-100" id="step4NextBtn">
                                                        {{ __('Continue') }}
                                                    </button>
                                                </div>
                                                <div class="col-xl-12">
                                                    <button type="button" class="common_btn mt_20 w-100 btn-secondary" id="step4BackBtn">
                                                        {{ __('Back') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Step 5: Project Requirements -->
                                        <div class="registration-step" id="step5" style="display: none;">
                                            <h3 class="step-title">{{ __('Project Requirements') }}</h3>
                                            <p class="mb_20">{{ __('Please specify your requirements for this project.') }}</p>
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <fieldset>
                                                        <legend>{{ __('Licensed') }}*</legend>
                                                        <div class="requirement-options">
                                                            <label class="requirement-option">
                                                                <input type="radio" name="licensed" value="yes" required>
                                                                <span>{{ __('Yes') }}</span>
                                                            </label>
                                                            <label class="requirement-option">
                                                                <input type="radio" name="licensed" value="no" required>
                                                                <span>{{ __('No') }}</span>
                                                            </label>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-12">
                                                    <fieldset>
                                                        <legend>{{ __('Insured') }}*</legend>
                                                        <div class="requirement-options">
                                                            <label class="requirement-option">
                                                                <input type="radio" name="insured" value="yes" required>
                                                                <span>{{ __('Yes') }}</span>
                                                            </label>
                                                            <label class="requirement-option">
                                                                <input type="radio" name="insured" value="no" required>
                                                                <span>{{ __('No') }}</span>
                                                            </label>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-12">
                                                    <fieldset>
                                                        <legend>{{ __('Permit Required') }}*</legend>
                                                        <div class="requirement-options">
                                                            <label class="requirement-option">
                                                                <input type="radio" name="permit_required" value="yes" required>
                                                                <span>{{ __('Yes') }}</span>
                                                            </label>
                                                            <label class="requirement-option">
                                                                <input type="radio" name="permit_required" value="no" required>
                                                                <span>{{ __('No') }}</span>
                                                            </label>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-12">
                                                    <fieldset>
                                                        <legend>{{ __('Project Description') }}</legend>
                                                        <textarea name="description" id="reg_description" rows="4" placeholder="{{ __('Tell us more about your project...') }}"></textarea>
                                                    </fieldset>
                                                </div>
                                                @if ($recaptchaSetting->status == 'active')
                                                    <div class="col-xl-12">
                                                        <div class="wsus__single_com mt_20">
                                                            <div class="g-recaptcha" data-sitekey="{{ $recaptchaSetting->site_key }}"></div>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="col-xl-12">
                                                    <button type="submit" class="common_btn mt_20 w-100" id="submitBtn">
                                                        {{ __('Submit Project') }}
                                                    </button>
                                                </div>
                                                <div class="col-xl-12">
                                                    <button type="button" class="common_btn mt_20 w-100 btn-secondary" id="step5BackBtn">
                                                        {{ __('Back') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <p class="create_account mt_30">
                                        {{ __('Already have an account ?') }}
                                        <a href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================
                    REGISTRATION END
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
        .otp-input-group {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin: 20px 0;
        }
        .otp-digit {
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 24px;
            border: 2px solid #ddd;
            border-radius: 5px;
        }
        .otp-digit:focus {
            border-color: #007bff;
            outline: none;
        }
        .timeline-options {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .timeline-option {
            display: flex;
            align-items: center;
            padding: 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .timeline-option:hover {
            border-color: #007bff;
            background: #f8f9fa;
        }
        .timeline-option input[type="radio"] {
            margin-right: 15px;
        }
        .timeline-option input[type="radio"]:checked + .timeline-label {
            color: #007bff;
        }
        .timeline-label {
            display: flex;
            flex-direction: column;
        }
        .timeline-label strong {
            font-size: 16px;
            margin-bottom: 5px;
        }
        .timeline-label small {
            font-size: 14px;
            color: #666;
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
        .btn-secondary {
            background: #6c757d;
            border-color: #6c757d;
        }
        .btn-secondary:hover {
            background: #5a6268;
            border-color: #545b62;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let currentStep = 1;
            const totalSteps = 5;
            let otpVerified = false;

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

            // Step 1: Basic Information
            $('#step1NextBtn').on('click', function() {
                const name = $('#reg_name').val();
                const email = $('#reg_email').val();
                const phone = $('#reg_phone').val();
                const address = $('#reg_address').val();

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

                // Send OTP
                $.ajax({
                    url: "{{ route('send-otp') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        contact: phone,
                        type: 'phone'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            showStep(2);
                            setTimeout(() => {
                                $('.otp-digit').first().focus();
                            }, 400);
                        } else {
                            alert(response.message || '{{ __("Failed to send OTP") }}');
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = '{{ __("Failed to send OTP. Please try again.") }}';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        alert(errorMessage);
                    }
                });
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
                    $(this).val('');
                    if (index > 0) {
                        $(`.otp-digit[data-index="${index - 1}"]`).focus();
                    }
                }
            });

            // Resend OTP
            $('#resendOTPBtn').on('click', function() {
                const phone = $('#reg_phone').val();
                if (!phone) {
                    alert('{{ __("Phone number is required") }}');
                    return;
                }
                $.ajax({
                    url: "{{ route('send-otp') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        contact: phone,
                        type: 'phone'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            alert('{{ __("OTP sent successfully") }}');
                        } else {
                            alert(response.message || '{{ __("Failed to send OTP") }}');
                        }
                    },
                    error: function(xhr) {
                        alert('{{ __("Failed to send OTP. Please try again.") }}');
                    }
                });
            });

            // Step 2: Verify OTP
            $('#step2NextBtn').on('click', function() {
                let otp = '';
                $('.otp-digit').each(function() {
                    otp += $(this).val();
                });

                if (otp.length < 4) {
                    alert('{{ __("Please enter the 4-digit verification code") }}');
                    return;
                }

                $.ajax({
                    url: "{{ route('verify-otp') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        otp: otp
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            otpVerified = true;
                            showStep(3);
                        } else {
                            alert(response.message || '{{ __("Invalid verification code") }}');
                        }
                    },
                    error: function(xhr) {
                        const message = xhr.responseJSON ? xhr.responseJSON.message : '{{ __("Invalid verification code") }}';
                        alert(message);
                    }
                });
            });

            // Step 3: Project Type
            $('#step3NextBtn').on('click', function() {
                const category = $('#reg_category').val();
                if (!category) {
                    alert('{{ __("Please select a project category") }}');
                    return;
                }
                showStep(4);
            });

            // Step 4: Timeline
            $('#step4NextBtn').on('click', function() {
                const timeline = $('input[name="timeline"]:checked').val();
                if (!timeline) {
                    alert('{{ __("Please select a timeline") }}');
                    return;
                }
                showStep(5);
            });

            // Back buttons
            $('#step2BackBtn').on('click', function() {
                showStep(1);
            });
            $('#step3BackBtn').on('click', function() {
                if (otpVerified) {
                    showStep(2);
                } else {
                    showStep(1);
                }
            });
            $('#step4BackBtn').on('click', function() {
                showStep(3);
            });
            $('#step5BackBtn').on('click', function() {
                showStep(4);
            });

            // Form submission
            $('#clientRegistrationForm').on('submit', function(e) {
                e.preventDefault();

                if (!otpVerified) {
                    alert('{{ __("Please complete OTP verification first") }}');
                    return;
                }

                // Validate all required fields
                const licensed = $('input[name="licensed"]:checked').val();
                const insured = $('input[name="insured"]:checked').val();
                const permitRequired = $('input[name="permit_required"]:checked').val();

                if (!licensed || !insured || !permitRequired) {
                    alert('{{ __("Please answer all requirement questions") }}');
                    return;
                }

                // Show loading
                $('#submitBtn').prop('disabled', true).text('{{ __("Submitting...") }}');

                // Submit form
                this.submit();
            });
        });
    </script>
@endsection
