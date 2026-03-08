@extends('admin.master_layout')
@section('title')
    <title>{{ __('Testimonial') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Edit Testimonial') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.testimonial.index') }}">{{ __('Testimonial') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Edit Testimonial') }}</div>
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
                                                href="{{ route('admin.testimonial.edit', ['testimonial' => $testimonial->id, 'code' => $language->code]) }}"><i
                                                    class="fas {{ request('code', $code) == $language->code ? 'fa-eye' : 'fa-edit' }}"></i>
                                                {{ $language->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>

                            @php
                                $currentLanguage = $languages->where('code', request()->get('code', $code))->first();
                            @endphp
                            @if ($currentLanguage)
                                <div class="mt-2 alert alert-danger" role="alert">
                                    <p>{{ __('Your editing mode') }} :
                                        <b>{{ $currentLanguage?->name }}</b>
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-body">
                <a class="btn btn-primary" href="{{ route('admin.testimonial.index') }}"><i class="fas fa-list"></i>
                    {{ __('Testimonial') }}</a>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.testimonial.update', $testimonial->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input name="code" type="hidden" value="{{ $code }}">
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>{{ __('Existing Image') }}</label>
                                            <div>
                                                <img src="{{ asset($testimonial->image) }}" alt="" width="150px">
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="image">{{ __('Image') }} <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" id="image" name="image" type="file">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Name') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" id="name" name="name" type="text"
                                                value="{{ $testimonial->getTranslation($code)?->name }}">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Desgination') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" id="designation" name="designation" type="text"
                                                value="{{ $testimonial->getTranslation($code)?->designation }}">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Comment') }} <span class="text-danger">*</span></label>
                                            <textarea class="form-control text-area-5" id="comment" name="comment" cols="30" rows="10">{{ $testimonial->getTranslation($code)?->comment }}</textarea>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Status') }} <span class="text-danger">*</span></label>
                                            <select class="form-select" name="status">
                                                <option value="1" {{ $testimonial->status == 1 ? 'selected' : '' }}>
                                                    {{ __('Active') }}</option>
                                                <option value="0" {{ $testimonial->status == 0 ? 'selected' : '' }}>
                                                    {{ __('Inactive') }}</option>
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
@endsection
