@extends('admin.master_layout')
@section('title')
    <title>{{ __('Create Job Post') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Create Job Post') }}</h1>
            </div>

            <div class="section-body">
                <a class="btn btn-primary" href="{{ route('admin.jobpost.index') }}"><i class="fas fa-list"></i>
                    {{ __('Job Post List') }}</a>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.jobpost.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-12 col-12">
                                            <label>{{ __('Thumbnail Image') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="thumb_image" type="file">
                                        </div>

                                        <div class="form-group col-md-6 col-12">
                                            <label>{{ __('User/Buyer') }} <span class="text-danger">*</span></label>
                                            <select class="form-control select2" id="" name="user_id">
                                                <option disabled selected>{{ __('Select User') }}</option>
                                                @foreach ($agents as $agent)
                                                    <option value="{{ $agent->id }}"
                                                        {{ $agent->id == old('user_id') ? 'selected' : '' }}>
                                                        {{ $agent->name }} - {{ $agent->email }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6 col-12">
                                            <label>{{ __('Title') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" id="title" name="title" type="text"
                                                value="{{ old('title') }}">
                                        </div>

                                        <div class="form-group col-md-6 col-12">
                                            <label>{{ __('Slug') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" id="slug" name="slug" type="text"
                                                value="{{ old('slug') }}">
                                        </div>

                                        <div class="form-group col-md-6 col-12">
                                            <label>{{ __('Category') }} <span class="text-danger">*</span></label>
                                            <select class="form-control select2" id="" name="category_id">
                                                <option disabled selected>{{ __('Select Category') }}</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ $category->id == old('category_id') ? 'selected' : '' }}>
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6 col-12">
                                            <label>{{ __('City') }} <span class="text-danger">*</span></label>
                                            <select class="form-control select2" id="" name="city_id">
                                                <option disabled selected>{{ __('Select City') }}</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}"
                                                        {{ $city->id == old('city_id') ? 'selected' : '' }}>
                                                        {{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6 col-12">
                                            <label>{{ __('Start Price') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" id="regular_price" name="regular_price"
                                                type="text" value="{{ old('regular_price') }}">
                                        </div>

                                        <div class="form-group col-md-6 col-12">
                                            <label>{{ __('Job Type') }} <span class="text-danger">*</span></label>
                                            <select class="form-control" id="" name="job_type">
                                                <option value="Hourly" {{ 'Hourly' == old('job_type') ? 'selected' : '' }}>
                                                    {{ __('Hourly') }}</option>
                                                <option value="Daily" {{ 'Daily' == old('job_type') ? 'selected' : '' }}>
                                                    {{ __('Daily') }}</option>
                                                <option value="Monthly"
                                                    {{ 'Monthly' == old('job_type') ? 'selected' : '' }}>
                                                    {{ __('Monthly') }}</option>
                                                <option value="Yearly" {{ 'Yearly' == old('job_type') ? 'selected' : '' }}>
                                                    {{ __('Yearly') }}</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6 col-12">
                                            <label>{{ __('Address') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" id="address" name="address" type="text"
                                                value="{{ old('address') }}">
                                        </div>

                                        <div class="form-group col-md-12 col-12">
                                            <label>{{ __('Description') }} <span class="text-danger">*</span></label>

                                            <textarea class="crancy__item-input crancy__item-textarea summernote" id="description" name="description">{{ old('description') }}</textarea>

                                        </div>

                                        <div class="form-group col-md-12 col-12">
                                            <label class="d-flex align-items-center mb-0">
                                                <input name="status" type="hidden" value="disable">
                                                <input class="custom-switch-input" name="status" type="checkbox"
                                                    value="enable">
                                                <span class="custom-switch-indicator"></span>
                                                <span
                                                    class="custom-switch-description">{{ __('Visibility Status') }}</span>
                                            </label>
                                        </div>

                                        <div class="form-group col-md-12 col-12">
                                            <label class="d-flex align-items-center mb-0">
                                                <input name="approved_by_admin" type="hidden" value="pending">
                                                <input class="custom-switch-input" name="approved_by_admin" type="checkbox"
                                                    value="approved">
                                                <span class="custom-switch-indicator"></span>
                                                <span
                                                    class="custom-switch-description">{{ __('Admin Approved') }}</span>
                                            </label>
                                        </div>

                                    </div>

                                    <button class="btn btn-primary" type="submit">{{ __('Update Data') }}</button>

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
