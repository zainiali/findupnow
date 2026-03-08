@extends('admin.master_layout')
@section('title')
    <title>{{ __('Edit Category') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Edit Category') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.category.index') }}">{{ __('Category List') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Edit Category') }}</div>
                </div>
            </div>

            <div class="section-body row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header gap-3 justify-content-between align-items-center">
                            <h5 class="m-0 service_card">{{ __('Available Translations') }}</h5>

                        </div>
                        <div class="card-body">
                            <div class="lang_list_top">
                                <ul class="lang_list">
                                    @foreach ($languages as $language)
                                        <li><a id="{{ request('code') == $language->code ? 'selected-language' : '' }}"
                                                href="{{ route('admin.category.edit', ['category' => $category->id, 'code' => $language->code]) }}"><i
                                                    class="fas {{ request('code', $code) == $language->code ? 'fa-eye' : 'fa-edit' }}"></i>
                                                {{ $language->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="mt-2 alert alert-danger" role="alert">
                                @php
                                    $currentLanguage = $languages
                                        ->where('code', request()->get('code', $code))
                                        ->first();
                                @endphp
                                <p>{{ __('Your editing mode') }} :
                                    <b>{{ $currentLanguage?->name }}</b>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-body">
                <a class="btn btn-primary" href="{{ route('admin.category.index') }}"><i class="fas fa-list"></i>
                    {{ __('Category List') }}</a>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form
                                    action="{{ route('admin.category.update', [
                                        'category' => $category->id,
                                        'code' => $code,
                                    ]) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        @if ($code == $languages->first()->code)
                                            <div class="form-group col-12">
                                                <label>{{ __('Existing Icon') }}</label>
                                                <div>
                                                    <img class="w_80" src="{{ asset($category->icon) }}" alt="">
                                                </div>
                                            </div>

                                            <div class="form-group col-12">
                                                <label>{{ __('Icon') }}</label>
                                                <input class="form-control" name="icon" type="file">
                                            </div>

                                            @if ($selected_theme == 0 || $selected_theme == 3)
                                                <div class="form-group col-12">
                                                    <label>{{ __('Existing Image') }}</label>
                                                    <div>
                                                        <img class="w_120" src="{{ asset($category->image) }}"
                                                            alt="">
                                                    </div>
                                                </div>

                                                <div class="form-group col-12">
                                                    <label>{{ __('Image') }}</label>
                                                    <input class="form-control" name="image" type="file">
                                                </div>
                                            @endif
                                        @endif

                                        <div class="form-group col-12">
                                            <label>{{ __('Name') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" id="name" name="name" data-translate="true"
                                                type="text"
                                                value="{{ old('name', $category->getTranslation($code)->name) }}">
                                        </div>

                                        @if ($code == $languages->first()->code)
                                            <div class="form-group col-12">
                                                <label>{{ __('Slug') }} <span class="text-danger">*</span></label>
                                                <input class="form-control" id="slug" name="slug" type="text"
                                                    value="{{ $category->slug }}">
                                            </div>
                                            <div class="form-group col-12">
                                                <label>{{ __('Status') }} <span class="text-danger">*</span></label>
                                                <select class="form-control" name="status">
                                                    <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>
                                                        {{ __('Active') }}</option>
                                                    <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>
                                                        {{ __('InActive') }}</option>
                                                </select>
                                            </div>
                                        @endif
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
@endsection

@push('js')
    <script>
        'use strict';
        $(document).ready(function() {
            $("#name").on("keyup", function(e) {
                $("#slug").val(convertToSlug($(this).val()));
            })
        });

        function convertToSlug(Text) {
            return Text
                .toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
        }

        $('#translate-btn').on('click', function() {
            translateAllTo("{{ $code }}");
        })
    </script>
@endpush
