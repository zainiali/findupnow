@extends('admin.master_layout')
@section('title')
    <title>{{ __('Footer') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Footer') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Footer') }}</div>
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
                                                href="{{ route('admin.footer.index', ['code' => $language->code]) }}"><i
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
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.footer.update', $footer->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input name="code" type="hidden" value="{{ $code }}">
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>{{ __('About Us') }} ({{ $currentLanguage?->name }})<span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control text-area-5" id="" name="about_us" cols="30" rows="10">{{ $footer->getTranslation($code)->about_us }}</textarea>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Email') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="email" type="email"
                                                value="{{ $footer->email }}">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Phone') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="phone" type="text"
                                                value="{{ $footer->phone }}">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Address') }} ({{ $currentLanguage?->name }})<span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" name="address" type="text"
                                                value="{{ $footer->getTranslation($code)->address }}">
                                        </div>
                                        <div class="form-group col-12">
                                            <label>{{ __('Existing Image') }}</label>
                                            <div>
                                                <img src="{{ asset($footer->payment_image) }}" alt=""
                                                    width="220px">
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>{{ __('Payment Card Image') }}</label>
                                            <input class="form-control" name="card_image" type="file">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Copyright') }} ({{ $currentLanguage?->name }})<span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" name="copyright" type="text"
                                                value="{{ $footer->getTranslation($code)->copyright }}">
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
