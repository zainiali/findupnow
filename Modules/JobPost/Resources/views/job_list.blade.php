@extends('website.layout')
@section('title')
    <title>{{ __('Job List') }}</title>
    <meta name="keywords" content="{{ __('Job List') }}">
    <meta name="title" content="{{ __('Job List') }}">
    <meta name="description" content="{{ __('Job List') }}">
@endsection
@section('frontend-content')
    <style>
        /* Sleek Select2 Glassmorphism Styling - Compact Version */
        .select2-container--default .select2-selection--single {
            background-color: transparent !important;
            border: 1px solid #E5E7EB !important;
            border-radius: 8px !important;
            height: 40px !important; /* Thinner size like Image 2 */
            display: flex !important;
            align-items: center !important;
            transition: all 0.3s ease !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #4B5563 !important;
            font-size: 14px !important; /* Slightly smaller text */
            padding-left: 8px !important;
            font-weight: 500 !important;
            line-height: normal !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 38px !important;
            right: 8px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: #9CA3AF transparent transparent transparent !important;
            border-width: 5px 4px 0 4px !important;
        }

        /* Glassmorphism Dropdown */
        .select2-dropdown {
            background: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: blur(20px) !important;
            -webkit-backdrop-filter: blur(20px) !important;
            border: 1px solid rgba(255, 255, 255, 0.6) !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08) !important;
            border-radius: 12px !important;
            margin-top: 5px !important;
            overflow: hidden !important;
            z-index: 10000 !important;
        }

        /* Search Box in Select2 */
        .select2-search--dropdown {
            padding: 8px !important;
            background: rgba(255, 255, 255, 0.3) !important;
        }

        .select2-search--dropdown .select2-search__field {
            background: #fff !important;
            border: 1px solid #E5E7EB !important;
            border-radius: 6px !important;
            padding: 6px 10px !important;
            outline: none !important;
            font-size: 13px !important;
        }

        /* Results List & Custom Scrollbar */
        .select2-results__options {
            max-height: 220px !important;
            overflow-y: auto !important;
        }

        .select2-results__options::-webkit-scrollbar {
            width: 5px;
        }

        .select2-results__options::-webkit-scrollbar-track {
            background: transparent;
        }

        .select2-results__options::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .select2-results__option {
            padding: 8px 12px !important;
            font-size: 14px !important;
            color: #374151 !important;
            background-color: transparent !important;
        }

        .select2-results__option--highlighted[aria-selected] {
            background-color: rgba(55, 143, 255, 0.08) !important;
            color: #378FFF !important;
        }

        /* Compact Input Group Style */
        .input-group_two {
            border-radius: 8px !important;
            background: #fff !important;
            border: 1px solid #E5E7EB !important;
            height: 40px !important; /* Matching Image 2 */
            margin-bottom: 0 !important;
        }

        .input-group_two .input-group-text {
            border: none !important;
            padding: 0 8px !important;
            background: transparent !important;
        }

        .input-group_two .form-control {
            height: 38px !important;
            border: none !important;
            font-size: 14px !important;
            padding-left: 0 !important;
        }

        .input-group_two .select2-container {
            flex: 1 !important;
        }

        .input-group_two .select2-container--default .select2-selection--single {
            border: none !important;
            height: 38px !important;
        }

        /* Button compact alignment */
        .btn-primary {
            height: 40px !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            border-radius: 8px !important;
        }
    </style>
    <!--=========================
                                                                                         BREADCRUMB START
                                                                                     ==========================-->
    <div class="wsus__breadcrumb" style="background: url({{ asset($breadcrumb->image) }});">
        <div class="wsus__breadcrumb_overlay pt_90 xs_pt_60 pb_95 xs_pb_65">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <nav aria-label="breadcrumb">
                            <h1>{{ __('Job List') }}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('Job List') }}</li>
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
    <!-- Faq Area -->
    <section class="wsus__faq mt_90 xs_mt_60 mb_100 xs_mb_70">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-lg-12 col-xl-10">
                    <form action="{{ route('serch-job') }}" method="GET">
                        <div class="row g-3 align-items-center">
                            <!-- Job Search -->
                            <div class="col-lg-4 col-sm-12 col-md-4">
                                <div class="input-group input-group_two">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.9 10.9L13 13M12.4 6.7C12.4 3.55198 9.84802 1 6.7 1C3.55198 1 1 3.55198 1 6.7C1 9.84802 3.55198 12.4 6.7 12.4C9.84802 12.4 12.4 9.84802 12.4 6.7Z"
                                                stroke="#A7AEBA" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <input class="form-control border-start-0 shadow-none" name="key" type="text"
                                        value="{{ request('key') }}" placeholder="Job Title or keywords" />
                                </div>
                            </div>
                            <!-- Location -->
                            <div class="col-lg-3 col-sm-6 col-md-3">
                                <div class="input-group input-group_two">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="6.83268" cy="6.9987" r="4.66667" stroke="#A7AEBA"
                                                stroke-width="1.5" />
                                            <circle cx="6.83203" cy="7" r="1.75" stroke="#A7AEBA"
                                                stroke-width="1.5" />
                                            <path d="M6.83203 2.33268V1.16602" stroke="#A7AEBA" stroke-width="1.5"
                                                stroke-linecap="round" />
                                            <path d="M6.83203 12.8327V11.666" stroke="#A7AEBA" stroke-width="1.5"
                                                stroke-linecap="round" />
                                            <path d="M11.4993 7L12.666 7" stroke="#A7AEBA" stroke-width="1.5"
                                                stroke-linecap="round" />
                                            <path d="M0.999349 7L2.16602 7" stroke="#A7AEBA" stroke-width="1.5"
                                                stroke-linecap="round" />
                                        </svg>
                                    </span>
                                    <select class="form-select border-start-0 shadow-none select_2" name="location">
                                        <option value="0">{{ __('All Location') }}</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}" @selected(request('location') == $city->id)>
                                                {{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Categories -->
                            <div class="col-lg-3 col-sm-6 col-md-3">
                                <div class="input-group input-group_two">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <svg width="16" height="14" viewBox="0 0 16 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.1 7.66667H5.9M15 5.66667V10.3333C15 11.8061 13.7464 13 12.2 13H3.8C2.2536 13 1 11.8061 1 10.3333V3.66667C1 2.19391 2.2536 1 3.8 1H5.66667C6.2725 1 6.862 1.18714 7.34667 1.53333L8.65333 2.46667C9.138 2.81286 9.7275 3 10.3333 3H12.2C13.7464 3 15 4.19391 15 5.66667Z"
                                                stroke="#333333" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <select class="form-select border-start-0 shadow-none select_2" name="category">
                                        <option value="0">{{ __('All Categories') }}</option>
                                        @foreach ($job_categories as $category)
                                            <option value="{{ $category->id }}" @selected(request('category') == $category->id)>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Search Button -->
                            <div class="col-lg-2 col-sm-12 col-md-2">
                                <button class="btn btn-primary w-100">{{ __('Find Job') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                @foreach ($job_posts as $job_post)
                    <div class="col-lg-4 col-xl-3 col-md-6 mb-4">
                        <div class="job-card">
                            <div class="job-icon">
                                <img src="{{ asset($job_post->thumb_image) }}" alt="" />
                            </div>
                            <div class="d-flex gap-2 align-items-center mb-3">
                                <span class="job-badge">{{ $job_post->job_type }}</span>
                            </div>
                            <h3 class="job-title">
                                <a href="{{ route('job-detils', $job_post->slug) }}"> {{ html_decode($job_post->title) }}
                                </a>
                            </h3>
                            <div class="d-flex flex-wrap justify-content-between job-info">
                                <h4 class="job-price m-0 fw-bold">{{ __('Start At -') }}
                                    {{ currency($job_post->regular_price) }}</h4>
                                <span class="job-date">
                                    {{ Carbon\Carbon::parse($job_post->created_at)->format('d M y') }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
    </section>
    <!-- End Faq Area -->
@push('js')
    <script>
        $(document).ready(function() {
            // Force Select2 initialization with search enabled and custom parent
            if (typeof $.fn.select2 !== 'undefined') {
                $('.select_2').select2({
                    minimumResultsForSearch: 0, // Always show search box
                    width: '100%',
                    dropdownParent: $('section.wsus__faq') 
                });
            }
        });
    </script>
@endpush
@endsection
