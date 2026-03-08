@extends('admin.master_layout')
@section('title')
    <title>{{ __('Edit mobile slider') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Edit mobile slider') }}</h1>

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
                                                href="{{ route('admin.mobile-slider.edit', ['mobile_slider' => $slider->id, 'code' => $language->code]) }}"><i
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
                <a class="btn btn-primary" href="{{ route('admin.mobile-slider.index') }}"><i class="fas fa-list"></i>
                    {{ __('Slider List') }}</a>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.mobile-slider.update', $slider->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input name="code" type="hidden" value="{{ $code }}">
                                    <div class="row">

                                        <div class="form-group col-12">
                                            <label>{{ __('Existing Image') }}</label>
                                            <div>
                                                <img class="mobile_slider_image" src="{{ asset($slider->image) }}"
                                                    alt="">
                                            </div>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Image') }} </label>
                                            <input class="form-control" name="image" type="file">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Title one') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="title_one" type="text"
                                                value="{{ $slider->getTranslation($code)?->title_one }}">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Title two') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="title_two" type="text"
                                                value="{{ $slider->getTranslation($code)?->title_two }}">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Serial') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="serial" type="number"
                                                value="{{ $slider->serial }}">
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
