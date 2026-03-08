@extends('admin.master_layout')
@section('title')
    <title>{{ __('Blog') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Create Blog') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item active"><a href="{{ route('admin.blog.index') }}">{{ __('Blog') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('create Blog') }}</div>
                </div>
            </div>

            <div class="section-body">
                <a class="btn btn-primary" href="{{ route('admin.blog.index') }}"><i class="fas fa-list"></i>
                    {{ __('Blog') }}</a>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>{{ __('Thumbnail Image Preview') }}</label>
                                            <div>
                                                <img class="admin-img" id="preview-img"
                                                    src="{{ asset('uploads/website-images/preview.webp') }}"
                                                    alt="">
                                            </div>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Thumbnail Image') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="image" type="file"
                                                onchange="previewThumnailImage(event)">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Title') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" id="title" name="title" type="text"
                                                value="{{ old('title') }}">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Slug') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" id="slug" name="slug" type="text"
                                                value="{{ old('slug') }}">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Category') }} <span class="text-danger">*</span></label>
                                            <select class="form-control select2" id="category" name="category">
                                                <option value="">{{ __('Select Category') }}</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ $category->id == old('category') ? 'selected' : '' }}>
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Description') }} <span class="text-danger">*</span></label>
                                            <textarea class="summernote" id="" name="description" cols="30" rows="10">{{ old('description') }}</textarea>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Show Homepage ?') }} <span class="text-danger">*</span></label>
                                            <select class="form-control" name="show_homepage">
                                                <option value="0">{{ __('No') }}</option>
                                                <option value="1">{{ __('Yes') }}</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Status') }} <span class="text-danger">*</span></label>
                                            <select class="form-control" name="status">
                                                <option value="1">{{ __('Active') }}</option>
                                                <option value="0">{{ __('Inactive') }}</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('SEO Title') }}</label>
                                            <input class="form-control" name="seo_title" type="text"
                                                value="{{ old('seo_title') }}">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('SEO Description') }}</label>
                                            <textarea class="form-control text-area-5" id="" name="seo_description" cols="30" rows="10">{{ old('seo_description') }}</textarea>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-primary">{{ __('Save') }}</button>
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
            "use strict";
            $(document).ready(function() {
                $("#title").on("keyup", function(e) {
                    $("#slug").val(convertToSlug($(this).val()));
                })
            });
        })(jQuery);

        function convertToSlug(Text) {
            return Text
                .toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
        }

        function previewThumnailImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview-img');
                output.src = reader.result;
            }

            reader.readAsDataURL(event.target.files[0]);
        };

        function previewBannerImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview-banner-img');
                output.src = reader.result;
            }

            reader.readAsDataURL(event.target.files[0]);
        };
    </script>
@endsection
