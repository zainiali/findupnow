@extends('website.layout')

@section('title')
    <title>{{ $seo_setting->seo_title }}</title>
@endsection

@section('title')
    <meta name="description" content="{{ $seo_setting->seo_description }}">
    <style>
        .contact-blue-input {
            height: 50px !important;
            padding: 12px 15px !important;
            background-color: #f0f7ff !important;
            border: 1px solid #c2e0ff !important;
            border-radius: 8px !important;
            width: 100%;
        }

        .contact-blue-input:focus {
            border-color: #378fff !important;
            background-color: #ffffff !important;
            outline: none;
        }
    </style>
@endsection
@section('frontend-content')

    @if ($intro_visibility)
        <!--========================= BANNER START (Angi Style) ==========================-->
        <section class="angi_banner_section">
            <!-- Background Image Slider -->
            <div class="angi_banner_slider">
                <div class="angi_slide angi_slide_active" style="background-image: url({{ asset('frontend/images/banner_slide_1.jpeg') }});"></div>
                <div class="angi_slide" style="background-image: url({{ asset('frontend/images/banner_slide_2.jpeg') }});"></div>
                <div class="angi_slide" style="background-image: url({{ asset('frontend/images/banner_slide_3.jpeg') }});"></div>
            </div>
            
            <!-- Dark Transparent Overlay -->
            <div class="angi_banner_overlay"></div>
            
            <!-- Content Container -->
            <div class="angi_banner_content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-xl-8 mx-auto">
                            <!-- Black Container Box (Angi Style) -->
                            <div class="angi_content_box">
                                <!-- Slogan -->
                                <div class="angi_banner_slogan">
                                    <h1>{{ $intro_section->header_one }} <b>{{ $intro_section->header_two }}</b></h1>
                                    <p>{{ $intro_section->description }}</p>
                                </div>
                                
                                <!-- Search Bar -->
                                <form class="angi_search_form">
                                <div class="angi_search_bar">
                                    <!-- Search Input -->
                                    <div class="angi_search_category">
                                        <input type="text" id="angi_category_input" name="search" placeholder="What can we help you with?" autocomplete="off">
                                    </div>
                                    
                                    <!-- Zip Code Input -->
                                    <div class="angi_search_location">
                                        <button type="button" class="angi_location_icon_btn" id="angi_location_icon_btn" style="background: none; border: none; padding: 0; cursor: pointer;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                <circle cx="12" cy="10" r="3"></circle>
                                            </svg>
                                        </button>
                                        <input type="text" name="zip_code" id="angi_zip_code" placeholder="Zip Code" maxlength="10">
                                    </div>
                                    
                                    <!-- Search Button -->
                                    <button type="submit" class="angi_search_btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <path d="m21 21-4.35-4.35"></path>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                            </div>
                            <!-- End Black Container Box -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--========================= BANNER END ==========================-->
        
        <!-- Angi Banner Styles -->
        <style>
            /* Angi Style Banner */
            .angi_banner_section {
                position: relative;
                width: 100%;
                min-height: 550px;
                overflow: visible;
            }
            
            /* Background Slider */
            .angi_banner_slider {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 550px;
                z-index: 1;
                overflow: hidden;
            }
            
            .angi_slide {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-size: cover;
                background-position: center center;
                background-repeat: no-repeat;
                opacity: 0;
                transition: opacity 1.5s ease-in-out;
                -webkit-backface-visibility: hidden;
                backface-visibility: hidden;
                transform: translateZ(0);
                will-change: opacity;
            }
            
            .angi_slide.angi_slide_active {
                opacity: 1;
            }
            
            /* Dark Transparent Overlay */
            .angi_banner_overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 550px;
                background: rgba(0, 0, 0, 0.3);
                z-index: 2;
            }
            
            /* Content Container */
            .angi_banner_content {
                position: relative;
                z-index: 3;
                min-height: 550px;
                display: flex;
                align-items: center;
                padding: 80px 0 60px;
                overflow: visible;
            }
            
            .angi_banner_content .container {
                overflow: visible;
            }
            
            .angi_banner_content .row {
                overflow: visible;
            }
            
            .angi_banner_content .col-lg-10 {
                overflow: visible;
            }
            
            /* Black Container Box (Angi Style) */
            .angi_content_box {
                background: rgba(0, 0, 0, 0.45);
                border-radius: 20px;
                padding: 50px 40px;
                width: 100%;
                position: relative;
                z-index: 10;
                overflow: visible;
            }
            
            /* Slogan */
            .angi_banner_slogan {
                text-align: center;
                margin-bottom: 40px;
            }
            
            .angi_banner_slogan h1 {
                color: #ffffff;
                font-size: 48px;
                font-weight: 700;
                line-height: 1.2;
                margin-bottom: 15px;
            }
            
            .angi_banner_slogan h1 b {
                font-weight: 700;
            }
            
            .angi_banner_slogan p {
                color: #ffffff;
                font-size: 18px;
                opacity: 0.9;
                margin: 0;
            }
            
            /* Search Form */
            .angi_search_form {
                width: 100%;
                position: relative;
                overflow: visible;
            }
            
            .angi_search_bar {
                display: flex;
                background: #ffffff;
                border-radius: 50px;
                padding: 8px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
                align-items: center;
                gap: 0;
                position: relative;
                overflow: visible;
            }
            
            /* Category Input */
            .angi_search_category {
                flex: 1;
                position: relative;
                border-right: 1px solid #e0e0e0;
                padding-right: 20px;
                margin-right: 15px;
            }
            
            .angi_search_category #angi_category_input {
                width: 100%;
                border: none;
                padding: 16px 20px;
                font-size: 16px;
                background: transparent;
                color: #333;
                cursor: pointer;
                outline: none;
            }
            
            .angi_search_category #angi_category_input::placeholder {
                color: #999;
            }
            
            .angi_category_dropdown {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: #ffffff;
                border-radius: 12px;
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
                margin-top: 0;
                max-height: calc(5 * 48px);
                overflow-y: auto;
                display: none;
                z-index: 9999;
            }
            
            .angi_category_dropdown.show {
                display: block;
            }
            
            .angi_category_dropdown ul {
                list-style: none;
                padding: 8px 0;
                margin: 0;
            }
            
            .angi_category_dropdown ul li {
                padding: 12px 20px;
                cursor: pointer;
                color: #333;
                font-size: 15px;
                transition: background 0.2s;
                display: flex;
                align-items: center;
                gap: 12px;
                min-height: 48px;
            }
            
            .angi_category_dropdown ul li svg {
                color: #666;
                flex-shrink: 0;
                width: 16px;
                height: 16px;
            }
            
            .angi_category_dropdown ul li span {
                flex: 1;
            }
            
            .angi_category_dropdown ul li:hover {
                background: #f5f5f5;
            }
            
            .angi_category_dropdown ul li:hover svg {
                color: #378FFF;
            }
            
            /* Location Input */
            .angi_search_location {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 0 15px;
                border-right: 1px solid #e0e0e0;
                margin-right: 15px;
                min-width: 180px;
            }
            
            .angi_search_location .angi_location_icon_btn {
                flex-shrink: 0;
                display: flex;
                align-items: center;
            }
            
            .angi_search_location .angi_location_icon_btn svg {
                color: #666;
                transition: color 0.2s;
            }
            
            .angi_search_location .angi_location_icon_btn:hover svg {
                color: #378FFF;
            }
            
            .angi_search_location #angi_zip_code {
                border: none;
                padding: 16px 0;
                font-size: 16px;
                background: transparent;
                color: #333;
                outline: none;
                width: 100%;
            }
            
            .angi_search_location #angi_zip_code::placeholder {
                color: #999;
            }
            
            /* Search Button */
            .angi_search_btn {
                width: 56px;
                height: 56px;
                border-radius: 50%;
                background: #378FFF;
                border: none;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: background 0.3s, transform 0.2s;
                flex-shrink: 0;
                padding: 0;
            }
            
            .angi_search_btn:hover {
                background: #2563eb;
                transform: scale(1.05);
            }
            
            .angi_search_btn svg {
                color: #ffffff;
            }
            
            /* Responsive */
            @media (max-width: 991px) {
                .angi_banner_section {
                    height: 500px;
                }
                
                .angi_content_box {
                    padding: 35px 25px;
                }
                
                .angi_banner_slogan h1 {
                    font-size: 36px;
                }
                
                .angi_banner_slogan p {
                    font-size: 16px;
                }
                
                .angi_search_bar {
                    flex-direction: row;
                    border-radius: 50px;
                    padding: 6px;
                    gap: 0;
                    display: flex;
                    align-items: center;
                }
                
                .angi_search_category {
                    flex: 1;
                    border-right: none;
                    border-bottom: none;
                    padding: 8px 12px;
                    margin: 0;
                    order: 1;
                }
                
                .angi_search_category #angi_category_input {
                    padding: 8px 10px;
                    font-size: 15px;
                }

                .angi_search_btn {
                    display: flex !important;
                    width: 32px;
                    height: 32px;
                    order: 2;
                    margin: 0 10px;
                    padding: 0;
                }

                .angi_search_btn svg {
                    width: 14px;
                    height: 14px;
                }
                
                .angi_search_location {
                    flex: 0 0 auto;
                    border-left: 1px solid #e0e0e0;
                    border-right: none;
                    border-bottom: none;
                    padding: 0 8px 0 10px;
                    margin: 0;
                    min-width: 70px;
                    max-width: 90px;
                    order: 3;
                }
                
                .angi_search_location #angi_zip_code {
                    padding: 12px 0;
                    font-size: 12px;
                }
                
                .angi_search_location .angi_location_icon_btn svg {
                    width: 12px;
                    height: 12px;
                }
                
                .angi_category_dropdown {
                    position: absolute !important;
                    left: 0 !important;
                    right: 0 !important;
                    max-width: 100% !important;
                    z-index: 99999 !important;
                    top: 100% !important;
                }
            }
            
            @media (max-width: 575px) {
                .angi_banner_section {
                    height: 450px;
                }
                
                .angi_banner_content {
                    padding: 60px 0 40px;
                }
                
                .angi_content_box {
                    padding: 30px 20px;
                }
                
                .angi_banner_slogan h1 {
                    font-size: 28px;
                }
                
                .angi_banner_slogan {
                    margin-bottom: 30px;
                }
                
                .angi_search_bar {
                    padding: 5px;
                }
                
                .angi_search_category {
                    border-right: none;
                    padding: 8px 10px;
                    margin: 0;
                    order: 1;
                }
                
                .angi_search_category #angi_category_input {
                    padding: 8px 10px;
                    font-size: 14px;
                }

                .angi_search_btn {
                    display: flex !important;
                    width: 30px;
                    height: 30px;
                    order: 2;
                    margin: 0 8px;
                }

                .angi_search_btn svg {
                    width: 12px;
                    height: 12px;
                }
                
                .angi_search_location {
                    border-left: 1px solid #e0e0e0;
                    padding: 0 5px 0 8px;
                    min-width: 65px;
                    max-width: 85px;
                    order: 3;
                }
                
                .angi_search_location #angi_zip_code {
                    padding: 10px 0;
                    font-size: 11px;
                }
                
                .angi_search_location .angi_location_icon_btn svg {
                    width: 11px;
                    height: 11px;
                }
                
                .angi_category_dropdown {
                    left: 0 !important;
                    right: 0 !important;
                    max-width: 100% !important;
                }
            }
        </style>
        
        <!-- Angi Banner JavaScript -->
        <script>
            (function($) {
                "use strict";
                
                $(document).ready(function() {
                    // Mobile placeholder change
                    function updateMobilePlaceholder() {
                        if (window.innerWidth <= 991) {
                            $('#angi_category_input').attr('placeholder', 'Search');
                        } else {
                            $('#angi_category_input').attr('placeholder', 'What can we help you with?');
                        }
                    }
                    
                    updateMobilePlaceholder();
                    $(window).on('resize', updateMobilePlaceholder);
                    
                    // Background Image Slider
                    let currentSlide = 0;
                    const slides = $('.angi_slide');
                    const totalSlides = slides.length;
                    
                    function nextSlide() {
                        slides.eq(currentSlide).removeClass('angi_slide_active');
                        currentSlide = (currentSlide + 1) % totalSlides;
                        slides.eq(currentSlide).addClass('angi_slide_active');
                    }
                    
                    // Auto slide every 3 seconds
                    setInterval(nextSlide, 3000);

                    // Form Submission Logic - Always redirect to booking page
                    $('.angi_search_form').on('submit', function(e) {
                        e.preventDefault();
                        const searchText = $('#angi_category_input').val().trim();
                        const zip = $('#angi_zip_code').val().trim();
                        
                        console.log('Search Text:', searchText);
                        console.log('Zip Code:', zip);
                        
                        // Always redirect to ready-to-booking with search text and/or zip code
                        if (searchText || zip) {
                            let url = "{{ url('ready-to-booking/custom-request') }}";
                            let params = [];
                            
                            if (searchText) {
                                params.push('query=' + encodeURIComponent(searchText));
                            }
                            if (zip) {
                                params.push('zip=' + encodeURIComponent(zip));
                            }
                            
                            if (params.length > 0) {
                                url += '?' + params.join('&');
                            }
                            
                            console.log('Final URL:', url);
                            console.log('Redirecting to:', url);
                            window.location.href = url;
                        } else {
                            // Show error if both fields are empty
                            alert('Please enter a service or zip code');
                        }
                    });
                    
                    // Location Icon Click - Geolocation
                    $('#angi_location_icon_btn').on('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        if (!navigator.geolocation) {
                            if (typeof toastr !== 'undefined') {
                                toastr.error('Geolocation is not supported by your browser');
                            } else {
                                alert('Geolocation is not supported by your browser');
                            }
                            return;
                        }
                        
                        const zipCodeInput = $('#angi_zip_code');
                        zipCodeInput.val('Detecting...');
                        $(this).attr('disabled', true);
                        
                        navigator.geolocation.getCurrentPosition(
                            function(position) {
                                const lat = position.coords.latitude;
                                const lon = position.coords.longitude;
                                
                                $.ajax({
                                    url: "https://nominatim.openstreetmap.org/reverse",
                                    method: "GET",
                                    data: {
                                        format: "json",
                                        lat: lat,
                                        lon: lon,
                                        addressdetails: 1
                                    },
                                    success: function(data) {
                                        if (data && data.address && data.address.postcode) {
                                            zipCodeInput.val(data.address.postcode);
                                        } else {
                                            zipCodeInput.val('');
                                            if (typeof toastr !== 'undefined') {
                                                toastr.error('Could not detect postal code for your location');
                                            } else {
                                                alert('Could not detect postal code for your location');
                                            }
                                        }
                                        $('#angi_location_icon_btn').attr('disabled', false);
                                    },
                                    error: function() {
                                        zipCodeInput.val('');
                                        if (typeof toastr !== 'undefined') {
                                            toastr.error('Failed to detect location');
                                        } else {
                                            alert('Failed to detect location');
                                        }
                                        $('#angi_location_icon_btn').attr('disabled', false);
                                    }
                                });
                            },
                            function(error) {
                                zipCodeInput.val('');
                                if (typeof toastr !== 'undefined') {
                                    toastr.error('Location access denied. Please enter ZIP / Postal code manually.');
                                } else {
                                    alert('Location access denied. Please enter ZIP / Postal code manually.');
                                }
                                $('#angi_location_icon_btn').attr('disabled', false);
                            }
                        );
                    });
                });
                
            })(jQuery);
        </script>
    @endif

    @if ($category_section->visibility)
        <!--========================= CATEGORIES START ==========================-->
        <section class="wsus__categories mt_90 xs_mt_60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 m-auto">
                        <div class="wsus__section_heading text-center mb_45">
                            <h2>{{ $category_section->title }}</h2>
                            <p>{{ $category_section->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row category_grid">
                    @foreach ($categories as $category)
                        @php
                            $hasServices = $category->service_count > 0;
                            $redirectUrl = $hasServices 
                                ? route('services', ['category' => $category->slug]) 
                                : url('ready-to-booking/custom-request') . '?query=' . urlencode($category->name) . '&category=' . $category->slug;
                        @endphp
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-3">
                            <a href="{{ $redirectUrl }}" class="category_box">
                                <div class="category_box_content">
                                    <div class="category_icon">
                                        <img class="img-fluid" src="{{ asset($category->icon) }}" alt="{{ $category->name }}">
                                    </div>
                                    <span class="category_name">{{ $category->name }}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        
        <style>
            .category_grid {
                display: flex;
                flex-wrap: wrap;
                margin: 0 -8px;
            }
            
            .category_grid .col-lg-4,
            .category_grid .col-md-4,
            .category_grid .col-sm-6 {
                padding: 0 8px;
            }
            
            .category_box {
                display: block;
                background: #ffffff;
                border-radius: 8px;
                padding: 12px 14px;
                text-decoration: none;
                box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
                transition: all 0.3s ease;
                height: 100%;
                border: 1px solid #f0f0f0;
            }
            
            .category_box:hover {
                transform: translateY(-2px);
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                text-decoration: none;
            }
            
            .category_box_content {
                display: flex;
                align-items: center;
                gap: 10px;
            }
            
            .category_icon {
                width: 35px;
                height: 35px;
                flex-shrink: 0;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            .category_icon img {
                width: 100%;
                height: 100%;
                object-fit: contain;
            }
            
            .category_name {
                flex: 1;
                color: #2d3748;
                font-size: 14px;
                font-weight: 600;
                line-height: 1.3;
                text-align: left;
            }
            
            /* Responsive adjustments */
            @media (max-width: 768px) {
                .category_grid {
                    margin: 0 -6px;
                }
                
                .category_grid .col-lg-4,
                .category_grid .col-md-4,
                .category_grid .col-sm-6 {
                    padding: 0 6px;
                }
                
                .category_box {
                    padding: 10px 12px;
                }
                
                .category_icon {
                    width: 30px;
                    height: 30px;
                }
                
                .category_name {
                    font-size: 13px;
                }
            }
            
            @media (max-width: 576px) {
                .category_box_content {
                    gap: 8px;
                }
                
                .category_icon {
                    width: 28px;
                    height: 28px;
                }
                
                .category_name {
                    font-size: 12px;
                }
                
                .category_box {
                    padding: 8px 10px;
                }
            }
        </style>
        <!--========================= CATEGORIES END ==========================-->
    @endif

    @if ($featured_service_section->visibility)
        <!--========================= FEATURED SERVICES START ==========================-->
        <section class="wsus__features_services mt_90 xs_mt_60 mb_60 xs_mb_30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 m-auto">
                        <div class="wsus__section_heading text-center mb_45">
                            <h2>{{ $featured_service_section->title }}</h2>
                            <p>{{ $featured_service_section->description }}</p>
                        </div>
                    </div>
                </div>
                <div class="row featured_service_slider">

                    @foreach ($featured_services as $featured_service)
                        <div class="col-xl-4">
                            <div class="wsus__single_services">
                                <div class="wsus__services_img">
                                    <img class="img-fluid w-100" src="{{ asset($featured_service->image) }}"
                                        alt="service">
                                </div>
                                <div class="wsus__services_text">
                                    <ul class="d-flex justify-content-between">
                                        <li><a
                                                href="{{ route('services', ['category' => $featured_service->category->slug]) }}">{{ $featured_service->category->name }}</a>
                                        </li>
                                        <li>
                                            {{ currency($featured_service->price) }}
                                        </li>
                                    </ul>
                                    <a class="title"
                                        href="{{ route('service', $featured_service->slug) }}">{{ $featured_service->name }}</a>
                                    <div
                                        class="single_service_footer d-flex flex-wrap justify-content-between align-items-center">
                                        <div class="img_area">
                                            <img class="img-fluid"
                                                src="{{ $featured_service->provider ? asset($featured_service->provider->image) : '' }}"
                                                alt="user">
                                            <span>{{ $featured_service->provider->name ?? '' }}
                                                @php
                                                    $kyc = Modules\Kyc\Entities\KycInformation::where(
                                                        'user_id',
                                                        $featured_service->provider->id,
                                                    )
                                                        ->where('status', 1)
                                                        ->first();
                                                @endphp
                                                @if ($kyc)
                                                    <svg class="kyc-icon" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24" fill="currentColor">
                                                        <path
                                                            d="M10.007 2.10377C8.60544 1.65006 7.08181 2.28116 6.41156 3.59306L5.60578 5.17023C5.51004 5.35763 5.35763 5.51004 5.17023 5.60578L3.59306 6.41156C2.28116 7.08181 1.65006 8.60544 2.10377 10.007L2.64923 11.692C2.71404 11.8922 2.71404 12.1078 2.64923 12.308L2.10377 13.993C1.65006 15.3946 2.28116 16.9182 3.59306 17.5885L5.17023 18.3942C5.35763 18.49 5.51004 18.6424 5.60578 18.8298L6.41156 20.407C7.08181 21.7189 8.60544 22.35 10.007 21.8963L11.692 21.3508C11.8922 21.286 12.1078 21.286 12.308 21.3508L13.993 21.8963C15.3946 22.35 16.9182 21.7189 17.5885 20.407L18.3942 18.8298C18.49 18.6424 18.6424 18.49 18.8298 18.3942L20.407 17.5885C21.7189 16.9182 22.35 15.3946 21.8963 13.993L21.3508 12.308C21.286 12.1078 21.286 11.8922 21.3508 11.692L21.8963 10.007C22.35 8.60544 21.7189 7.08181 20.407 6.41156L18.8298 5.60578C18.6424 5.51004 18.49 5.35763 18.3942 5.17023L17.5885 3.59306C16.9182 2.28116 15.3946 1.65006 13.993 2.10377L12.308 2.64923C12.1078 2.71403 11.8922 2.71404 11.692 2.64923L10.007 2.10377ZM6.75977 11.7573L8.17399 10.343L11.0024 13.1715L16.6593 7.51465L18.0735 8.92886L11.0024 15.9999L6.75977 11.7573Z">
                                                        </path>
                                                    </svg>
                                                @endif
                                            </span>
                                        </div>

                                        @php
                                            $reviewQty = $featured_service->totalReview;
                                            $totalReview = $featured_service->averageRating;
                                            if ($reviewQty > 0) {
                                                $average = $totalReview;
                                                $intAverage = intval($average);
                                                $nextValue = $intAverage + 1;
                                                $reviewPoint = $intAverage;
                                                $halfReview = false;
                                                if ($intAverage < $average && $average < $nextValue) {
                                                    $reviewPoint = $intAverage + 0.5;
                                                    $halfReview = true;
                                                }
                                            }
                                        @endphp

                                        @if ($reviewQty > 0)
                                            <p>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $reviewPoint)
                                                        <i class="fas fa-star"></i>
                                                    @elseif ($i > $reviewPoint)
                                                        @if ($halfReview == true)
                                                            <i class="fas fa-star-half-alt"></i>
                                                            @php
                                                                $halfReview = false;
                                                            @endphp
                                                        @else
                                                            <i class="far fa-star"></i>
                                                        @endif
                                                    @endif
                                                @endfor
                                                <span>({{ $featured_service->totalReview }})</span>
                                            </p>
                                        @else
                                            <p>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <span>({{ $featured_service->totalReview }})</span>
                                            </p>
                                        @endif
                                    </div>
                                    <a class="common_btn"
                                        href="{{ route('ready-to-booking', $featured_service->slug) }}">{{ __('Book now') }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!--========================= FEATURED SERVICES END ==========================-->
    @endif

    @if ($popular_service_section->visibility)
        <!--========================= POPULAR CATEGORIES START ==========================-->
        <section class="wsus__popular_categories pt_90 xs_pt_60 pb_100 xs_pb_70">
            <div class="container">
                <div class="mb-3">
                    <h2 class="border-bottom pb-3 mb-0" id="headingPopularCategories">
                            <button class="accordion-button collapsed fw-bold fs-3 bg-transparent shadow-none text-dark ps-0 w-100 border-0 d-flex justify-content-between align-items-center" type="button" 
                                data-bs-toggle="collapse" data-bs-target="#collapsePopularCategories" 
                                aria-expanded="false" aria-controls="collapsePopularCategories">
                                Popular Categories
                                <i class="fas fa-chevron-down" style="transition: transform 0.3s;"></i>
                            </button>
                            <style>
                                #headingPopularCategories button:not(.collapsed) .fa-chevron-down {
                                    transform: rotate(180deg);
                                }
                                /* Hide default bootstrap accordion icon if it appears */
                                #headingPopularCategories .accordion-button::after {
                                    display: none !important;
                                }
                                /* Ensure proper list layout */
                                #collapsePopularCategories .row {
                                    margin: 0;
                                }
                                #collapsePopularCategories .row > div {
                                    padding-left: 0;
                                    padding-right: 15px;
                                }
                                #collapsePopularCategories a {
                                    display: block;
                                    padding: 8px 0;
                                    line-height: 1.5;
                                }
                                #collapsePopularCategories a:hover {
                                    color: #084a63 !important;
                                    text-decoration: underline !important;
                                }
                            </style>
                    </h2>
                    <div id="collapsePopularCategories" class="collapse" aria-labelledby="headingPopularCategories">
                        <div class="pt-3">
                            <div class="row">
                                @foreach ($categories as $category)
                                    @php
                                        $hasServices = $category->service_count > 0;
                                        $redirectUrl = $hasServices 
                                            ? route('services', ['category' => $category->slug]) 
                                            : url('ready-to-booking/custom-request') . '?query=' . urlencode($category->name) . '&category=' . $category->slug;
                                    @endphp
                                    <div class="col-lg-4 col-md-4 col-sm-6 mb-2">
                                        <a href="{{ $redirectUrl }}" 
                                           class="category-link quote-request-trigger" 
                                           data-category="{{ $category->name }}"
                                           data-category-slug="{{ $category->slug }}"
                                           style="color: #0b6285; font-size: 15px; font-weight: 600;">
                                            {{ $category->name }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--========================= POPULAR CATEGORIES END ==========================-->
    @endif

    {{-- @if ($mobile_app_section_visbility)
        <!--=========================
                                                                            APP DOWNLOAD START
                                                                        ==========================-->
        <section class="wsus__app_download mt_100 xs_mt_70">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-5 col-md-7">
                        <div class="wsus__app_download_text">
                            <h5>{{ $mobile_app->short_title }}</h5>
                            <h2>{{ $mobile_app->full_title }}</h2>      
                            <p>{{ $mobile_app->description }}</p>
                            <ul class="d-flex flex-wrap">
                                <li>
                                    <a href="{{ $mobile_app->play_store }}">
                                        <i class="fab fa-google-play"></i>
                                        <span>{{ __('Available on the') }} <b>{{ __('Google Play') }}</b></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ $mobile_app->app_store }}">
                                        <i class="fab fa-apple"></i>
                                        <span>{{ __('Download on the') }} <b>{{ __('App Store') }}</b></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-5">
                        <div class="wsus__app_download_img">
                            <img class="img-fluid w-100" src="{{ asset($mobile_app->image) }}" alt="app download">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=========================
                                                                            APP DOWNLOAD END
                                                                        ==========================-->
    @endif --}}



    @if ($blog_section->visibility)
        <!--=========================
                                                                            BLOG START
                                                                        ==========================-->
        <section class="wsus__blog mt_85 xs_mt_55">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 m-auto">
                        <div class="wsus__section_heading text-center mb_20">
                            <h2>{{ $blog_section->title }}</h2>
                            <p>{{ $blog_section->description }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Latest News Introduction Section -->
                <div class="row mb_50 xs_mb_30">
                    <div class="col-lg-10 col-xl-8 m-auto">
                        <div class="wsus__latest_news_intro">
                            <ul class="news_points_list" style="list-style: none; padding: 0; margin: 0;">
                                <li class="news_point_item" style="display: flex; align-items: flex-start; margin-bottom: 20px;">
                                    <div class="news_icon" style="margin-right: 15px; margin-top: 5px; flex-shrink: 0;">
                                        <i class="far fa-newspaper" style="font-size: 24px; color: #007bff;"></i>
                                    </div>
                                    <p style="font-size: 18px; line-height: 1.8; color: #333; margin: 0;">
                                        In this section, we share the latest developments, industry insights, and relevant news to keep you informed about what's happening now.
                                    </p>
                                </li>
                                <li class="news_point_item" style="display: flex; align-items: flex-start; margin-bottom: 20px;">
                                    <div class="news_icon" style="margin-right: 15px; margin-top: 5px; flex-shrink: 0;">
                                        <i class="far fa-newspaper" style="font-size: 24px; color: #007bff;"></i>
                                    </div>
                                    <p style="font-size: 18px; line-height: 1.8; color: #333; margin: 0;">
                                        Our goal is to provide clear, reliable, and timely content, helping you stay connected with trends, opportunities, and key events. We regularly update this space with fresh information, so be sure to check back often.
                                    </p>
                                </li>
                                <li class="news_point_item" style="display: flex; align-items: flex-start;">
                                    <div class="news_icon" style="margin-right: 15px; margin-top: 5px; flex-shrink: 0;">
                                        <i class="far fa-newspaper" style="font-size: 24px; color: #007bff;"></i>
                                    </div>
                                    <p style="font-size: 18px; line-height: 1.8; color: #333; margin: 0;">
                                        Thank you for following our latest news.
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Latest News Introduction Section End -->
                
                <div class="row">

                    @foreach ($blogs as $blog)
                        <div class="col-lg-4 col-md-6">
                            <div class="wsus__single_blog">
                                <div class="wsus__single_blog_img">
                                    <img class="img-fluid w-100" src="{{ asset($blog->image) }}" alt="blog">
                                </div>
                                <div class="wsus__single_blog_text">
                                    <ul class="d-flex flex-wrap">
                                        <li><i class="far fa-user"></i> {{ __('By Admin') }}</li>
                                        <li><i class="far fa-comment-alt-lines"></i>
                                            {{ $blog->total_comment }}{{ __(' Comments') }}</li>
                                    </ul>
                                    <h2><a href="{{ route('blog', $blog->slug) }}">{{ $blog->title }}</a></h2>
                                    <a href="{{ route('blog', $blog->slug) }}">{{ __('Learn More') }} <i
                                            class="far fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!--=========================
                                                                            BLOG END
                                                                        ==========================-->
    @endif

    @if ($home_improvement_visibility)
        <!--========================= HOME IMPROVEMENT START ==========================-->
        <section class="wsus__home_improvement mt_50 xs_mt_30 pt_90 xs_pt_60 pb_50 xs_pb_0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="wsus__section_heading mb_45" style="text-align: left;">
                            <h2 style="text-align: left;"><strong>Home Improvement</strong></h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="wsus__home_improvement_header mb_45">
                            <h2 style="text-align: left; font-size: 28px; font-weight: bold; margin-bottom: 20px;">Planning major home improvements? Get free quotes from trusted independent pros.</h2>
                            <ul class="wsus__home_improvement_features">
                                <li>
                                    <svg class="checkmark_icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    <span>1,100+ types of projects</span>
                                </li>
                                <li>
                                    <svg class="checkmark_icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    <span>See licensing info, reviews, and more</span>
                                </li>
                                <li>
                                    <svg class="checkmark_icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    <span>Main pros per project.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">

                    @foreach ($categories->take(12) as $category)
                        @php
                            $hasServices = $category->service_count > 0;
                            $redirectUrl = $hasServices 
                                ? route('services', ['category' => $category->slug]) 
                                : url('ready-to-booking/custom-request') . '?query=' . urlencode($category->name) . '&category=' . $category->slug;
                        @endphp
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6 mb_20">
                            <a href="{{ $redirectUrl }}" 
                               class="wsus__home_improvement_box_link quote-request-trigger" 
                               data-category="{{ $category->name }}"
                               data-category-slug="{{ $category->slug }}">
                                <div class="wsus__home_improvement_box">
                                    <div class="box_icon">
                                        <img src="{{ asset($category->icon) }}" alt="{{ $category->name }}" style="width: 40px; height: 40px; object-fit: contain;">
                                    </div>
                                    <span class="box_text">{{ $category->name }}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!--========================= HOME IMPROVEMENT END ==========================-->
    @endif

    @if ($promotional_section_visibility ?? true)
        <!--========================= PROMOTIONAL SECTION START ==========================-->
        <section class="wsus__promotional_section mt_50 xs_mt_0 pt_90 xs_pt_30 pb_15 xs_pb_0">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 order-2 order-lg-1">
                        <div class="wsus__promotional_content">
                            <!-- Promotional Title -->
                            <h2 class="wsus__promotional_title mb_30">
                                Upgrade your home without the stress.
                            </h2>
                            
                            <!-- Two lines of small text with icons -->
                            <div class="wsus__promotional_text mb_30">
                                <div class="promo_text_line_item">
                                    <svg class="promo_line_icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    <p class="promo_text_line">We provide smart solutions, expert craftsmanship, and results you can trust.</p>
                                </div>
                                <div class="promo_text_line_item">
                                    <svg class="promo_line_icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    <p class="promo_text_line">Transform your space with confidence and professional quality service.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 order-1 order-lg-2">
                        <div class="wsus__promotional_image">
                            <div class="promo_image_wrapper">
                                <div class="promo_blue_circle"></div>
                                <div class="promo_image_collage">
                                    <div class="promo_image_item promo_image_1">
                                        <img src="{{ asset('frontend/images/promo_image_1.jpeg') }}" alt="Home Improvement" class="img-fluid">
                                    </div>
                                    <div class="promo_image_item promo_image_2">
                                        <img src="{{ asset('frontend/images/promo_image_2.jpeg') }}" alt="Home Consultation" class="img-fluid">
                                    </div>
                                    <div class="promo_image_item promo_image_3">
                                        <img src="{{ asset('frontend/images/promo_image_3.jpeg') }}" alt="Home Services" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--========================= PROMOTIONAL SECTION END ==========================-->
    @endif

    @if ($services_overview_visibility ?? true)
        <!--========================= SERVICES OVERVIEW SECTION START ==========================-->
        <section class="wsus__services_overview_section mt_15 xs_mt_0 pt_30 xs_pt_20 pb_15 xs_pb_0">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 order-2 order-lg-1">
                        <div class="wsus__services_overview_image">
                            <div class="services_overview_image_wrapper">
                                <div class="services_overview_blue_blob"></div>
                                <div class="services_overview_single_image">
                                    <div class="services_overview_image_item">
                                        <img src="{{ asset('frontend/images/services_overview_image.jpeg') }}" alt="Services Overview" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 order-1 order-lg-2">
                        <div class="wsus__services_overview_content">
                            <!-- Section Title -->
                            <h2 class="wsus__services_overview_title mb_30">
                                Services Overview (Expanded)
                            </h2>
                            
                            <!-- Two lines of text with icons -->
                            <div class="wsus__services_overview_text mb_30">
                                <div class="services_overview_line_item">
                                    <svg class="services_overview_line_icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    <p class="services_overview_line">From renovations and remodeling to flooring, painting, lighting, and repairs etc.</p>
                                </div>
                                <div class="services_overview_line_item">
                                    <svg class="services_overview_line_icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    <p class="services_overview_line">We offer complete home improvement services tailored to your needs and budget.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--========================= SERVICES OVERVIEW SECTION END ==========================-->
    @endif

    @if ($benefits_section_visibility ?? true)
        <!--========================= BENEFITS SECTION START ==========================-->
        <section class="wsus__benefits_section mt_15 xs_mt_0 pt_90 xs_pt_30 pb_100 xs_pb_30">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 order-2 order-lg-1">
                        <div class="wsus__benefits_content">
                            <!-- Section Title -->
                            <h2 class="wsus__benefits_title mb_30">
                                Benefits-Focused Text
                            </h2>
                            
                            <!-- Two lines of text with icons -->
                            <div class="wsus__benefits_text mb_30">
                                <div class="benefits_line_item">
                                    <svg class="benefits_line_icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    <p class="benefits_line">Invest in your home with confidence.</p>
                                </div>
                                <div class="benefits_line_item">
                                    <svg class="benefits_line_icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    <p class="benefits_line">Our team combines experience, quality materials, and smart design to deliver results that last.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 order-1 order-lg-2">
                        <div class="wsus__benefits_image">
                            <div class="benefits_image_wrapper">
                                <div class="benefits_blue_blob"></div>
                                <div class="benefits_single_image">
                                    <div class="benefits_image_item">
                                        <img src="{{ asset('frontend/images/benefits_image.jpeg') }}" alt="Benefits" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--========================= BENEFITS SECTION END ==========================-->
    @endif

    @if ($join_as_provider_visibility)
        <!--=========================
            SELLER JOIN START
        ==========================-->
        <section class="wsus__seller_join pt_50 xs_pt_30 pb_50 xs_pb_30"
            style="background: url({{ asset($join_as_a_provider->image) }}) no-repeat center center; background-size: 100% 100%;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 m-auto">
                        <div class="wsus__seller_join_text text-center">
                            <h3>{{ $join_as_a_provider->title }}</h3>
                            <a href="{{ route('join-as-a-provider') }}">{{ $join_as_a_provider->button_text }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=========================
            SELLER JOIN END
        ==========================-->
    @endif


    @if ($testimonial_section->visibility)
        <!--=========================
            TESTIMONIAL START
        ==========================-->
        <section class="wsus__testimonial mt_0 pt_30 xs_pt_20 pb_100 xs_pb_70"
            style="background: url({{ asset('frontend/images/testimonial_bg.webp') }});">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 m-auto">
                        <div class="wsus__section_heading text-center mb_30">
                            <h2>Testimonials</h2>
                        </div>
                    </div>
                </div>
                <div class="row testi_slider">
                    @foreach ($testimonials as $testimonial)
                        <div class="col-xl-6">
                            <div class="wsus__single_testimonial">
                                <p class="review_text">{{ $testimonial->comment }}</p>
                                <div class="wsus__single_testimonial_img">
                                    <img class="img-fluid" src="{{ asset($testimonial->image) }}" alt="clients">
                                    <p><span>{{ $testimonial->name }}</span> {{ $testimonial->designation }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!--=========================
            TESTIMONIAL END
        ==========================-->
    @endif

    @if ($why_customers_love_visibility ?? true)
        <!--========================= WHY CUSTOMERS LOVE SECTION START ==========================-->
        <section class="wsus__why_customers_love_section mt_15 xs_mt_0 pt_30 xs_pt_5 pb_30 xs_pb_5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="wsus__why_customers_love_content text-center">
                            <h2 class="wsus__why_customers_love_title mb_50">
                                Why customers love Findupnow.com
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="row">
                            <!-- Point 1: Accuracy and Reliability -->
                            <div class="col-md-4 mb-4 mb-md-0">
                                <div class="why_customers_love_point text-center">
                                    <div class="why_customers_love_icon mb_20">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <p class="why_customers_love_point_text text-justify">
                                        Accuracy and reliability are at the core of FindUpNow. Customers trust the platform because the information is well-structured, up to date, and presented in a clear way, helping them make informed decisions with confidence.
                                    </p>
                                </div>
                            </div>
                            <!-- Point 2: Speed -->
                            <div class="col-md-4 mb-4 mb-md-0">
                                <div class="why_customers_love_point text-center">
                                    <div class="why_customers_love_icon mb_20">
                                        <i class="fas fa-bolt"></i>
                                    </div>
                                    <p class="why_customers_love_point_text text-justify">
                                        Another key reason is speed. Results are delivered fast, allowing users to move forward without delays. In situations where timing is critical, this makes a real difference.
                                    </p>
                                </div>
                            </div>
                            <!-- Point 3: Support and Improvement -->
                            <div class="col-md-4">
                                <div class="why_customers_love_point text-center">
                                    <div class="why_customers_love_icon mb_20">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                    <p class="why_customers_love_point_text text-justify">
                                        Finally, customers value the support and continuous improvement behind FindUpNow. The platform evolves based on user feedback, ensuring a better experience over time and reinforcing long-term trust.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="why_customers_love_decoration"></div>
        </section>
        <!--========================= WHY CUSTOMERS LOVE SECTION END ==========================-->
    @endif

    @if ($powering_home_visibility ?? true)
        <!--========================= POWERING HOME PROJECT SECTION START ==========================-->
        <section class="wsus__powering_home_section mt_15 xs_mt_0 pt_60 xs_pt_40 pb_80 xs_pb_50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="wsus__powering_home_header text-center mb_50 xs_mb_30">
                            <h2 class="wsus__powering_home_title">Powering Home Project</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="wsus__powering_home_slider_wrapper">
                            <div class="wsus__powering_home_slider">
                                <div class="powering_home_logo_item">
                                    <img src="{{ asset('frontend/images/logos/nextdoor.png') }}" alt="Nextdoor" class="powering_home_logo">
                                </div>
                                <div class="powering_home_logo_item">
                                    <img src="{{ asset('frontend/images/logos/redfin.png') }}" alt="Redfin" class="powering_home_logo">
                                </div>
                                <div class="powering_home_logo_item">
                                    <img src="{{ asset('frontend/images/logos/amazon.png') }}" alt="Amazon" class="powering_home_logo">
                                </div>
                                <div class="powering_home_logo_item">
                                    <img src="{{ asset('frontend/images/logos/pinterest.png') }}" alt="Pinterest" class="powering_home_logo">
                                </div>
                                <div class="powering_home_logo_item">
                                    <img src="{{ asset('frontend/images/logos/homedepot.png') }}" alt="Home Depot" class="powering_home_logo">
                                </div>
                                <div class="powering_home_logo_item">
                                    <img src="{{ asset('frontend/images/logos/offerup.png') }}" alt="OfferUp" class="powering_home_logo">
                                </div>
                                <div class="powering_home_logo_item">
                                    <img src="{{ asset('frontend/images/logos/yelp.png') }}" alt="Yelp" class="powering_home_logo">
                                </div>
                                <div class="powering_home_logo_item">
                                    <img src="{{ asset('frontend/images/logos/google.png') }}" alt="Google" class="powering_home_logo">
                                </div>
                                <div class="powering_home_logo_item">
                                    <img src="{{ asset('frontend/images/logos/facebook.png') }}" alt="Facebook" class="powering_home_logo">
                                </div>
                                <!-- Duplicate logos for seamless loop -->
                                <div class="powering_home_logo_item">
                                    <img src="{{ asset('frontend/images/logos/nextdoor.png') }}" alt="Nextdoor" class="powering_home_logo">
                                </div>
                                <div class="powering_home_logo_item">
                                    <img src="{{ asset('frontend/images/logos/redfin.png') }}" alt="Redfin" class="powering_home_logo">
                                </div>
                                <div class="powering_home_logo_item">
                                    <img src="{{ asset('frontend/images/logos/amazon.png') }}" alt="Amazon" class="powering_home_logo">
                                </div>
                                <div class="powering_home_logo_item">
                                    <img src="{{ asset('frontend/images/logos/pinterest.png') }}" alt="Pinterest" class="powering_home_logo">
                                </div>
                                <div class="powering_home_logo_item">
                                    <img src="{{ asset('frontend/images/logos/homedepot.png') }}" alt="Home Depot" class="powering_home_logo">
                                </div>
                                <div class="powering_home_logo_item">
                                    <img src="{{ asset('frontend/images/logos/offerup.png') }}" alt="OfferUp" class="powering_home_logo">
                                </div>
                                <div class="powering_home_logo_item">
                                    <img src="{{ asset('frontend/images/logos/yelp.png') }}" alt="Yelp" class="powering_home_logo">
                                </div>
                                <div class="powering_home_logo_item">
                                    <img src="{{ asset('frontend/images/logos/google.png') }}" alt="Google" class="powering_home_logo">
                                </div>
                                <div class="powering_home_logo_item">
                                    <img src="{{ asset('frontend/images/logos/facebook.png') }}" alt="Facebook" class="powering_home_logo">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--========================= POWERING HOME PROJECT SECTION END ==========================-->
    @endif

    {{-- @if ($subscription_visbility)
        <!--=========================
                                                                            SUBSCRIBE START
                                                                        ==========================-->
        <section class="wsus__subscribe mt_100 xs_mt_70"
            style="background: url({{ asset($subscriber->background_image) }});">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-6 col-lg-6">
                        <div class="wsus__subscribe_text mt_90 xs_mt_60 mb_100 xs_mb_70">
                            <h3>{{ $subscriber->title }}</h3>
                            <p>{{ $subscriber->description }}</p>
                            <form id="subscriberForm">
                                @csrf
                                <input name="email" type="email" placeholder="{{ __('Your Email') }}">
                                <button class="common_btn" id="subscribe_btn"
                                    type="submit">{{ __('Subscribe') }}</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-5 col-md-6 d-none d-lg-block">
                        <div class="wsus__subscribe_img">
                            <img class="img-fluid w-100" src="{{ asset($subscriber->foreground_image) }}"
                                alt="subecribe">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=========================
                                                                            SUBSCRIBE END
                                                                        ==========================-->
    @endif

    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                $("#subscriberForm").on('submit', function(e) {
                    e.preventDefault();
                    var isDemo = "{{ env('APP_MODE') }}"
                    if (isDemo == 'DEMO') {
                        toastr.error('This Is Demo Version. You Can Not Change Anything');
                        return;
                    }

                    let loading = "{{ __('Processing...') }}"

                    $("#subscribe_btn").html(loading);
                    $("#subscribe_btn").attr('disabled', true);

                    $.ajax({
                        type: 'POST',
                        data: $('#subscriberForm').serialize(),
                        url: "{{ route('subscribe-request') }}",
                        success: function(response) {
                            if (response.status == 1) {
                                toastr.success(response.message);
                                let subscribe = "{{ __('Subscribe') }}"
                                $("#subscribe_btn").html(subscribe);
                                $("#subscribe_btn").attr('disabled', false);
                                $("#subscriberForm").trigger("reset");
                            }

                            if (response.status == 0) {
                                toastr.error(response.message);
                                let subscribe = "{{ __('Subscribe') }}"
                                $("#subscribe_btn").html(subscribe);
                                $("#subscribe_btn").attr('disabled', false);
                                $("#subscriberForm").trigger("reset");
                            }
                        },
                        error: function(err) {
                            toastr.error('Something went wrong');
                            let subscribe = "{{ __('Subscribe') }}"
                            $("#subscribe_btn").html(subscribe);
                            $("#subscribe_btn").attr('disabled', false);
                            $("#subscriberForm").trigger("reset");
                        }
                    });
                });

            });
        })(jQuery);
    </script> --}}

@push('js')
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                // Redirect logic is now handled directly in the Blade template href attributes
            });
        })(jQuery);
    </script>
@endpush

@endsection
