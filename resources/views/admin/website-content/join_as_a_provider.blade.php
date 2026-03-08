@extends('admin.master_layout')
@section('title')
    <title>{{ __('Join as a Provider') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Join as a Provider') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Join as a Provider') }}</div>
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
                                                href="{{ route('admin.join-as-a-provider', ['code' => $language->code]) }}"><i
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
                                <form action="{{ route('admin.update-join-as-a-provider') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <input name="code" type="hidden" value="{{ $code }}">

                                    @if ($selected_theme == 0 || $selected_theme == 1)
                                        <div>
                                            <h6 class="home_border">{{ __('Home One') }}</h6>
                                            <hr>
                                        </div>
                                        <div class="form-group">
                                            <label for="">{{ __('Existing Banner') }}</label>
                                            <div>
                                                <img src="{{ asset($join_as_a_provider->image) }}" alt=""
                                                    width="200px">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('New Banner') }}</label>
                                            <input class="form-control" name="image" type="file">
                                        </div>
                                    @endif

                                    @if ($selected_theme == 0 || $selected_theme == 2)
                                        <div>
                                            <h6 class="home_border">{{ __('Home Two') }}</h6>
                                            <hr>
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('Existing Banner') }}</label>
                                            <div>
                                                <img src="{{ asset($join_as_a_provider->home2_image) }}" alt=""
                                                    width="200px">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('New Banner') }}</label>
                                            <input class="form-control" name="image2" type="file">
                                        </div>
                                    @endif

                                    @if ($selected_theme == 0 || $selected_theme == 3)
                                        <div>
                                            <h6 class="home_border">{{ __('Home Three') }}</h6>
                                            <hr>
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('Existing Banner') }}</label>
                                            <div>
                                                <img src="{{ asset($join_as_a_provider->home3_image) }}" alt=""
                                                    width="200px">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('New Banner') }}</label>
                                            <input class="form-control" name="image3" type="file">
                                        </div>

                                        <div>
                                            <hr>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">{{ __('Title') }}
                                            {{ '(' . $currentLanguage?->name . ')' }}</label>
                                        <input class="form-control" name="title" type="text"
                                            value="{{ $join_as_a_provider->title }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">{{ __('Button Text') }}
                                            {{ '(' . $currentLanguage?->name . ')' }}</label>
                                        <input class="form-control" name="button_text" type="text"
                                            value="{{ $join_as_a_provider->button_text }}">
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
