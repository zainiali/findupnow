@extends('admin.master_layout')
@section('title')
    <title>{{ __('Section Content') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
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
                                    <li><a id="{{ request('code', $code) == $language->code ? 'selected-language' : '' }}"
                                            href="{{ route('admin.section-content', ['code' => $language->code]) }}"><i
                                                class="fas {{ request('code', $code) == $language->code ? 'fa-eye' : 'fa-edit' }}"></i>
                                            {{ $language->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="mt-2 alert alert-danger" role="alert">
                            @php
                                $currentLanguage = $languages->where('code', request()->get('code', $code))->first();
                            @endphp
                            <p>{{ __('Your editing mode') }} :
                                <b>{{ $currentLanguage?->name }}</b>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Section Content') }}</h1>
            </div>

            @foreach ($contents as $content)
                <div class="section-body">
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="home_border">{{ $content->section_name }}</h5>
                                    <hr>
                                    <form
                                        action="{{ route('admin.update-section-content', ['id' => $content->id, 'code' => $code]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <input name="code" type="hidden" value="{{ $code }}">
                                            <div class="form-group col-12">
                                                <label>{{ __('Title') }} <span class="text-danger">*</span></label>
                                                <input class="form-control" name="title" type="text"
                                                    value="{{ $content->getTranslation($code)?->title }}">
                                            </div>
                                            <div class="form-group col-12">
                                                <label>{{ __('Description') }} <span class="text-danger">*</span></label>
                                                <textarea class="form-control text-area-3" id="" name="description" cols="30" rows="3">{{ $content->getTranslation($code)?->description }}</textarea>
                                            </div>

                                            <div class="col-12">
                                                <button class="btn btn-primary">{{ __('Save') }}</button>
                                            </div>

                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
        </section>
    </div>
@endsection
