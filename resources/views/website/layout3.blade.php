@php
    $social_icons = App\Models\FooterSocialLink::select('icon', 'link')->get();
@endphp

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
            content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
        <link type="image/png" href="{{ asset($setting->favicon) }}" rel="icon">
        @yield('title')
        @yield('meta')

        <link href="{{ asset('frontend/css/all.min.css') }}" rel="stylesheet">
        <link href="{{ asset('global/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('global/css/select2.min.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/slick.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/jquery.calendar.css') }}" rel="stylesheet">
        <link href="{{ asset('backend/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/spacing.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/style.css') }}?v={{ time() }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/dev.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/responsive.css') }}?v={{ time() }}" rel="stylesheet">
        <link href="{{ asset('toastr/toastr.min.css') }}" rel="stylesheet">
        @if (session()->get('text_direction', 'ltr') == 'rtl')
            <link href="{{ asset('frontend/css/rtl.css') }}" rel="stylesheet">
        @endif

        @include('website.theme_color_css')

        <style>
            {!! customCode()->css !!}
            
            /* Logo Sizes - Force larger logos */
            .main_menu .navbar-brand {
                width: 350px !important;
                max-width: 350px !important;
            }
            
            .main_menu .navbar-brand img,
            .main_menu .navbar-brand img.img-fluid {
                width: 100% !important;
                height: auto !important;
                max-width: 100% !important;
                object-fit: contain !important;
            }
            
            /* Mobile Logo - Larger size on mobile */
            @media (max-width: 991px) {
                .main_menu .navbar-brand {
                    margin-left: 20px !important;
                    max-width: calc(100vw - 100px) !important;
                    width: auto !important;
                    max-height: 100px !important;
                    height: auto !important;
                    display: flex !important;
                    align-items: center !important;
                    justify-content: flex-start !important;
                    align-self: center !important;
                    margin-top: 0 !important;
                    margin-bottom: 0 !important;
                }
                
                .main_menu .navbar-brand img,
                .main_menu .navbar-brand img.img-fluid {
                    max-height: 100px !important;
                    height: auto !important;
                    width: auto !important;
                    max-width: 100% !important;
                    object-fit: contain !important;
                    vertical-align: middle !important;
                    margin: 0 !important;
                }
                
                /* Ensure navbar container is centered */
                .main_menu .container {
                    align-items: center !important;
                    display: flex !important;
                }
            }
            
            .wsus__footer_content .footer_logo {
                width: 300px !important;
                max-width: 300px !important;
            }
            
            .wsus__footer_content .footer_logo img,
            .wsus__footer_content .footer_logo img.img-fluid {
                width: 100% !important;
                height: auto !important;
                max-width: 100% !important;
                object-fit: contain !important;
            }
            
            /* Footer Colors - Force White Background and Black Text */
            footer {
                background: #ffffff !important;
                color: #000000 !important;
            }
            
            footer .wsus__footer_content span,
            footer .wsus__footer_content h2,
            footer .wsus__footer_content .footer_link li a,
            footer .wsus__footer_content .footer_contact li a,
            footer .wsus__footer_content .footer_contact li p {
                color: #000000 !important;
            }
            
            footer .wsus__footer_bottom {
                background: #ffffff !important;
            }
            
            footer .wsus__footer_bottom p {
                color: #000000 !important;
            }
        </style>

        <script>
            {!! customCode()->header_javascript !!}
        </script>

        <!--jquery library js-->
        <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>

        @if ($setting->recaptcha_status == 'active')
            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        @endif

        <script src="{{ asset('frontend/js/flatpickr.js') }}"></script>
        <link href="{{ asset('frontend/css/flatpickr.min.css') }}" rel="stylesheet">

        @if ($setting->google_analytic_status == 'active')
            <script async src="https://www.googletagmanager.com/gtag/js?id={{ $setting->google_analytic_id }}"></script>
            <script>
                window.dataLayer = window.dataLayer || [];

                function gtag() {
                    dataLayer.push(arguments);
                }
                gtag('js', new Date());
                gtag('config', '{{ $setting->google_analytic_id }}');
            </script>
        @endif

        @if ($setting->pixel_status == 'active')
            <script>
                ! function(f, b, e, v, n, t, s) {
                    if (f.fbq) return;
                    n = f.fbq = function() {
                        n.callMethod ?
                            n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                    };
                    if (!f._fbq) f._fbq = n;
                    n.push = n;
                    n.loaded = !0;
                    n.version = '2.0';
                    n.queue = [];
                    t = b.createElement(e);
                    t.async = !0;
                    t.src = v;
                    s = b.getElementsByTagName(e)[0];
                    s.parentNode.insertBefore(t, s)
                }(window, document, 'script',
                    'https://connect.facebook.net/en_US/fbevents.js');
                fbq('init', '{{ $setting->pixel_app_id }}');
                fbq('track', 'PageView');
            </script>
            <noscript>
                <img src="https://www.facebook.com/tr?id={{ $setting->pixel_app_id }}&ev=PageView&noscript=1"
                    style="display:none" height="1" width="1" />
            </noscript>
        @endif
        @stack('css')
    </head>

    <body class="home_3">
        <script>
            {!! customCode()->body_javascript !!}
        </script>

        <!--=========================
             START
        ==========================-->
        <section class="wsus__topbar">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-7 d-none d-lg-block">
                        <ul class="wsus__topbar_info d-flex flex-wrap">
                            <li><a href="callto:{{ $setting->topbar_phone }}"><i class="fas fa-phone-alt"></i>
                                    {{ $setting->topbar_phone }}</a></li>
                            <li><a href="mailto:{{ $setting->topbar_email }}"><i class="fas fa-envelope"></i>
                                    {{ $setting->topbar_email }}</a>
                            </li>
                            <li class="d-none d-sm-block"><span><i class="fas fa-clock"></i>
                                    {{ $setting->opening_time }}</span></li>
                        </ul>
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="wsus__topbar_right d-flex flex-wrap justify-content-end align-items-center">
                            @if (Module::isEnabled('Language') && Route::has('set-locale') && allLanguages()?->where('status', 1)->count() > 1)
                                <form id="change-header-language" action="{{ route('set-locale') }}" method="get">
                                    <select class="form-control select_js mt-1" name="locale">
                                        @foreach (allLanguages()->where('status', 1) as $language)
                                            <option value="{{ $language->code }}" @selected($language->code == app()->getLocale())>
                                                {{ $language->name }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            @endif
                            @if (Module::isEnabled('Currency') &&
                                    Route::has('set-currency') &&
                                    allCurrencies()?->where('status', 'active')->count() > 1)
                                <form id="change-header-currency" action="{{ route('set-currency') }}" method="get">
                                    <select class="form-control select_js mt-1" name="currency">
                                        @foreach (allCurrencies()?->where('status', 'active') as $currency)
                                            <option value="{{ $currency->currency_code }}"
                                                @selected($currency->currency_code == getSessionCurrency())>
                                                {{ $currency->currency_name }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            @endif
                            <ul class="wsus__topbar_icon d-flex flex-wrap">
                                @foreach ($social_icons as $social_icon)
                                    <li><a href="{{ $social_icon->link }}" target="_blank"><i
                                                class="{{ $social_icon->icon }}"></i></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=========================
        TOPBAR END
    ==========================-->

        <!--=========================
        MENU START
    ==========================-->
        <nav class="navbar navbar-expand-lg main_menu">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img class="img-fluid" src="{{ asset($setting->logo) }}" alt="logo">
                </a>
                <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav" type="button"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="far fa-bars open_m_menu"></i>
                    <i class="far fa-times close_m_menu"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav m-auto">
                        @if ($nav_menu)
                            @foreach ($nav_menu as $menu)
                                @if ($loop->first && (str(config('app.app_mode', 'LIVE'))->lower() == 'demo' || $setting->selected_theme == 0))
                                    <x-homepages />
                                @else
                                    <li class="nav-item">
                                        <a href="{{ $menu['child'] ? 'javascript:;' : url($menu['link']) }}"
                                            {{ $menu['open_new_tab'] ? 'target="_blank" rel="noopener noreferrer"' : '' }}
                                            @class([
                                                'nav-link',
                                                'active' => $menu['child'] ? false : isUrlSame($menu['link']),
                                            ])>{{ $menu['label'] }}
                                            @if ($menu['child'])
                                                <i class="ms-1 far fa-angle-down"></i>
                                            @endif
                                        </a>
                                        @if ($menu['child'])
                                            <ul class="wsus__droap_menu">
                                                @foreach ($menu['child'] as $child)
                                                    <li><a href="{{ url($child['link']) }}"
                                                            {{ $child['open_new_tab'] ? 'target="_blank" rel="noopener noreferrer"' : '' }}
                                                            @class(['active' => isUrlSame($child['link'])])>{{ $child['label'] }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                    <ul class="wsus__right_menu d-flex flex-wrap">
                        <li><a href="#"><i class="fas fa-search"></i></a>
                            <form class="search_form" action="{{ route('services') }}">
                                <input name="search" type="text" placeholder="{{ __('Search') }}">
                                <button class="submit" type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </li>
                        <li><a href="{{ route('join-as-a-provider') }}">{{ __('Hire Now') }} <i
                                    class="far fa-angle-right"></i></a></li>
                        <li><a href="{{ route('dashboard') }}"><i class="fas fa-user"></i></a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--=========================
        MENU END
    ==========================-->

        @yield('frontend-content')

        @php
            $social_icons = App\Models\FooterSocialLink::get();
            $footer_informations = App\Models\Footer::first();
            $first_col_links = App\Models\FooterLink::where('column', 1)->get();
            $second_col_links = App\Models\FooterLink::where('column', 2)->get();
        @endphp

        <!--=========================
        FOOTER START
    ==========================-->
        <footer style="background: #ffffff !important; color: #000000 !important;">
            <div class="container pt_100 xs_pt_70">
                <div class="row justify-content-between">
                    <div class="col-lg-4 col-md-10">
                        <div class="wsus__footer_content">
                            <a class="footer_logo" href="{{ route('home') }}">
                                <img class="img-fluid w-100" src="{{ asset($setting->footer_logo) }}"
                                    alt="logo">
                            </a>
                            <span>{{ $footer_informations->about_us }}
                            </span>
                            <ul class="social_link d-flex flex-wrap">
                                @foreach ($social_icons as $social_icon)
                                    <li><a href="{{ $social_icon->link }}" target="_blank"><i
                                                class="{{ $social_icon->icon }}"></i></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="wsus__footer_content">
                            <h2>{{ __('Important Link') }}</h2>
                            <ul class="footer_link">
                                @if ($importantLink)
                                    @foreach ($importantLink as $menu)
                                        <li><a href="{{ url($menu['link']) }}">{{ $menu['label'] }}</a></li>
                                    @endforeach
                                @else
                                    <li><a href="{{ route('contact-us') }}">{{ __('Contact Us') }}</a></li>
                                    <li><a href="{{ route('blogs') }}">{{ __('Our Blog') }}</a></li>
                                    <li><a href="{{ route('faq') }}">{{ __('FAQ') }}</a></li>
                                    <li><a
                                            href="{{ route('terms-and-conditions') }}">{{ __('Terms And Conditions') }}</a>
                                    </li>
                                    <li><a href="{{ route('privacy-policy') }}">{{ __('Privacy Policy') }}</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="wsus__footer_content">
                            <h2>{{ __('Quick Link') }}</h2>
                            <ul class="footer_link">
                                @if ($quickLink)
                                    @foreach ($quickLink as $menu)
                                        <li><a href="{{ url($menu['link']) }}">{{ $menu['label'] }}</a></li>
                                    @endforeach
                                @else
                                    <li><a href="{{ route('services') }}">{{ __('Our Services') }}</a></li>
                                    <li><a href="{{ route('about-us') }}">{{ __('Why Choose Us') }}</a></li>
                                    <li><a href="{{ route('dashboard') }}">{{ __('My Profile') }}</a></li>
                                    <li><a href="{{ route('about-us') }}">{{ __('About Us') }}</a></li>
                                    <li><a
                                            href="{{ route('join-as-a-provider') }}">{{ __('Join as a Provider') }}</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12">
                        <div class="wsus__footer_content m-0 p-0 border-0">
                            <h2>{{ __('Contact Info') }}</h2>
                            <ul class="footer_contact">
                                <li>
                                    <a href="callto:{{ $footer_informations->phone }}"><i
                                            class="fas fa-phone-alt"></i> {{ $footer_informations->phone }}</a>
                                </li>
                                <li>
                                    <a href="mailto:{{ $footer_informations->email }}"><i
                                            class="fas fa-envelope"></i>
                                        {{ $footer_informations->email }}</a>
                                </li>
                                <li>
                                    <p><i class="fas fa-map-marker-alt"></i> {{ $footer_informations->address }}
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wsus__footer_bottom mt_100 xs_mt_70" style="background: #ffffff !important;">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="wsus__footer_bottom_content d-flex justify-content-between align-items-center">
                                <p style="color: #000000 !important;">{{ $footer_informations->copyright }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--=========================
        FOOTER END
    ==========================-->

        <!--=========================
        LIVE CHAT START
    ==========================-->
        @if ($setting->live_chat == 'enable')
            @auth('web')
                <button class="wsus__message__button">
                    <span><img class="img-fluid w-100" src="{{ asset('uploads/website-images/chat_icon.webp') }}"
                            alt="chat"></span>
                    {{ __('Live Chat') }}
                </button>
            @else
                <button class="wsus__message__button" onclick="sendNewMessagePrevLogin()">
                    <span><img class="img-fluid w-100" src="{{ asset('uploads/website-images/chat_icon.webp') }}"
                            alt="chat"></span>
                    {{ __('Live Chat') }}
                </button>
            @endauth
        @endif

        @auth('web')
            <div class="wsus__message_area">
                <p class="heading">
                    <span><img class="img-fluid w-100" src="{{ asset('uploads/website-images/chat_icon.webp') }}"
                            alt="chat"></span>
                    {{ __('Live Chat') }}
                    <a class="close_chat"><i class="fal fa-times-circle"></i></a>
                </p>

                <div class="wsus__main_message">
                    <div class="wsus__message_list">
                        <ul id="provider_existing_list">

                            @php
                                $login_buyer = Auth::guard('web')->user();

                                $providers = App\Models\Message::with('provider')
                                    ->where(['buyer_id' => $login_buyer->id])
                                    ->select('provider_id')
                                    ->groupBy('provider_id')
                                    ->orderBy('id', 'desc')
                                    ->get();

                                $default_avatar = (object) [
                                    'image' => $setting->default_avatar,
                                ];
                            @endphp

                            @foreach ($providers as $provider)
                                <li class="provider-list single-provider-{{ $provider->provider_id }}"
                                    data-provider-id="{{ $provider->provider_id }}"
                                    onclick="loadChatBox({{ $provider->provider_id }})">
                                    <div class="img">
                                        @if ($provider->provider->image)
                                            <img class="img-fluid w-100" src="{{ asset($provider->provider->image) }}"
                                                alt="user">
                                        @else
                                            <img class="img-fluid w-100" src="{{ asset($default_avatar->image) }}"
                                                alt="user">
                                        @endif

                                        @php
                                            $un_read = App\Models\Message::where([
                                                'provider_id' => $provider->provider_id,
                                                'buyer_id' => $login_buyer->id,
                                                'buyer_read_msg' => 0,
                                            ])->count();
                                        @endphp

                                        <span class="{{ $un_read == 0 ? 'd-none' : '' }}"
                                            id="pending-{{ $provider->provider_id }}">{{ $un_read }}</span>
                                    </div>
                                    <div class="text">
                                        <h3>{{ $provider->provider->name }}</h3>
                                        <p>{{ $provider->provider->designation }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="wsus__message_box">

                        <div class="wsus__empty_message">
                            <div class="img">
                                <img class="img-fluid w-100" src="{{ asset('uploads/website-images/empty_chat.webp') }}"
                                    alt="empty">
                            </div>
                            <h3>{{ __('No Message yet!') }}</h3>
                            <p>{{ __('Please choose one') }}</p>
                        </div>

                        <div class="wsus__message_preloader d-none">
                            <span>
                                <img class="img-fluid w-100" src="{{ asset('uploads/website-images/preloader.gif') }}"
                                    alt="preloader">
                            </span>
                        </div>

                        <div class="wsus__message_box_text d-none">

                        </div>
                        <form id="chat-form">
                            @csrf
                            <input id="provider_message" name="message" type="text"
                                placeholder="{{ __('Type message') }}" autocomplete="off">
                            <input id="message_provider_id" name="provider_id" type="hidden">
                            <button type="submit"><i class="fas fa-paper-plane"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        @endauth
        <!--=========================
        LIVE CHAT END
    ==========================-->

        <!--=========================
        SCROLL BUTTON START
    ===========================-->
        <div class="wsus__scroll_btn">
            <span><i class="fas fa-arrow-alt-up"></i></span>
        </div>
        <!--==========================
        SCROLL BUTTON END
    ===========================-->

        @if ($setting->tawk_status == 'active')
            <script type="text/javascript">
                var Tawk_API = Tawk_API || {},
                    Tawk_LoadStart = new Date();
                (function() {
                    var s1 = document.createElement("script"),
                        s0 = document.getElementsByTagName("script")[0];
                    s1.async = true;
                    s1.src = '{{ $setting->tawk_chat_link }}';
                    s1.charset = 'UTF-8';
                    s1.setAttribute('crossorigin', '*');
                    s0.parentNode.insertBefore(s1, s0);
                })();
            </script>
        @endif

        @if ($setting->cookie_status == 'active')
            <script src="{{ asset('frontend/js/cookieconsent.min.js') }}"></script>

            <script>
                window.addEventListener("load", function() {
                    window.wpcc.init({
                        "border": "{{ $setting->border }}",
                        "corners": "{{ $setting->corners }}",
                        "colors": {
                            "popup": {
                                "background": "{{ $setting->background_color }}",
                                "text": "{{ $setting->text_color }} !important",
                                "border": "{{ $setting->border_color }}"
                            },
                            "button": {
                                "background": "{{ $setting->btn_bg_color }}",
                                "text": "{{ $setting->btn_text_color }}"
                            }
                        },
                        "content": {
                            "href": "{{ route('privacy-policy') }}",
                            "message": "{{ $setting->message }}",
                            "link": "{{ $setting->link_text }}",
                            "button": "{{ $setting->btn_text }}"
                        }
                    })
                });
            </script>
        @endif

        <!--bootstrap js-->
        <script src="{{ asset('global/js/bootstrap.bundle.min.js') }}"></script>
        <!--font-awesome js-->
        <script src="{{ asset('frontend/js/Font-Awesome.js') }}"></script>
        <!-- select js -->
        <script src="{{ asset('global/js/select2.min.js') }}"></script>
        <!-- counter up js -->
        <script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery.countup.min.js') }}"></script>
        <!-- slick js -->
        <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
        <!-- calender js -->
        <script src="{{ asset('frontend/js/jquery.calendar.js') }}"></script>
        <!-- sticky sidebar -->
        <script src="{{ asset('frontend/js/sticky_sidebar.js') }}"></script>
        <script src="{{ asset('backend/js/bootstrap-datepicker.min.js') }}"></script>
        <!--main/custom js-->
        <script src="{{ asset('frontend/js/main.js') }}"></script>

        <script src="{{ asset('toastr/toastr.min.js') }}"></script>

        <script src="{{ asset('js/app.js') }}"></script>

        <script>
            @if (Session::has('message'))
                var type = "{{ Session::get('alert-type', 'info') }}"
                switch (type) {
                    case 'info':
                        toastr.info("{{ Session::get('message') }}");
                        break;
                    case 'success':
                        toastr.success("{{ Session::get('message') }}");
                        break;
                    case 'warning':
                        toastr.warning("{{ Session::get('message') }}");
                        break;
                    case 'error':
                        toastr.error("{{ Session::get('message') }}");
                        break;
                }
            @endif
        </script>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <script>
                    toastr.error('{{ $error }}');
                </script>
            @endforeach
        @endif

        <script>
            let active_provider_id = 0;

            (function($) {
                "use strict";
                $(document).ready(function() {
                    $('.datepicker').datepicker({
                        format: 'yyyy-mm-dd',
                        startDate: '-Infinity'
                    });

                    $("#chat-form").on("submit", function(e) {
                        e.preventDefault();
                        if ("{{ config('app.app_mode') }}" == 'DEMO') {
                            toastr.error("{{ __('This Is Demo Version. You Can Not Change Anything') }}");
                            return;
                        }
                        let message = $("#provider_message").val();
                        if (message == '') return;
                        $.ajax({
                            type: "post",
                            data: $('#chat-form').serialize(),
                            url: "{{ url('send-message-to-provider') }}",
                            success: function(response) {
                                $(".wsus__message_box_text").html(response);
                                $("#provider_message").val('');
                                scrollToBottomFunc();
                            },
                            error: function(err) {}
                        })
                    })

                });

            })(jQuery);

            function loadChatBox(provider_id) {
                $("#message_provider_id").val(provider_id);
                active_provider_id = provider_id;
                $(".wsus__empty_message").addClass('d-none');
                $(".wsus__message_preloader").removeClass('d-none');
                $("#pending-" + provider_id).addClass('d-none');

                $(".provider-list").removeClass('active');
                $(".single-provider-" + provider_id).addClass('active');

                $.ajax({
                    type: "get",
                    url: "{{ url('load-chat-box/') }}" + "/" + provider_id,
                    success: function(response) {
                        $(".wsus__message_box_text").html(response)
                        $(".wsus__message_preloader").addClass('d-none');
                        $(".wsus__message_box_text").removeClass('d-none');
                        scrollToBottomFunc();
                    },
                    error: function(err) {}
                })
            }

            function scrollToBottomFunc() {
                $('.wsus__message_box_text').animate({
                    scrollTop: $('.wsus__message_box_text').get(0).scrollHeight
                }, 50);
            }

            function sendNewMessage(name, id, designation, image, service_id = null, service_name = null, service_image =
                null) {

                let root_url = "{{ route('home') }}";
                let avatar = '';
                if (image) {
                    avatar = `<img src="${root_url}/${image}" alt="user" class="img-fluid w-100">`
                } else {
                    avatar = `<img src="${root_url}/${default_avatar}" alt="user" class="img-fluid w-100">`
                }

                let new_item = `<li class="provider-list single-provider-${id}" data-provider-id="${id}" onclick="loadChatBox(${id})">
                <div class="img">
                    ${avatar}
                    <span id="pending-${id}" class="d-none">0</span>
                </div>
                <div class="text">
                    <h3>${name}</h3>
                    <p>${designation}</p>
                </div>
            </li>`;

                let is_exist = false;
                $('.provider-list').each(function() {
                    let provider_Id = $(this).data('provider-id');
                    if (parseInt(provider_Id) == parseInt(id)) is_exist = true;
                });

                if (is_exist == false) {
                    $("#provider_existing_list").prepend(new_item)
                }

                $(".wsus__message_area").addClass("show_chat");

                let _token = "{{ csrf_token() }}";

                $(".single-provider-" + id).click();

                $("#message_provider_id").val(id);

                if (service_id != null) {
                    if ("{{ config('app.app_mode') }}" == 'DEMO') {
                        toastr.error("{{ __('This Is Demo Version. You Can Not Change Anything') }}");
                        return;
                    }
                    $.ajax({
                        type: "post",
                        data: {
                            _token,
                            provider_id: id,
                            service_id: service_id
                        },
                        url: "{{ url('send-message-to-provider') }}",
                        success: function(response) {
                            $(".wsus__message_box_text").html(response);
                            scrollToBottomFunc();
                        },
                        error: function(err) {}
                    })
                }
            }

            function sendNewMessagePrevLogin() {
                toastr.error("{{ __('Please login first') }}");
            }
        </script>

        @auth('web')
            <script src="{{ asset('global/js/axios.min.js') }}"></script>
            <script src="{{ asset('global/js/pusher.min.js') }}"></script>

            <script src="{{ asset('global/js/echo.iife.min.js') }}"></script>

            <script>
                window.axios = axios;
                window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

                window.PUSHER_CONFIG = {
                    appUrl: "{{ url('/') }}",
                    key: "{{ config('broadcasting.connections.pusher.key') }}",
                    cluster: "{{ config('broadcasting.connections.pusher.options.cluster') }}",
                    authEndpoint: "{{ url('/broadcasting/auth') }}"
                };

                // Echo config using dynamic settings
                window.Echo = new window.Echo({
                    broadcaster: 'pusher',
                    key: window.PUSHER_CONFIG.key,
                    cluster: window.PUSHER_CONFIG.cluster,
                    forceTLS: true,
                    authorizer: function(channel, options) {
                        return {
                            authorize: function(socketId, callback) {
                                axios.post(window.PUSHER_CONFIG.authEndpoint, {
                                        socket_id: socketId,
                                        channel_name: channel.name
                                    })
                                    .then(function(response) {
                                        callback(false, response.data);
                                    })
                                    .catch(function(error) {
                                        callback(true, error);
                                    });
                            }
                        };
                    }
                });
            </script>

            <script>
                (function($) {
                    "use strict";
                    $(document).ready(function() {

                        Echo.private("buyer-to-provider.{{ $login_buyer->id }}")
                            .listen('BuyerProviderMessage', (e) => {
                                let sender_provider_id = e.message[0].provider_id;

                                if (parseInt(sender_provider_id) == parseInt(active_provider_id)) {
                                    $("#pending-" + sender_provider_id).addClass('d-none');
                                    $.ajax({
                                        type: "get",
                                        url: "{{ url('load-chat-box/') }}" + "/" + sender_provider_id,
                                        success: function(response) {
                                            $(".wsus__message_box_text").html(response)
                                            scrollToBottomFunc();
                                        },
                                        error: function(err) {}
                                    })
                                } else {

                                    let is_exist = false;
                                    $('.provider-list').each(function() {
                                        let provider_Id = $(this).data('provider-id');
                                        if (parseInt(provider_Id) == parseInt(sender_provider_id))
                                            is_exist = true;
                                    });

                                    if (is_exist) {
                                        let current_qty = $("#pending-" + sender_provider_id).html();
                                        let new_qty = parseInt(current_qty) + parseInt(1);
                                        $("#pending-" + sender_provider_id).html(new_qty);

                                        $("#pending-" + sender_provider_id).removeClass('d-none');
                                    }
                                }
                            });

                    });

                })(jQuery);
            </script>
        @endauth

        @stack('js')

        <script>
            {!! customCode()->footer_javascript !!}
        </script>
    </body>

</html>
