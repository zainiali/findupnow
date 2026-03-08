@extends('admin.master_layout')
@section('title')
    <title>{{ __('Edit Job Post') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Edit Job Post') }}</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.jobpost.update', $job_post->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">

                                        <div class="form-group col-md-12 col-12">
                                            <img id="view_img" src="{{ asset($job_post->thumb_image) }}" height="100"
                                                width="100"><br>
                                            <label class="form-label">{{ __('Thumbnail Image') }}</label>
                                            <input class="form-control" name="thumb_image" type="file">
                                        </div>

                                        <div class="form-group col-md-6 col-12">
                                            <label class="form-label">{{ __('User/Buyer') }} <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control select2" id="" name="user_id">
                                                <option value="">{{ __('Select Influencer') }}</option>
                                                @foreach ($agents as $agent)
                                                    <option value="{{ $agent->id }}"
                                                        {{ $agent->id == $job_post->user_id ? 'selected' : '' }}>
                                                        {{ $agent->name }} - {{ $agent->email }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6 col-12">
                                            <label class="form-label">{{ __('Title') }} <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" id="title" name="title" type="text"
                                                value="{{ html_decode($job_post->title) }}">
                                        </div>

                                        <div class="form-group col-md-6 col-12">
                                            <label class="form-label">{{ __('Slug') }} <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" id="slug" name="slug" type="text"
                                                value="{{ html_decode($job_post->slug) }}">
                                        </div>

                                        <div class="form-group col-md-6 col-12">
                                            <label class="form-label">{{ __('Category') }} <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control select2" id="" name="category_id">
                                                <option value="">{{ __('Select Category') }}</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ $category->id == $job_post->category_id ? 'selected' : '' }}>
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6 col-12">
                                            <label class="form-label">{{ __('City') }} <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control select2" id="" name="city_id">
                                                <option value="">{{ __('Select City') }}</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}"
                                                        {{ $city->id == $job_post->city_id ? 'selected' : '' }}>
                                                        {{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6 col-12">
                                            <label class="form-label">{{ __('Start Price') }} <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" id="regular_price" name="regular_price"
                                                type="text" value="{{ html_decode($job_post->regular_price) }}">
                                        </div>

                                        <div class="form-group col-md-6 col-12">
                                            <label class="form-label">{{ __('Job Type') }} <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" id="" name="job_type">
                                                <option value="Hourly"
                                                    {{ 'Hourly' == $job_post->job_type ? 'selected' : '' }}>
                                                    {{ __('Hourly') }}</option>
                                                <option value="Daily"
                                                    {{ 'Daily' == $job_post->job_type ? 'selected' : '' }}>
                                                    {{ __('Daily') }}</option>
                                                <option value="Monthly"
                                                    {{ 'Monthly' == $job_post->job_type ? 'selected' : '' }}>
                                                    {{ __('Monthly') }}</option>
                                                <option value="Yearly"
                                                    {{ 'Yearly' == $job_post->job_type ? 'selected' : '' }}>
                                                    {{ __('Yearly') }}</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6 col-12">
                                            <label class="form-label">{{ __('Address') }} <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" id="address" name="address" type="text"
                                                value="{{ $job_post->address }}">
                                        </div>

                                        <div class="form-group col-md-12 col-12">
                                            <label class="form-label">{{ __('Description') }} <span
                                                    class="text-danger">*</span></label>

                                            <textarea class="crancy__item-input crancy__item-textarea summernote" id="description" name="description">{!! html_decode($job_post->description) !!}</textarea>

                                        </div>

                                        <div class="form-group col-md-12 col-12">
                                            <label class="d-flex align-items-center mb-0">
                                                <input name="status" type="hidden" value="disable">
                                                <input class="custom-switch-input" name="status" type="checkbox"
                                                    value="enable" {{ $job_post->status == 'enable' ? 'checked' : '' }}>
                                                <span class="custom-switch-indicator"></span>
                                                <span
                                                    class="custom-switch-description">{{ __('Visibility Status') }}</span>
                                            </label>
                                        </div>

                                        <div class="form-group col-md-12 col-12">
                                            <label class="d-flex align-items-center mb-0">
                                                <input name="approved_by_admin" type="hidden" value="pending">
                                                <input class="custom-switch-input" name="approved_by_admin"
                                                    type="checkbox" value="approved"
                                                    {{ $job_post->approved_by_admin == 'approved' ? 'checked' : '' }}>
                                                <span class="custom-switch-indicator"></span>
                                                <span
                                                    class="custom-switch-description">{{ __('Admin Approved') }}</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-primary">{{ __('Update') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>

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
@endsection
