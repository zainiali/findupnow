@extends('admin.master_layout')
@section('title')
    <title>{{ __('FAQ') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Edit FAQ') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item active"><a href="{{ route('admin.faq.index') }}">{{ __('FAQ') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Edit FAQ') }}</div>
                </div>
            </div>

            <div class="section-body row">
                <div class="col-12">
                    <div class="card">
                        <div
                            class="card-header gap-3 justify-content-between align-items-center">
                            <h5 class="m-0 service_card">{{ __('Available Translations') }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="lang_list_top">
                                <ul class="lang_list">
                                    @foreach ($languages as $language)
                                        <li><a id="{{ request('code', $code) == $language->code ? 'selected-language' : '' }}"
                                                href="{{ route('admin.faq.edit', ['code' => $language->code, 'faq' => $faq->id]) }}"><i
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
                <a class="btn btn-primary" href="{{ route('admin.faq.index') }}"><i class="fas fa-list"></i>
                    {{ __('FAQ') }}</a>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.faq.update', $faq->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input name="code" type="hidden" value="{{ $code }}">
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>{{ __('Question') }} ({{ $currentLanguage?->name }})<span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" id="question" name="question" type="text"
                                                value="{{ $faq->getTranslation($code)?->question }}">
                                        </div>
                                        <div class="form-group col-12">
                                            <label>{{ __('Answer') }} ({{ $currentLanguage?->name }})<span
                                                    class="text-danger">*</span></label>
                                            <textarea class="summernote" id="" name="answer" cols="30" rows="10">{{ $faq->getTranslation($code)?->answer }}</textarea>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>{{ __('Status') }} <span class="text-danger">*</span></label>
                                            <select class="form-control" name="status">
                                                <option value="1" {{ $faq->status == 1 ? 'selected' : '' }}>
                                                    {{ __('Active') }}</option>
                                                <option value="0" {{ $faq->status == 0 ? 'selected' : '' }}>
                                                    {{ __('Inactive') }}</option>
                                            </select>
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
@endsection
