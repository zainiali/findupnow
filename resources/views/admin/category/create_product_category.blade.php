@extends('admin.master_layout')
@section('title')
    <title>{{ __('Create Category') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Create Category') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.category.index') }}">{{ __('Category List') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Create Category') }}</div>
                </div>
            </div>

            <div class="section-body">
                <a class="btn btn-primary" href="{{ route('admin.category.index') }}"><i class="fas fa-list"></i>
                    {{ __('Category List') }}</a>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.category.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>{{ __('Icon') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="icon" type="file">
                                        </div>

                                        @if ($selected_theme == 0 || $selected_theme == 3)
                                            <div class="form-group col-12">
                                                <label>{{ __('Image') }} <span class="text-danger">*</span></label>
                                                <input class="form-control" name="image" type="file">
                                            </div>
                                        @endif

                                        <div class="form-group col-12">
                                            <label>{{ __('Name') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" id="name" name="name" type="text">
                                        </div>
                                        <div class="form-group col-12">
                                            <label>{{ __('Slug') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" id="slug" name="slug" type="text">
                                        </div>
                                        <div class="form-group col-12">
                                            <label>{{ __('Status') }} <span class="text-danger">*</span></label>
                                            <select class="form-control" name="status">
                                                <option value="1">{{ __('Active') }}</option>
                                                <option value="0">{{ __('InActive') }}</option>
                                            </select>
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
                $("#name").on("keyup", function(e) {
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
    </script>
@endsection
