@extends('admin.master_layout')
@section('title')
    <title>{{ __('Mobile App') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Mobile App') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Mobile App') }}</div>
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
                                                href="{{ route('admin.mobile-app', ['code' => $language->code]) }}"><i
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
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.update-mobile-app') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <input name="code" type="hidden" value="{{ $code }}">

                                    @if ($selected_theme == 0 || $selected_theme == 1)
                                        <div class="col-12">
                                            <h6 class="home_border">{{ __('Home One') }}</h6>
                                            <hr>
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('Existing Image') }}</label>
                                            <div>
                                                <img class="w_120" src="{{ asset($mobile_app->image) }}" alt="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('New Image') }}</label>
                                            <input class="form-control" name="image" type="file">
                                        </div>
                                    @endif

                                    @if ($selected_theme == 0 || $selected_theme == 2)
                                        <div class="col-12">
                                            <h6 class="home_border">{{ __('Home Two') }}</h6>
                                            <hr>
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('Existing Image') }}</label>
                                            <div>
                                                <img class="w_120" src="{{ asset($mobile_app->home2_app_image) }}"
                                                    alt="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('New Image') }}</label>
                                            <input class="form-control" name="image2" type="file">
                                        </div>
                                    @endif

                                    @if ($selected_theme == 0 || $selected_theme == 3)
                                        <div class="col-12">
                                            <h6 class="home_border">{{ __('Home Three') }}</h6>
                                            <hr>
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('Existing Image') }}</label>
                                            <div>
                                                <img class="w_120" src="{{ asset($mobile_app->home3_app_image) }}"
                                                    alt="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('New Image') }}</label>
                                            <input class="form-control" name="image3" type="file">
                                        </div>

                                        <div class="col-12">
                                            <hr>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">{{ __('Short Title') }}
                                            {{ '(' . $currentLanguage?->name . ')' }}</label>
                                        <input class="form-control" name="short_title" type="text"
                                            value="{{ $mobile_app->short_title }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('Title') }}
                                            {{ '(' . $currentLanguage?->name . ')' }}</label>
                                        <input class="form-control" name="full_title" type="text"
                                            value="{{ $mobile_app->full_title }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('Description') }}
                                            {{ '(' . $currentLanguage?->name . ')' }}</label>
                                        <textarea class="form-control text-area-5" id="" name="description" cols="30" rows="10">{{ $mobile_app->description }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('Google Play Store Link') }}</label>
                                        <input class="form-control" name="play_store" type="text"
                                            value="{{ $mobile_app->play_store }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('App Store Link') }}</label>
                                        <input class="form-control" name="app_store" type="text"
                                            value="{{ $mobile_app->app_store }}">
                                    </div>

                                    <button class="btn btn-primary" type="submit">{{ __('Update') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
