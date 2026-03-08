@extends('admin.master_layout')
@section('title')
    <title>{{ __('Counter') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Edit Counter') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.counter.index') }}">{{ __('Counter') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Edit Counter') }}</div>
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
                                                href="{{ route('admin.counter.edit', ['counter' => $counter->id, 'code' => $language->code]) }}"><i
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
                <a class="btn btn-primary" href="{{ route('admin.counter.index') }}"><i class="fas fa-list"></i>
                    {{ __('Counter') }}</a>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.counter.update', $counter->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input name="code" type="hidden" value="{{ $code }}">
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>{{ __('Existing Icon') }}</label>
                                            <div>
                                                <img class="w_80" src="{{ asset($counter->icon) }}" alt="">
                                            </div>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Icon') }}</label>
                                            <input class="form-control" name="icon" type="file">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Title') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" id="title" name="title" type="text"
                                                value="{{ $counter->getTranslation($code)->title }}">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Number') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="number" type="number"
                                                value="{{ $counter->number }}">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Status') }} <span class="text-danger">*</span></label>
                                            <select class="form-select" name="status">
                                                <option value="1" {{ $counter->status == 1 ? 'selected' : '' }}>
                                                    {{ __('Active') }}</option>
                                                <option value="0" {{ $counter->status == 0 ? 'selected' : '' }}>
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
