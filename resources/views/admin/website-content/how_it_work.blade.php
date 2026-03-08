@extends('admin.master_layout')
@section('title')
    <title>{{ __('How It Work') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('How It Work') }}</h1>

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
                                                href="{{ route('admin.how-it-work', ['code' => $language->code]) }}"><i
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
                                <form action="{{ route('admin.home-update-how-it-work') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <input name="code" type="hidden" value="{{ $code }}">

                                    <div class="form-group">
                                        <label for="">{{ __('Background Banner') }}</label>
                                        <div>
                                            <img class="w_200" src="{{ asset($how_it_work->background) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('New Background') }}</label>
                                        <input class="form-control" name="background_image" type="file">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('Foreground Image') }}</label>
                                        <div>
                                            <img class="w_120" src="{{ asset($how_it_work->foreground) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('New Foreground') }}</label>
                                        <input class="form-control" name="image" type="file">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('Title') }} ({{ $currentLanguage?->name }})<span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" name="title" type="text"
                                            value="{{ $how_it_work->title }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('Description') }} ({{ $currentLanguage?->name }})<span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" name="description" type="text"
                                            value="{{ $how_it_work->description }}">
                                    </div>

                                    <div id="item_box">
                                        @foreach ($how_it_work->items as $item)
                                            <div class="row how_it_work_item my-3">
                                                <div class="col-md-10">
                                                    <div class="form-group">
                                                        <label class="form-label" for="">{{ __('Title') }}
                                                            ({{ $currentLanguage?->name }})
                                                            <span
                                                                class="text-danger">*</span></label>
                                                        <input class="form-control" name="titles[]" type="text"
                                                            value="{{ $item->title }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="btn btn-danger plus_btn removeItem" type="button"> <i
                                                            class="fa fa-trash" aria-hidden="true"></i>
                                                        {{ __('Remove') }} </button>
                                                </div>

                                                <div class="col-md-12">
                                                    <label class="form-label" for="">{{ __('Description') }}
                                                        ({{ $currentLanguage?->name }})</label>
                                                    <textarea class="form-control text-area-5" id="" name="descriptions[]" cols="30" rows="10">{{ $item->description }}</textarea>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label for="">{{ __('Title') }}
                                                        ({{ $currentLanguage?->name }})<span
                                                            class="text-danger">*</span></label>
                                                    <input class="form-control" name="titles[]" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-primary plus_btn addNewItem" type="button"> <i
                                                        class="fa fa-plus" aria-hidden="true"></i>
                                                    {{ __('Add New') }} </button>
                                            </div>

                                            <div class="col-md-12">
                                                <label
                                                    for="">{{ __('Description') }}({{ $currentLanguage?->name }})</label>
                                                <textarea class="form-control text-area-5" id="" name="descriptions[]" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>

                                    </div>

                                    <button class="btn btn-primary mt-3" type="submit">{{ __('Update') }}</button>
                                </form>
                            </div>
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
                $(".addNewItem").on("click", function(e) {
                    e.preventDefault();
                    let html = `
                    <div class="row how_it_work_item mt-3">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="" class="form-label">{{ __('Title') }} ({{ $currentLanguage?->name }})<span class="text-danger">*</span></label>
                                <input type="text" name="titles[]" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger plus_btn removeItem"> <i class="fa fa-trash" aria-hidden="true"></i> {{ __('Remove') }} </button>
                        </div>

                        <div class="col-md-12">
                            <label for="" class="form-label">{{ __('Description') }}({{ $currentLanguage?->name }})</label>
                            <textarea name="descriptions[]" class="form-control text-area-5" id="" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                `;
                    $("#item_box").append(html);
                })

                $(document).on('click', '.removeItem', function() {
                    $(this).closest('.how_it_work_item').remove();
                });

            });
        })(jQuery);
    </script>
@endsection
