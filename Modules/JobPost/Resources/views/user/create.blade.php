@extends($active_theme)
@section('title')
    <title>{{ __('Dashboard') }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ __('All Job Post') }}">
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
                            <h1>{{ __('All Job Post') }}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('All Job Post') }}</li>
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
                                                                DASHBOARD START
                                                            ==========================-->
    <section class="wsus__dashboard mt_90 xs_mt_60 mb_100 xs_mb_70">
        <div class="container">
            <div class="wsus__dashboard_area">
                <div class="row">
                    <div class="col-xl-3 col-lg-4">
                        <div class="wsus__dashboard_menu">
                            <div class="dasboard_header d-flex flex-wrap align-items-center">
                                <img class="img-fluid w-100 user_avatar"
                                    src="{{ $user->image ? asset($user->image) : asset($setting->default_avatar) }}"
                                    alt="user">
                                <div class="text">
                                    <h2>{{ html_decode($user->name) }}</h2>
                                </div>
                            </div>
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">

                                <a href="{{ route('dashboard') }}#dashboard"><button class="nav-link"
                                        id="v-pills-jobpost-tab" type="button" aria-selected="false"><span><i
                                                class="fas fa-user"></i></span>
                                        {{ __('Dashboard') }} </button></a>

                                <a href="{{ route('jobpost.index') }}#jobpost"><button class="nav-link active"
                                        id="v-pills-jobpost-tab" type="button" aria-selected="false"><span><i
                                                class="fas fa-file-signature"></i></span> {{ __('Job Post') }}
                                    </button></a>

                                <a href="{{ route('dashboard') }}#order"><button class="nav-link" id="v-pills-jobpost-tab"
                                        type="button" aria-selected="false"><span><i
                                                class="fas fa-bags-shopping"></i></span> {{ __('Order') }}
                                    </button></a>

                                <a href="{{ route('dashboard') }}#reviews"><button class="nav-link"
                                        id="v-pills-jobpost-tab" type="button" aria-selected="false"><span><i
                                                class="fas fa-star"></i></span>
                                        {{ __('Reviews') }} </button></a>

                                <a href="{{ route('dashboard') }}#support"><button class="nav-link"
                                        id="v-pills-jobpost-tab" type="button" aria-selected="false"><span><i
                                                class="fas fa-user-headset"></i></span> {{ __('Support Ticket') }}
                                    </button></a>

                                <a href="{{ route('dashboard') }}#password"><button class="nav-link"
                                        id="v-pills-jobpost-tab" type="button" aria-selected="false"><span><i
                                                class="fas fa-user-lock"></i></span>
                                        {{ __('Change Password') }}
                                    </button></a>

                                <button class="nav-link" data-bs-toggle="modal" data-bs-target="#accountDelete"
                                    type="button"><span> <i class="fas fa-trash"></i> </span>
                                    {{ __('Delete Account') }}</button>

                                <button class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    type="button"><span> <i class="fas fa-sign-out-alt"></i> </span>
                                    {{ __('Logout') }}</button>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8">
                        <div class="wsus__dashboard_content">
                            <div class="wsus_dashboard_body">
                                <div class="wsus__review_input">
                                    <div class="row py-1">
                                        <div class="col-md-6 py-1">
                                            <h3>{{ __('Create Job Post') }}</h3>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <a class="common_btn order_request_btn"
                                                href="{{ route('jobpost.index') }}">{{ __('Go Back') }}</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <form action="{{ route('jobpost.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <fieldset>
                                                    <legend>{{ __('Thumbnail Image') }}*</legend>
                                                    <input name="user_id" type="hidden" value="{{ $user->id }}">
                                                    <input name="thumb_image" type="file">
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-6">
                                                <fieldset>
                                                    <legend>{{ __('Title') }} *</legend>
                                                    <input id="title" name="title" type="text"
                                                        value="{{ old('title') }}">
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-6">
                                                <fieldset>
                                                    <legend>{{ __('Slug') }}*</legend>
                                                    <input id="slug" name="slug" type="text" type="text"
                                                        value="{{ old('slug') }}">
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-6">
                                                <fieldset>
                                                    <legend>{{ __('Category') }}*</legend>
                                                    <select class="form-select" id="category_id" name="category_id">
                                                        <option value="">{{ __('Select Category') }}</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ $category->id == old('category_id') ? 'selected' : '' }}>
                                                                {{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-6">
                                                <fieldset>
                                                    <legend>{{ __('City') }}*</legend>
                                                    <select class="form-select" id="city_id" name="city_id">
                                                        <option value="">{{ __('Select City') }}</option>
                                                        @foreach ($cities as $city)
                                                            <option value="{{ $city->id }}"
                                                                {{ $city->id == old('city_id') ? 'selected' : '' }}>
                                                                {{ $city->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-6">
                                                <fieldset>
                                                    <legend>{{ __('Job Type') }}</legend>
                                                    <select class="form-select" id="" name="job_type">
                                                        <option value="Hourly"
                                                            {{ 'Hourly' == old('job_type') ? 'selected' : '' }}>
                                                            {{ __('Hourly') }}</option>
                                                        <option value="Daily"
                                                            {{ 'Daily' == old('job_type') ? 'selected' : '' }}>
                                                            {{ __('Daily') }}</option>
                                                        <option value="Monthly"
                                                            {{ 'Monthly' == old('job_type') ? 'selected' : '' }}>
                                                            {{ __('Monthly') }}</option>
                                                        <option value="Yearly"
                                                            {{ 'Yearly' == old('job_type') ? 'selected' : '' }}>
                                                            {{ __('Yearly') }}</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-6">
                                                <fieldset>
                                                    <legend>{{ __('Start Price') }} *</legend>
                                                    <input id="regular_price" name="regular_price" type="text"
                                                        value="{{ old('regular_price') }}">
                                                </fieldset>
                                            </div>

                                            <div class="col-lg-6">
                                                <fieldset>
                                                    <legend>{{ __('Address') }} *</legend>
                                                    <input id="address" name="address" type="text"
                                                        value="{{ old('address') }}">
                                                </fieldset>
                                            </div>

                                            <div class="col-lg-12">
                                                <fieldset>
                                                    <legend>{{ __('Description') }} *</legend>
                                                    <textarea class="summernote" id="description" name="description">{{ old('description') }}</textarea>
                                                </fieldset>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="dashboard-cehckbox">
                                                    <input name="status" type="hidden" value="disable">
                                                    <input id="visibility_status" name="status" type="checkbox"
                                                        value="enable">
                                                    <label for="visibility_status">{{ __('Visibility Status') }} *</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <button class="common_btn mt_20"
                                                    type="submit">{{ __('Update') }}</button>
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

    <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Confirm') }}</h5>
                    <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img class="img-fluid w-100" src="{{ asset('frontend/images/logout_img.webp') }}" alt="Logout">
                    <p>{{ __('Are you sure you want to Logout') }}</p>
                </div>
                <div class="modal-footer">
                    <a class="common_btn" href="{{ route('user.logout') }}">{{ __('Yes! Logout') }}</a>

                    <button class="del_btn" data-bs-dismiss="modal" type="button">{{ __('cancel') }}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="accountDelete" aria-labelledby="accountDelete" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">

                    <p>{{ __('Are you sure you want to delete your account') }} <b>{{ __('Kingserv') }}</b>
                    </p>
                </div>
                <div class="modal-footer">
                    <a class="common_btn" href="{{ route('user.delete-account') }}">{{ __('Yes, Delete') }}</a>

                    <button class="del_btn" data-bs-dismiss="modal" type="button">{{ __('cancel') }}</button>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('backend/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script>
        (function($) {
            "use strict"
            $(document).ready(function() {
                $("#title").on("keyup", function(e) {
                    let inputValue = $(this).val();
                    let slug = inputValue.toLowerCase().replace(/[^\w ]+/g, '').replace(/ +/g, '-');
                    $("#slug").val(slug);
                })
            });
        })(jQuery);
    </script>
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                tinymce.init({
                    selector: '.summernote',
                    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
                    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                    tinycomments_mode: 'embedded',
                    tinycomments_author: 'Author name',
                    mergetags_list: [{
                            value: 'First.Name',
                            title: 'First Name'
                        },
                        {
                            value: 'Email',
                            title: 'Email'
                        },
                    ]
                });
                $('.select2').select2();
                $('.sub_cat_one').select2();
                $('.tags').tagify();
                $('.datetimepicker_mask').datetimepicker({
                    format: 'Y-m-d H:i',
                });
            });

        })(jQuery);
    </script>

    <!--=========================
                                                                DASHBOARD END
                                                            ==========================-->
@endsection
