@extends($active_theme)
@section('title')
    <title>{{ __('Login') }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ __('Login') }}">
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
                            <h1>{{ __('Login') }}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('Login') }}</li>
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
                    SIGN IN START
                ==========================-->
    <section class="wsus__sign_in mt_90 xs_mt_60 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-10 col-xxl-10 m-auto">
                    <div class="wsus__sign_in_area">
                        <div class="row justify-content-center">
                            <div class="col-xl-6 col-lg-8">
                                <div class="wsus__review_input wsus__sign_in_text">
                                    <h2>{{ __('Log In to Your Account') }}</h2>
                                    <p>{{ __('Welcome back! Login with your data you entered during registration.') }}</p>
                                    <form action="{{ route('store-login') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <fieldset>
                                                    <legend>{{ __('Email') }}*</legend>
                                                    <input name="email" type="email">
                                                </fieldset>
                                            </div>
                                            <div class="col-xl-12">
                                                <fieldset>
                                                    <legend>{{ __('password') }}*</legend>
                                                    <input name="password" type="password">
                                                </fieldset>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="wsus__login_check d-flex flex-wrap mt_20">
                                                    <div class="form-check">
                                                        <input id="flexCheckDefault" name="remember" type="checkbox">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            {{ __('Remeber Me') }}
                                                        </label>
                                                    </div>
                                                    <a
                                                        href="{{ route('forget-password') }}">{{ __('Forget Password ?') }}</a>
                                                </div>
                                            </div>

                                            @if ($recaptchaSetting->status == 'active')
                                                <div class="col-xl-12">
                                                    <div class="wsus__single_com mt_20">
                                                        <div class="g-recaptcha"
                                                            data-sitekey="{{ $recaptchaSetting->site_key }}"></div>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="col-xl-12">
                                                <button class="common_btn mt_20 w-100"
                                                    type="submit">{{ __('log in') }}</button>
                                            </div>
                                        </div>
                                    </form>

                                    @if ($socialLogin->is_gmail == 1 || $socialLogin->is_facebook == 1)
                                        <span class="or">{{ __('or') }}</span>
                                        <ul>
                                            @if ($socialLogin->is_gmail == 1)
                                                <li><a href="{{ route('login-google') }}"><i
                                                            class="fab         fa-google-plus-g"></i>
                                                        {{ __('Sign In with Google') }}</a>
                                                </li>
                                            @endif
                                            @if ($socialLogin->is_facebook == 1)
                                                <li><a href="{{ route('login-facebook') }}"><i
                                                            class="fab fa-facebook-f"></i>
                                                        {{ __('Sign In with Facebook') }}</a></li>
                                            @endif
                                        </ul>
                                    @endif
                                    <p class="create_account">
                                        {{ __('Dont’t have an account ?') }}
                                        <a href="{{ route('register') }}">{{ __('Create Account') }}</a>
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
                    SIGN IN END
                ==========================-->
@endsection
