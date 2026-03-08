@extends('admin.master_layout')
@section('title')
    <title>{{ __('Intro section') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Intro section') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Intro section') }}</div>
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
                                                href="{{ route('admin.slider.index', ['code' => $language->code]) }}"><i
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
                                <form
                                    action="{{ route('admin.slider.update', ['slider' => $slider->id, 'code' => $code]) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">

                                        <input name="code" type="hidden" value="{{ $code }}">
                                        @if ($selected_theme == 0 || $selected_theme == 1)
                                            <div class="col-12">
                                                <h6 class="home_border">{{ __('Home One') }}</h6>
                                                <hr>
                                            </div>

                                            <div class="form-group col-12">
                                                <label>{{ __('Existing Image') }}</label>
                                                <div>
                                                    <img class="w_120" src="{{ asset($slider->image) }}" alt="">
                                                </div>
                                            </div>

                                            <div class="form-group col-12">
                                                <label>{{ __('New Image') }}</label>
                                                <input class="form-control" name="image" type="file">
                                            </div>
                                        @endif

                                        @if ($selected_theme == 0 || $selected_theme == 2)
                                            <div class="col-12">
                                                <h6 class="home_border">{{ __('Home Two') }}</h6>
                                                <hr>
                                            </div>

                                            <div class="form-group col-12">
                                                <label>{{ __('Existing Image') }}</label>
                                                <div>
                                                    <img class="w_200" src="{{ asset($slider->home2_image) }}"
                                                        alt="">
                                                </div>
                                            </div>

                                            <div class="form-group col-12">
                                                <label>{{ __('New Image') }}</label>
                                                <input class="form-control" name="image2" type="file">
                                            </div>
                                        @endif

                                        @if ($selected_theme == 0 || $selected_theme == 3)
                                            <div class="col-12">
                                                <h6 class="home_border">{{ __('Home Three') }}</h6>
                                                <hr>
                                            </div>

                                            <div class="form-group col-12">
                                                <label>{{ __('Existing Image') }}</label>
                                                <div>
                                                    <img class="w_200" src="{{ asset($slider->home3_image) }}"
                                                        alt="">
                                                </div>
                                            </div>

                                            <div class="form-group col-12">
                                                <label>{{ __('New Image') }}</label>
                                                <input class="form-control" name="image3" type="file">
                                            </div>

                                            <div class="col-12">
                                                <hr>
                                            </div>
                                        @endif

                                        <div class="form-group col-12">
                                            <label>{{ __('Title') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="title" type="text"
                                                value="{{ $slider->getTranslation($code)?->title }}">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Header One') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="header_one" type="text"
                                                value="{{ $slider->getTranslation($code)?->header_one }}">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Header Two') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="header_two" type="text"
                                                value="{{ $slider->getTranslation($code)?->header_two }}">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Description') }} <span class="text-danger">*</span></label>
                                            <textarea class="form-control text-area-3" id="" name="description" cols="30" rows="3">{{ $slider->getTranslation($code)?->description }}</textarea>
                                        </div>

                                        <div
                                            class="form-group col-12 {{ $selected_theme == 0 || $selected_theme == 1 ? '' : 'd-none' }}">
                                            <label>{{ __('Total sold service') }} <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" name="total_service_sold" type="text"
                                                value="{{ $slider->getTranslation($code)?->total_service_sold }}">
                                        </div>

                                        @if ($selected_theme == 0 || $selected_theme == 3)
                                            <div class="form-group col-12">
                                                <label>{{ __('Popular search tag for home3') }} </label>
                                                <input class="form-control tags" name="popular_tag" type="text"
                                                    value="{{ $slider->popular_tag }}">
                                            </div>
                                        @endif

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
