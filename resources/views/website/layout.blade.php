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

        <link href="{{ asset('frontend/css/nice-select.css') }}" rel="stylesheet">

        <link href="{{ asset('frontend/css/style.css') }}?v={{ time() }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/dev.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/responsive.css') }}?v={{ time() }}" rel="stylesheet">
        <link href="{{ asset('toastr/toastr.min.css') }}" rel="stylesheet">

        @if (session()->get('text_direction', 'ltr') == 'rtl')
            <link href="{{ asset('frontend/css/rtl.css') }}" rel="stylesheet">
        @endif

        <style>
            {!! customCode()->css !!}

            /* Remove topbar spacing and move header to top */
            .wsus__topbar {
                display: none !important;
                height: 0 !important;
                margin: 0 !important;
                padding: 0 !important;
                position: absolute !important;
                visibility: hidden !important;
            }

            #app {
                margin-top: 0 !important;
                padding-top: 0 !important;
            }

            .main_menu {
                margin-top: 0 !important;
                padding-top: 0 !important;
                top: 0 !important;
                position: fixed !important;
                width: 100% !important;
                left: 0 !important;
                right: 0 !important;
                z-index: 9999 !important;
                background: white !important;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1) !important;
            }

            html {
                padding-top: 0 !important;
                margin-top: 0 !important;
            }

            /* Remove topbar space on mobile - Override responsive.css */
            @media (max-width: 991px) {
                .main_menu {
                    top: 0 !important;
                    margin-top: 0 !important;
                    padding-top: 0 !important;
                    padding-bottom: 0 !important;
                    margin-bottom: 0 !important;
                    position: fixed !important;
                    width: 100% !important;
                    left: 0 !important;
                    right: 0 !important;
                    z-index: 9999 !important;
                    background: white !important;
                    box-shadow: 0 2px 5px rgba(0,0,0,0.1) !important;
                }

                /* Remove any gap from container */
                .main_menu .container-fluid,
                .main_menu .container {
                    margin-top: 0 !important;
                    padding-top: 0 !important;
                    margin-bottom: 0 !important;
                    padding-bottom: 0 !important;
                }

                /* Ensure navbar itself has no bottom spacing */
                .main_menu.navbar {
                    margin-bottom: 0 !important;
                    padding-bottom: 0 !important;
                }
            }

            @media (max-width: 575.99px) {
                .main_menu {
                    top: 0 !important;
                    margin-top: 0 !important;
                    padding-top: 0 !important;
                    position: fixed !important;
                    width: 100% !important;
                    left: 0 !important;
                    right: 0 !important;
                    z-index: 9999 !important;
                    background: white !important;
                    box-shadow: 0 2px 5px rgba(0,0,0,0.1) !important;
                }
            }

            /* Add padding to body to prevent content from going under fixed header */
            body {
                padding-top: 80px !important;
            }

            @media (max-width: 991px) {
                body {
                    padding-top: 70px !important;
                }
            }

            /* Counter Section Background - Blue Color (Same as Buttons) */
            .wsus__counter_overlay {
                background: #378FFF !important;
                background-color: #378FFF !important;
            }

            .wsus__counter {
                background: #378FFF !important;
                background-color: #378FFF !important;
            }

            /* Logo Sizes - Force larger logos */
            .main_menu .navbar-brand {
                width: auto !important;
                max-width: 250px !important;
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
                    max-width: calc(100vw - 170px) !important;
                    width: auto !important;
                    max-height: 130px !important;
                    height: auto !important;
                    display: flex !important;
                    align-items: center !important;
                    justify-content: flex-start !important;
                    align-self: center !important;
                    margin-top: 0 !important;
                    margin-bottom: 0 !important;
                }

                .main_menu .container-fluid {
                    position: relative !important;
                }

                .main_menu .navbar-brand img,
                .main_menu .navbar-brand img.img-fluid {
                    max-height: 130px !important;
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
                    justify-content: space-between !important;
                    height: 100px !important;
                    min-height: 100px !important;
                    padding-top: 0px !important;
                }

                /* Ensure logo and hamburger button are on the same line */
                .main_menu .navbar-brand {
                    display: flex !important;
                    align-items: center !important;
                    align-self: center !important;
                    margin: 0 !important;
                    margin-top: -25px !important;
                    padding: 0 !important;
                    height: auto !important;
                    line-height: 1 !important;
                }

                .main_menu .navbar-brand img {
                    vertical-align: middle !important;
                    display: block !important;
                    margin: 0 !important;
                    padding: 0 !important;
                }

                .navbar-toggler {
                    display: flex !important;
                    align-items: center !important;
                    justify-content: center !important;
                    align-self: center !important;
                    margin: 0 !important;
                    margin-top: -25px !important;
                    vertical-align: middle !important;
                }

                .navbar-toggler i {
                    line-height: 1 !important;
                    vertical-align: middle !important;
                }
            }

            .wsus__footer_content .footer_logo {
                width: 100% !important;
                max-width: 250px !important;
                display: block !important;
            }

            /* Override for footer logo section */
            .footer-logo-section .footer_logo {
                max-width: 500px !important;
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

            /* Footer Container - Remove Top Padding */
            .footer-top-container {
                padding-top: 0 !important;
            }

            @media (max-width: 767px) {
                .footer-top-container {
                    padding-top: 40px !important;
                }
            }

            /* Footer Logo and Description - Centered */
            .footer-logo-section {
                text-align: center !important;
                margin-top: 0 !important;
                padding-top: 0 !important;
            }

            .footer-logo-section .footer_logo {
                margin: 0 auto !important;
                max-width: 350px !important;
                margin-bottom: -60px !important;
                padding-bottom: 0 !important;
                display: block !important;
                line-height: 0 !important;
            }

            .footer-logo-section .footer_logo img {
                margin-bottom: 0 !important;
                padding-bottom: 0 !important;
                display: block !important;
                vertical-align: bottom !important;
                line-height: 0 !important;
            }

            .footer-logo-section .footer-description {
                display: block !important;
                max-width: 600px;
                margin: 0 auto !important;
                margin-top: -60px !important;
                margin-bottom: 40px !important;
                padding-top: 0 !important;
                padding-bottom: 0 !important;
                text-align: center;
                line-height: 1.4 !important;
                word-wrap: break-word;
            }

            /* Remove any spacing between logo and description - Override external CSS */
            .footer-logo-section .footer_logo + .footer-description,
            .wsus__footer_content.footer-logo-section .footer-description,
            .wsus__footer_content.footer-logo-section span.footer-description,
            footer .wsus__footer_content.footer-logo-section span.footer-description {
                margin-top: -60px !important;
                margin-bottom: 40px !important;
                padding-top: 0 !important;
            }

            /* Override external CSS rule for span - Very aggressive */
            .wsus__footer_content.footer-logo-section span.footer-description,
            footer .wsus__footer_content.footer-logo-section span.footer-description,
            .footer-logo-section span.footer-description {
                margin: -60px auto 40px auto !important;
                margin-top: -60px !important;
                margin-bottom: 40px !important;
            }

            /* Why Customers Love Section - Three Points with Icons */
            .why_customers_love_point {
                padding: 20px;
                height: 100%;
            }

            .why_customers_love_icon {
                width: 80px;
                height: 80px;
                margin: 0 auto;
                display: flex;
                align-items: center;
                justify-content: center;
                background: var(--colorPrimary);
                border-radius: 50%;
                color: #ffffff;
                font-size: 32px;
                transition: all linear .3s;
            }

            .why_customers_love_icon:hover {
                transform: scale(1.1);
                box-shadow: 0 8px 16px rgba(55, 143, 255, 0.3);
            }

            .why_customers_love_point_text {
                font-size: 16px;
                font-weight: 400;
                color: #6b7280;
                line-height: 1.7;
                margin: 0;
                font-family: var(--paraFont);
                text-align: justify;
            }

            /* Increase heading size */
            .wsus__why_customers_love_title {
                font-size: 48px !important;
            }

            @media (max-width: 991px) {
                .wsus__why_customers_love_title {
                    font-size: 38px !important;
                }
            }

            @media (max-width: 767px) {
                .why_customers_love_point {
                    padding: 10px 5px;
                    margin-bottom: 20px;
                }

                .why_customers_love_icon {
                    width: 50px;
                    height: 50px;
                    font-size: 20px;
                    margin-bottom: 10px !important;
                }

                .why_customers_love_point_text {
                    font-size: 14px;
                }

                .wsus__why_customers_love_title {
                    font-size: 32px !important;
                    margin-bottom: 30px !important;
                }
            }

            /* Footer Sections Layout - Desktop Only */
            @media (min-width: 992px) {
                .footer-sections-row {
                    display: flex;
                    justify-content: space-between;
                    padding: 0 2rem;
                }

                .footer-section-item {
                    flex: 1;
                    max-width: calc(25% - 1.5rem);
                    margin: 0;
                }
            }

            /* Footer Bottom Spacing */
            .footer-bottom-section {
                margin-top: 50px !important;
            }

            /* Social Links in Contact Info */
            .wsus__footer_content .footer_contact + .social_link {
                margin-top: 20px;
            }

            @media (max-width: 991px) {
                .footer-bottom-section {
                    margin-top: 40px !important;
                }
            }

            /* Mobile Dropdown - Always visible, no toggle */
            @media (max-width: 991px) {
                /* Ensure nav-item with dropdown is block-level */
                .main_menu .navbar-nav .nav-item.has-dropdown {
                    display: block !important;
                    width: 100% !important;
                    position: relative !important;
                    float: none !important;
                }

                /* Ensure dropdown is below nav-link, not side-by-side */
                .main_menu .navbar-nav .nav-item.has-dropdown .wsus__droap_menu {
                    display: block !important;
                    visibility: visible !important;
                    opacity: 1 !important;
                    max-height: 1000px !important;
                    height: auto !important;
                    padding: 10px 0 !important;
                    position: static !important;
                    width: 100% !important;
                    left: auto !important;
                    right: auto !important;
                    top: auto !important;
                    bottom: auto !important;
                    transform: none !important;
                    background: #f8f9fa !important;
                    border: none !important;
                    box-shadow: none !important;
                    margin: 0 !important;
                    float: none !important;
                    clear: both !important;
                }

                /* Hide arrow icon on mobile */
                .main_menu .navbar-nav .nav-item.has-dropdown .nav-link .dropdown-toggle-icon {
                    display: none !important;
                }
            }

            /* Language Selector in Navigation - Centered */
            .main_menu .navbar-nav .nav-item.language-form-nav,
            .main_menu .navbar-nav .nav-item:has(form#change-header-language) {
                display: flex !important;
                align-items: center !important;
                height: auto !important;
                margin: 0 !important;
                padding: 0 10px !important;
            }

            .main_menu .navbar-nav form#change-header-language.language-form-nav {
                display: flex !important;
                align-items: center !important;
                margin: 0 !important;
                padding: 0 !important;
                height: auto !important;
            }

            .main_menu .navbar-nav form#change-header-language .language-select-nav,
            .main_menu .navbar-nav form#change-header-language select {
                border: 1px solid #007bff !important;
                border-radius: 4px !important;
                padding: 8px 12px !important;
                font-size: 14px !important;
                min-width: 100px !important;
                background: white !important;
                color: #333 !important;
                cursor: pointer !important;
                transition: all 0.3s ease !important;
                line-height: 1.5 !important;
                margin: 0 !important;
                vertical-align: middle !important;
                height: auto !important;
            }

            .main_menu .navbar-nav .nav-item {
                display: flex !important;
                align-items: center !important;
            }

            .main_menu .navbar-nav form#change-header-language select:hover {
                border-color: #0056b3 !important;
                background: #f8f9fa !important;
            }

            /* Ensure language selector aligns with nav links */
            .main_menu .navbar-nav {
                display: flex !important;
                align-items: center !important;
                flex-wrap: wrap !important;
            }

            .main_menu .navbar-nav .nav-link {
                display: flex !important;
                align-items: center !important;
                line-height: 1.5 !important;
            }

            /* Mobile Navbar - Reduce size to 40% and fix spacing */
            @media (max-width: 991px) {
                /* Remove gap between header and navbar - stick to header with NO space */
                .main_menu .navbar-collapse {
                    position: absolute !important;
                    top: 100% !important;
                    left: 0 !important;
                    right: 0 !important;
                    width: 100vw !important;
                    max-width: 100vw !important;
                    background: var(--colorWhite) !important;
                    box-shadow: 0 4px 10px rgba(0,0,0,0.1) !important;
                    z-index: 999 !important;
                    margin-top: 0 !important;
                    padding-top: 0 !important;
                    margin-bottom: 0 !important;
                    padding-bottom: 0 !important;
                    margin-left: calc(-50vw + 50%) !important;
                    margin-right: calc(-50vw + 50%) !important;
                    max-height: calc(100vh - 100px) !important;
                    overflow-y: auto !important;
                    overflow-x: hidden !important;
                    -webkit-overflow-scrolling: touch !important;
                    scroll-behavior: smooth !important;
                    border-top: none !important;
                    transform: translateY(0) !important;
                }

                /* Ensure when menu shows, there's NO gap - override responsive.css */
                .main_menu .navbar-collapse.show,
                .main_menu .navbar-collapse.collapsing {
                    margin-top: 0 !important;
                    padding-top: 0 !important;
                    top: 100% !important;
                    transform: translateY(0) !important;
                    display: block !important;
                }

                /* Force remove any spacing from navbar-nav - override responsive.css */
                .main_menu .navbar-collapse .navbar-nav {
                    margin-top: 0 !important;
                    padding-top: 0 !important;
                    padding-bottom: 0 !important;
                    margin-bottom: 0 !important;
                    line-height: 1 !important;
                    background: var(--colorWhite) !important;
                    border-top: 1px solid var(--colorPrimary) !important;
                }

                /* Use negative margin to pull navbar-collapse up to eliminate any gap */
                .main_menu .navbar-collapse.show {
                    margin-top: -2px !important; /* Pull up to eliminate any border/space */
                    top: 100% !important;
                }

                /* Remove navbar bottom spacing completely */
                .main_menu.navbar {
                    margin-bottom: 0 !important;
                    padding-bottom: 0 !important;
                    border-bottom: none !important;
                }

                /* Ensure navbar container has no gap - override all padding */
                .main_menu .container-fluid,
                .main_menu .container-fluid.px-xl-5 {
                    margin-top: 0 !important;
                    padding-top: 0 !important;
                    margin-bottom: 0 !important;
                    padding-bottom: 0 !important;
                }

                /* Remove any gap from navbar-collapse container */
                .main_menu .navbar-collapse .container-fluid,
                .main_menu .navbar-collapse > * {
                    margin-top: 0 !important;
                    padding-top: 0 !important;
                }

                /* Remove ALL spacing from navbar-nav - COMPLETE removal - Override responsive.css */
                .main_menu .navbar-nav,
                .main_menu .navbar-collapse .navbar-nav,
                .main_menu .navbar-collapse.show .navbar-nav,
                .main_menu .navbar-collapse.collapsing .navbar-nav,
                .main_menu .navbar-nav.navbar-nav,
                .main_menu .container-fluid .navbar-nav {
                    margin-top: 0 !important;
                    padding-top: 0 !important;
                    padding-bottom: 0 !important;
                    padding-left: 0 !important;
                    padding-right: 0 !important;
                    margin-bottom: 0 !important;
                    margin-left: 0 !important;
                    margin-right: 0 !important;
                    line-height: 1 !important;
                    background: var(--colorWhite) !important;
                    border-top: 1px solid var(--colorPrimary) !important;
                    gap: 0 !important;
                    list-style: none !important;
                }

                /* Remove any spacing from first nav-item */
                .main_menu .navbar-nav .nav-item:first-child,
                .main_menu .navbar-collapse .navbar-nav .nav-item:first-child {
                    margin-top: 0 !important;
                    margin-bottom: 0 !important;
                    padding-top: 0 !important;
                    padding-bottom: 0 !important;
                }

                /* Remove ALL spacing from nav-item */
                .main_menu .navbar-nav .nav-item {
                    padding: 0 !important;
                    margin: 0 !important;
                    line-height: 1 !important;
                    gap: 0 !important;
                }

                /* Remove spacing between nav-items */
                .main_menu .navbar-nav .nav-item + .nav-item {
                    margin-top: 0 !important;
                    margin-bottom: 0 !important;
                    padding-top: 0 !important;
                    padding-bottom: 0 !important;
                }

                /* Remove ALL spacing from nav-link */
                .main_menu .navbar-nav .nav-link {
                    font-size: 10px !important;
                    padding: 0 !important;
                    margin: 0 !important;
                    line-height: 1 !important;
                    font-weight: 400 !important;
                    display: block !important;
                }

                /* Additional spacing removal for all screen sizes 991px and below */
                .main_menu .navbar-nav li {
                    margin: 0 !important;
                    padding: 0 !important;
                    line-height: 1 !important;
                }

                .main_menu .navbar-nav li + li {
                    margin-top: 0 !important;
                    padding-top: 0 !important;
                }

                /* Dropdown menu items - Increase size for Pages dropdown */
                .main_menu .navbar-nav .nav-item .wsus__droap_menu {
                    padding: 8px 0 !important; /* Increased padding */
                }

                .main_menu .navbar-nav .nav-item .wsus__droap_menu li a {
                    font-size: 14px !important; /* Increased font size - readable size */
                    padding: 10px 20px !important; /* Increased padding for better touch targets */
                    line-height: 1.5 !important;
                }

                /* Language selector - 40% size */
                .main_menu .navbar-nav .nav-item:has(form#change-header-language) {
                    padding: 4px 6px !important; /* 40% of 10px 15px */
                    width: 100% !important;
                }

                .main_menu .navbar-nav form#change-header-language {
                    width: 100% !important;
                }

                .main_menu .navbar-nav form#change-header-language select {
                    width: 100% !important;
                    font-size: 10px !important; /* Very small text - 20% size */
                    padding: 4px 6px !important; /* Reduced padding */
                }

                /* Right menu items - 40% size */
                .wsus__right_menu {
                    padding: 4px 0 8px 0 !important; /* 40% of 10px 0 20px 0 */
                    background: var(--colorWhite);
                }

                .wsus__right_menu .login-text-link {
                    font-size: 10px !important; /* Very small text - 20% size */
                    padding: 4px 8px !important; /* Reduced padding */
                }

                /* Hide desktop profile dropdown on mobile - show only in header */
                .wsus__right_menu .dropdown.profile-dropdown-desktop {
                    display: none !important;
                }

                /* Mobile profile dropdown styling in header */
                .mobile_profile_dropdown {
                    position: absolute;
                    right: 65px;
                    top: 35%;
                    transform: translateY(-50%);
                    z-index: 1002;
                }

                .mobile_profile_dropdown .profile-dropdown-toggle-mobile img {
                    width: 40px !important;
                    height: 40px !important;
                    border: 2px solid #378FFF;
                    transition: all 0.3s ease;
                }

                .mobile_profile_dropdown .profile-dropdown-toggle-mobile:hover img,
                .mobile_profile_dropdown .profile-dropdown-toggle-mobile:focus img {
                    border-color: #2563eb;
                    box-shadow: 0 0 0 3px rgba(55, 143, 255, 0.2);
                }

                .mobile_profile_dropdown .dropdown-menu {
                    margin-top: 10px !important;
                    box-shadow: 0 4px 10px rgba(0,0,0,0.15) !important;
                }
            }

            /* Additional override for tablet sizes (768px to 991px) - Remove ALL spacing */
            @media (min-width: 768px) and (max-width: 991px) {
                .main_menu .navbar-nav,
                .main_menu .navbar-collapse .navbar-nav,
                .main_menu .navbar-nav .nav-item,
                .main_menu .navbar-nav .nav-link {
                    padding: 0 !important;
                    margin: 0 !important;
                    gap: 0 !important;
                    line-height: 1 !important;
                }

                .main_menu .navbar-nav .nav-item + .nav-item {
                    margin-top: 0 !important;
                    padding-top: 0 !important;
                }

                .main_menu .navbar-nav li + li {
                    margin-top: 0 !important;
                    padding-top: 0 !important;
                }
            }

            /* Login Text Link - Blue Color and Professional Alignment */
            .wsus__right_menu .login-text-link {
                color: #378FFF !important;
                font-weight: 500 !important;
                font-size: 16px !important;
                text-decoration: none !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                padding: 10px 28px !important;
                transition: all 0.3s ease !important;
                min-width: 80px !important;
            }

            .wsus__right_menu .login-text-link:hover {
                color: #2563eb !important;
                text-decoration: none !important;
            }

            .wsus__right_menu li:has(.login-text-link) {
                display: flex !important;
                align-items: center !important;
            }

            /* User Profile Dropdown in Header */
            .wsus__right_menu .dropdown .nav-link {
                display: flex !important;
                align-items: center !important;
                padding: 8px 15px !important;
                text-decoration: none !important;
                color: #333 !important;
                border-radius: 5px !important;
                transition: all 0.3s ease !important;
                background: transparent !important;
                border: none !important;
                box-shadow: none !important;
            }

            .wsus__right_menu .dropdown .nav-link:hover {
                background-color: transparent !important;
                color: #007bff !important;
            }

            .wsus__right_menu .dropdown .dropdown-menu {
                min-width: 200px !important;
                border: 1px solid #e0e0e0 !important;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1) !important;
                margin-top: 5px !important;
            }

            .wsus__right_menu .dropdown .dropdown-item {
                padding: 10px 15px !important;
                display: flex !important;
                align-items: center !important;
                transition: all 0.2s ease !important;
            }

            .wsus__right_menu .dropdown .dropdown-item:hover {
                background-color: #f8f9fa !important;
            }

            .wsus__right_menu .dropdown .dropdown-item i {
                width: 20px !important;
                text-align: center !important;
                border: none !important;
                outline: none !important;
                box-shadow: none !important;
                background: transparent !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            /* Remove boxes/outlines from icons */
            .wsus__right_menu .dropdown .dropdown-item i::before,
            .wsus__right_menu .dropdown .dropdown-item i::after {
                border: none !important;
                outline: none !important;
                box-shadow: none !important;
                background: transparent !important;
            }

            /* Remove any background boxes from dropdown items */
            .wsus__right_menu .dropdown .dropdown-item {
                border: none !important;
                outline: none !important;
            }

            .wsus__right_menu .dropdown .dropdown-item * {
                border: none !important;
                outline: none !important;
                box-shadow: none !important;
            }

            /* CRITICAL: Ensure navbar toggler is clickable on mobile */
            @media (max-width: 991px) {
                .navbar-toggler {
                    cursor: pointer !important;
                    pointer-events: auto !important;
                    z-index: 1001 !important;
                    position: relative !important;
                    touch-action: manipulation !important;
                }

                .navbar-toggler i {
                    pointer-events: none !important;
                }
            }

            /* Mobile Join Button */
            .mobile_join_btn {
                position: absolute;
                right: 65px;
                top: 35%;
                transform: translateY(-50%);
                text-transform: capitalize;
                font-size: 14px;
                font-weight: 600;
                color: var(--colorPrimary);
                border: 1px solid var(--colorPrimary);
                background: white;
                border-radius: 5px;
                padding: 6px 12px;
                text-decoration: none !important;
                transition: all linear .3s;
                white-space: nowrap;
                z-index: 1002;
                margin: 0 !important;
            }
            .mobile_join_btn:hover {
                background: var(--colorPrimary);
                color: white !important;
            }
            /* Adjust positioning on very small screens if needed */
            @media (max-width: 350px) {
                .mobile_join_btn {
                    font-size: 12px;
                    padding: 4px 8px;
                }
            }
        </style>

        <script>
            "use strict";

            {!! customCode()->header_javascript !!}
        </script>

        @include('website.theme_color_css')

        <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>

        @if ($setting->recaptcha_status == 'active')
            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        @endif

        <link href="{{ asset('frontend/css/flatpickr.min.css') }}" rel="stylesheet">
        <script src="{{ asset('frontend/js/flatpickr.js') }}"></script>

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

    <body>
        <script>
            "use strict";

            {!! customCode()->body_javascript !!}
        </script>
        <div id="app">
            <!--=========================
            MENU START
        ==========================-->
            <nav class="navbar navbar-expand-lg main_menu">
                <div class="container-fluid px-xl-5">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img class="img-fluid" src="{{ asset($setting->logo) }}" alt="logo">
                    </a>

                    {{-- Mobile Profile/Join Button - Show profile if logged in, Join as Pro if guest --}}
                    @auth('web')
                        @php
                            $logged_user = Auth::guard('web')->user();
                        @endphp
                        <div class="mobile_profile_dropdown d-lg-none" style="position: absolute; right: 65px; top: 35%; transform: translateY(-50%); z-index: 1002;">
                            <div class="dropdown">
                                <a class="profile-dropdown-toggle-mobile" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="display: flex; align-items: center; padding: 5px; text-decoration: none;">
                                    @if ($logged_user->image)
                                        <img class="rounded-circle" src="{{ asset($logged_user->image) }}" alt="user" style="width: 40px; height: 40px; object-fit: cover; border: 2px solid #378FFF;">
                                    @else
                                        <img class="rounded-circle" src="{{ asset($setting->default_avatar) }}" alt="user" style="width: 40px; height: 40px; object-fit: cover; border: 2px solid #378FFF;">
                                    @endif
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" style="min-width: 200px; margin-top: 10px;">
                                    <li>
                                        <div class="px-3 py-2">
                                            <h6 class="mb-1" style="font-weight: 600; font-size: 14px;">{{ $logged_user->name }}</h6>
                                            <small class="text-muted" style="font-size: 12px;">
                                                @if ($logged_user->is_provider == 1)
                                                    <i class="fas fa-user-tie me-1"></i>{{ __('Provider') }}
                                                @else
                                                    <i class="fas fa-user me-1"></i>{{ __('Customer') }}
                                                @endif
                                            </small>
                                        </div>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('dashboard') }}" style="padding: 10px 15px;">
                                            <i class="far fa-user me-2"></i>{{ __('Dashboard') }}
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="{{ route('user.logout') }}" style="padding: 10px 15px;">
                                            <i class="fas fa-sign-out-alt me-2"></i>{{ __('Logout') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('join-as-a-provider') }}" class="mobile_join_btn d-lg-none">{{ __('Join as Pro') }}</a>
                    @endauth

                    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav" type="button"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="far fa-bars open_m_menu"></i>
                        <i class="far fa-times close_m_menu"></i>
                    </button>
                    <script>
                        // IMMEDIATE NAVBAR FIX - Runs right after button is created
                        (function() {
                            function toggleMenu() {
                                var menu = document.getElementById('navbarNav');
                                var toggler = document.querySelector('.navbar-toggler');

                                if (!menu || !toggler) return;

                                if (window.innerWidth <= 991) {
                                    var isOpen = menu.classList.contains('show');
                                    if (isOpen) {
                                        menu.classList.remove('show', 'collapsing');
                                        menu.classList.add('collapse');
                                        toggler.classList.remove('show_m_close');
                                        toggler.setAttribute('aria-expanded', 'false');
                                    } else {
                                        menu.classList.remove('collapse', 'collapsing');
                                        menu.classList.add('show');
                                        toggler.classList.add('show_m_close');
                                        toggler.setAttribute('aria-expanded', 'true');
                                    }
                                }
                            }

                            // Wait a tiny bit for DOM to be ready
                            setTimeout(function() {
                                var toggler = document.querySelector('.navbar-toggler');
                                if (toggler) {
                                    // Remove Bootstrap attributes immediately
                                    toggler.removeAttribute('data-bs-toggle');
                                    toggler.removeAttribute('data-bs-target');

                                    // Destroy any Bootstrap instance
                                    if (typeof bootstrap !== 'undefined' && bootstrap.Collapse) {
                                        var menuEl = document.getElementById('navbarNav');
                                        if (menuEl) {
                                            var instance = bootstrap.Collapse.getInstance(menuEl);
                                            if (instance) instance.dispose();
                                        }
                                    }

                                    // Add click handler - use capture phase to run first
                                    toggler.addEventListener('click', function(e) {
                                        e.preventDefault();
                                        e.stopPropagation();
                                        e.stopImmediatePropagation();
                                        toggleMenu();
                                        return false;
                                    }, true);

                                    // Handle touch events
                                    toggler.addEventListener('touchend', function(e) {
                                        e.preventDefault();
                                        e.stopPropagation();
                                        toggleMenu();
                                        return false;
                                    }, true);

                                    // Handle clicks on icons inside
                                    var icons = toggler.querySelectorAll('i');
                                    icons.forEach(function(icon) {
                                        icon.addEventListener('click', function(e) {
                                            e.preventDefault();
                                            e.stopPropagation();
                                            toggler.click();
                                            return false;
                                        }, true);

                                        icon.addEventListener('touchend', function(e) {
                                            e.preventDefault();
                                            toggler.click();
                                            return false;
                                        }, true);
                                    });

                                    // Close menu on load
                                    if (window.innerWidth <= 991) {
                                        var menu = document.getElementById('navbarNav');
                                        if (menu) {
                                            menu.classList.remove('show', 'collapsing');
                                            menu.classList.add('collapse');
                                            toggler.classList.remove('show_m_close');
                                            toggler.setAttribute('aria-expanded', 'false');
                                        }
                                    }
                                }
                            }, 10);
                        })();
                    </script>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav m-auto">
                            {{-- Language Selector - After Logo, Before Home --}}
                            @if (Module::isEnabled('Language') && Route::has('set-locale') && allLanguages()?->where('status', 1)->count() > 1)
                                <li class="nav-item d-flex align-items-center">
                                    <form id="change-header-language" action="{{ route('set-locale') }}" method="get" class="language-form-nav">
                                        <select class="form-control select_js language-select-nav" name="locale">
                                            @foreach (allLanguages()->where('status', 1) as $language)
                                                <option value="{{ $language->code }}" @selected($language->code == app()->getLocale())>
                                                    {{ $language->name == 'Thailandia' ? 'Arabic' : $language->name }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </li>
                            @endif

                            @if ($nav_menu)
                                @php
                                    // Process menu to move Blog and Contact Us into Pages dropdown
                                    $processed_menu = [];
                                    $blog_menu = null;
                                    $contact_menu = null;
                                    $pages_menu = null;

                                    foreach ($nav_menu as $menu) {
                                        $label_lower = strtolower($menu['label']);
                                        if ($label_lower === 'blog' || $label_lower === 'our blog') {
                                            $blog_menu = $menu;
                                        } elseif ($label_lower === 'contact us') {
                                            $contact_menu = $menu;
                                        } elseif ($label_lower === 'pages') {
                                            $pages_menu = $menu;
                                            $processed_menu[] = $menu;
                                        } else {
                                            $processed_menu[] = $menu;
                                        }
                                    }

                                    // Add Blog and Contact Us to Pages dropdown if Pages exists
                                    if ($pages_menu && ($blog_menu || $contact_menu)) {
                                        foreach ($processed_menu as $key => $menu) {
                                            if (strtolower($menu['label']) === 'pages') {
                                                if (!isset($menu['child']) || !is_array($menu['child'])) {
                                                    $processed_menu[$key]['child'] = [];
                                                }
                                                if ($blog_menu) {
                                                    $processed_menu[$key]['child'][] = $blog_menu;
                                                }
                                                if ($contact_menu) {
                                                    $processed_menu[$key]['child'][] = $contact_menu;
                                                }
                                                break;
                                            }
                                        }
                                    }
                                @endphp
                                @foreach ($processed_menu as $menu)
                                    @if ($loop->first && (str(config('app.app_mode', 'LIVE'))->lower() == 'demo' || $setting->selected_theme == 0))
                                        <x-homepages />
                                    @else
                                        <li class="nav-item {{ $menu['child'] ? 'has-dropdown' : '' }}">
                                            <a href="{{ $menu['child'] ? 'javascript:;' : url($menu['link']) }}"
                                                {{ $menu['open_new_tab'] ? 'target="_blank" rel="noopener noreferrer"' : '' }}
                                                @class([
                                                    'nav-link',
                                                    'active' => $menu['child'] ? false : isUrlSame($menu['link']),
                                                ])>{{ $menu['label'] }}
                                                @if ($menu['child'])
                                                    <i class="ms-1 far fa-angle-down dropdown-toggle-icon"></i>
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
                            {{-- Hide Join As Provider button when user is logged in --}}
                            @guest('web')
                                <li class="d-none d-lg-block"><a href="{{ route('join-as-a-provider') }}">{{ __('Hire Now') }} <i
                                            class="far fa-angle-right"></i></a></li>
                            @endguest
                            @auth('web')
                                @php
                                    $logged_user = Auth::guard('web')->user();
                                @endphp
                                <li class="dropdown profile-dropdown-desktop">
                                    <a class="nav-link dropdown-toggle d-flex align-items-center profile-dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false" href="#" role="button" onclick="return false;" style="padding: 8px 15px; text-decoration: none; color: #333; background: transparent !important; border: none !important; box-shadow: none !important; cursor: pointer;">
                                        @if ($logged_user->image)
                                            <img class="rounded-circle" src="{{ asset($logged_user->image) }}" alt="user" style="width: 35px; height: 35px; object-fit: cover;">
                                        @else
                                            <img class="rounded-circle" src="{{ asset($setting->default_avatar) }}" alt="user" style="width: 35px; height: 35px; object-fit: cover;">
                                        @endif
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" style="min-width: 200px;">
                                        <li>
                                            <div class="px-3 py-2">
                                                <h6 class="mb-1" style="font-weight: 600; font-size: 14px;">{{ $logged_user->name }}</h6>
                                                <small class="text-muted" style="font-size: 12px;">
                                                    @if ($logged_user->is_provider == 1)
                                                        <i class="fas fa-user-tie me-1"></i>{{ __('Provider') }}
                                                    @else
                                                        <i class="fas fa-user me-1"></i>{{ __('Customer') }}
                                                    @endif
                                                </small>
                                            </div>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('dashboard') }}" style="padding: 10px 15px;">
                                                <i class="far fa-user me-2"></i>{{ __('Dashboard') }}
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item text-danger" href="{{ route('user.logout') }}" style="padding: 10px 15px;">
                                                <i class="fas fa-sign-out-alt me-2"></i>{{ __('Logout') }}
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @else
                                <li><a href="{{ route('login') }}" class="login-text-link">{{ __('Login') }}</a></li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>
            <!--=========================
            MENU END
        ==========================-->

            @yield('frontend-content')

            <!--=========================
            COUNTER START (Before Footer)
        ==========================-->
            @php
                $control = App\Models\SectionControl::get();
                $coundown_control = $control->where('id', 4)->first();
                $coundown_visibility = false;
                if ($coundown_control && $coundown_control->status == 1) {
                    $coundown_visibility = true;
                }
                $counters = collect();
                if ($coundown_control) {
                    $counters = App\Models\Counter::with('translation')->where('status', 1)->get()->take($coundown_control->qty);
                } else {
                    $counters = App\Models\Counter::with('translation')->where('status', 1)->get();
                }
            @endphp

            @if ($coundown_visibility)
                <section class="wsus__counter">
                    <div class="wsus__counter_overlay">
                        <div class="container">
                            <div class="row">
                                @foreach ($counters as $counter)
                                    <div class="col-xl-3 col-sm-6 col-lg-3">
                                        <div class="wsus__single_counter">
                                            <span>
                                                <img class="img-fluid w-100" src="{{ asset($counter->icon) }}" alt="counter">
                                            </span>
                                            <h4 class="counter">{{ $counter->number }}</h4>
                                            <p>{{ $counter->title }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            @endif
            <!--=========================
            COUNTER END
        ==========================-->

            <!--=========================
            FOOTER START
        ==========================-->

            @php
                $footer_informations = App\Models\Footer::with('translation')->first();
                $first_col_links = App\Models\FooterLink::where('column', 1)->get();
                $second_col_links = App\Models\FooterLink::where('column', 2)->get();
            @endphp
            <footer style="background: #ffffff !important; color: #000000 !important;">
                <div class="container footer-top-container">
                    <!-- Logo and Description Row -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="wsus__footer_content text-center footer-logo-section">
                                <a class="footer_logo d-inline-block" href="{{ route('home') }}">
                                    <img class="img-fluid" src="{{ asset($setting->footer_logo) }}"
                                        alt="logo">
                                </a><span class="footer-description">{{ $footer_informations->about_us }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- Four Sections Row -->
                    <div class="row footer-sections-row">
                        <div class="col-lg-2 col-md-6 footer-section-item">
                            <div class="wsus__footer_content">
                                <h2>{{ __('Customers') }}</h2>
                                <ul class="footer_link">
                                    <li><a href="{{ route('faq') }}">{{ __('How to use findupnow server') }}</a></li>
                                    <li><a href="{{ route('register') }}">{{ __('Post Job') }}</a></li>
                                    <li><a href="#">{{ __('Get the app') }}</a></li>
                                    <li><a href="{{ route('services') }}">{{ __('Services near me') }}</a></li>
                                    <li><a href="#">{{ __('Cost estimates') }}</a></li>
                                    <li><a href="#">{{ __('Home resource center') }}</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 footer-section-item">
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
                        <div class="col-lg-2 col-md-6 footer-section-item">
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
                        <div class="col-lg-2 col-md-12 footer-section-item">
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
                                <ul class="social_link d-flex flex-nowrap">
                                    @foreach ($social_icons as $social_icon)
                                        <li><a href="{{ $social_icon->link }}" target="_blank"><i
                                                     class="{{ $social_icon->icon }}"></i></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wsus__footer_bottom footer-bottom-section" style="background: #ffffff !important;">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div
                                    class="wsus__footer_bottom_content d-flex justify-content-between align-items-center">
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
                                                <img class="img-fluid w-100"
                                                    src="{{ asset($provider->provider->image) }}" alt="user">
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
                                            <h3>{{ $provider?->provider?->name }}</h3>
                                            <p>{{ $provider?->provider?->designation }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="wsus__message_box">

                            <div class="wsus__empty_message">
                                <div class="img">
                                    <img class="img-fluid w-100"
                                        src="{{ asset('uploads/website-images/empty_chat.webp') }}" alt="empty">
                                </div>
                                <h3>{{ __('No Message yet!') }}</h3>
                                <p>{{ __('Please choose one') }}</p>
                            </div>

                            <div class="wsus__message_preloader d-none">
                                <span>
                                    <img class="img-fluid w-100"
                                        src="{{ asset('uploads/website-images/preloader.gif') }}" alt="preloader">
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

        </div>

        <!--bootstrap js-->
        <script src="{{ asset('global/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Initialize Bootstrap Dropdown -->
        <script>
            (function() {
                'use strict';

                function initProfileDropdown() {
                    var profileDropdownToggle = document.querySelector('.wsus__right_menu .profile-dropdown-toggle');

                    if (!profileDropdownToggle) return;

                    if (typeof bootstrap !== 'undefined' && bootstrap.Dropdown) {
                        // Initialize Bootstrap dropdown
                        var profileDropdown = new bootstrap.Dropdown(profileDropdownToggle);

                        // Handle click events explicitly
                        profileDropdownToggle.addEventListener('click', function(e) {
                            e.preventDefault();
                            e.stopPropagation();

                            if (profileDropdown) {
                                profileDropdown.toggle();
                            }
                            return false;
                        }, true); // Use capture phase to run before other handlers

                        // Handle touch events for mobile
                        profileDropdownToggle.addEventListener('touchend', function(e) {
                            e.preventDefault();
                            e.stopPropagation();

                            if (profileDropdown) {
                                profileDropdown.toggle();
                            }
                            return false;
                        }, true);
                    }
                }

                // Initialize when DOM is ready
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', initProfileDropdown);
                } else {
                    initProfileDropdown();
                }

                // Initialize mobile profile dropdown
                function initMobileProfileDropdown() {
                    var mobileProfileToggle = document.querySelector('.profile-dropdown-toggle-mobile');

                    if (!mobileProfileToggle) return;

                    // Wait for Bootstrap to be available
                    if (typeof bootstrap !== 'undefined' && bootstrap.Dropdown) {
                        try {
                            var mobileProfileDropdown = new bootstrap.Dropdown(mobileProfileToggle, {
                                boundary: 'viewport',
                                popperConfig: null
                            });

                            // Remove existing event listeners to avoid duplicates
                            var newToggle = mobileProfileToggle.cloneNode(true);
                            mobileProfileToggle.parentNode.replaceChild(newToggle, mobileProfileToggle);
                            mobileProfileToggle = newToggle;

                            mobileProfileToggle.addEventListener('click', function(e) {
                                e.preventDefault();
                                e.stopPropagation();
                                try {
                                    if (mobileProfileDropdown) {
                                        mobileProfileDropdown.toggle();
                                    }
                                } catch (err) {
                                    // Fallback to jQuery if Bootstrap fails
                                    var $this = $(this);
                                    var $dropdown = $this.closest('.dropdown').find('.dropdown-menu');
                                    $dropdown.toggleClass('show');
                                    $this.attr('aria-expanded', $dropdown.hasClass('show'));
                                }
                                return false;
                            }, true);

                            mobileProfileToggle.addEventListener('touchend', function(e) {
                                e.preventDefault();
                                e.stopPropagation();
                                try {
                                    if (mobileProfileDropdown) {
                                        mobileProfileDropdown.toggle();
                                    }
                                } catch (err) {
                                    // Fallback to jQuery if Bootstrap fails
                                    var $this = $(this);
                                    var $dropdown = $this.closest('.dropdown').find('.dropdown-menu');
                                    $dropdown.toggleClass('show');
                                    $this.attr('aria-expanded', $dropdown.hasClass('show'));
                                }
                                return false;
                            }, true);
                        } catch (err) {
                            console.error('Bootstrap dropdown initialization error:', err);
                            // Will fallback to jQuery handler below
                        }
                    }
                }

                // Try again after a short delay if Bootstrap loads late
                setTimeout(initMobileProfileDropdown, 500);

                // Initialize mobile dropdown when DOM is ready
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', initMobileProfileDropdown);
                } else {
                    initMobileProfileDropdown();
                }

                // Also initialize with jQuery (fallback)
                if (typeof jQuery !== 'undefined') {
                    jQuery(document).ready(function($) {
                        // Desktop profile dropdown
                        $('.wsus__right_menu .profile-dropdown-toggle').off('click').on('click', function(e) {
                            e.preventDefault();
                            e.stopPropagation();

                            var $dropdown = $(this).siblings('.dropdown-menu').first();
                            if ($dropdown.length === 0) {
                                $dropdown = $(this).closest('.dropdown').find('.dropdown-menu').first();
                            }
                            var isVisible = $dropdown.hasClass('show');

                            // Close all other dropdowns
                            $('.dropdown-menu.show').removeClass('show');

                            if (!isVisible) {
                                $dropdown.addClass('show');
                                $(this).attr('aria-expanded', 'true');
                            } else {
                                $dropdown.removeClass('show');
                                $(this).attr('aria-expanded', 'false');
                            }

                            return false;
                        });

                        // Mobile profile dropdown
                        $('.profile-dropdown-toggle-mobile').off('click').on('click', function(e) {
                            e.preventDefault();
                            e.stopPropagation();

                            var $dropdown = $(this).closest('.dropdown').find('.dropdown-menu').first();
                            var isVisible = $dropdown.hasClass('show');

                            // Close all other dropdowns
                            $('.dropdown-menu.show').removeClass('show');

                            if (!isVisible) {
                                $dropdown.addClass('show');
                                $(this).attr('aria-expanded', 'true');
                            } else {
                                $dropdown.removeClass('show');
                                $(this).attr('aria-expanded', 'false');
                            }

                            return false;
                        });

                        // Close dropdown when clicking outside
                        $(document).on('click', function(e) {
                            if (!$(e.target).closest('.dropdown').length) {
                                $('.dropdown-menu.show').removeClass('show');
                                $('.profile-dropdown-toggle, .profile-dropdown-toggle-mobile').attr('aria-expanded', 'false');
                            }
                        });
                    });
                }
            })();
        </script>

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
        <!-- nice select js -->
        <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
        <!--main/custom js-->
        <script src="{{ asset('frontend/js/main.js') }}?v={{ time() }}"></script>

        <script src="{{ asset('toastr/toastr.min.js') }}"></script>

        <script src="{{ asset('js/app.js') }}"></script>

        <script>
            @if (Session::has('message'))
                "use strict";

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
