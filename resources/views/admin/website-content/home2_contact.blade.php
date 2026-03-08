@extends('admin.master_layout')
@section('title')
    <title>{{ __('Home page 2 contact section') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Home page 2 contact section') }}</h1>
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
                                                href="{{ route('admin.home2-contact', ['code' => $language->code]) }}"><i
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
                                <form action="{{ route('admin.update-home2-contact') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <input name="code" type="hidden" value="{{ $code }}">
                                    <div class="form-group">
                                        <label for="">{{ __('Background Banner') }}</label>
                                        <div>
                                            <img class="w_200" src="{{ asset($contact->background) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('New Background') }}</label>
                                        <input class="form-control" name="background_image" type="file">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('Foreground Image') }}</label>
                                        <div>
                                            <img class="w_120" src="{{ asset($contact->foreground) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('New Foreground') }}</label>
                                        <input class="form-control" name="image" type="file">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('Call as now') }} ({{ $currentLanguage?->name }})<span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" name="call_as_now" type="text"
                                            value="{{ $contact->call_as_now }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('Phone') }} <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" name="phone" type="text"
                                            value="{{ $contact->phone }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('Available time') }}
                                            ({{ $currentLanguage?->name }})<span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" name="available_time" type="text"
                                            value="{{ $contact->available_time }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('Form title') }} ({{ $currentLanguage?->name }})<span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" name="form_title" type="text"
                                            value="{{ $contact->form_title }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('Form Description') }}
                                            ({{ $currentLanguage?->name }})<span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control text-area-5" id="" name="form_description" cols="30" rows="10">{{ $contact->form_description }}</textarea>
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
