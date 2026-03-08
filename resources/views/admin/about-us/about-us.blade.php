@extends('admin.master_layout')
@section('title')
    <title>{{ __('About Us') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('About Us') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('About Us') }}</div>
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
                                                href="{{ route('admin.about-us.index', ['code' => $language->code]) }}"><i
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
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-3">
                                        <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">

                                            <li class="nav-item border rounded mb-1">
                                                <a class="nav-link active" id="general-setting-tab" data-bs-toggle="tab"
                                                    href="#generalSettingTab" role="tab"
                                                    aria-controls="generalSettingTab"
                                                    aria-selected="true">{{ __('How It Works') }}</a>
                                            </li>

                                            <li class="nav-item border rounded mb-1">
                                                <a class="nav-link" id="logo-tab" data-bs-toggle="tab" href="#logoTab"
                                                    role="tab" aria-controls="logoTab"
                                                    aria-selected="true">{{ __('About Us') }}</a>
                                            </li>

                                            <li class="nav-item border rounded mb-1">
                                                <a class="nav-link" id="themeColor-tab" data-bs-toggle="tab"
                                                    href="#themeColorTab" role="tab" aria-controls="themeColorTab"
                                                    aria-selected="true">{{ __('Why Choose Us') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-9">
                                        <div class="border rounded">
                                            <div class="tab-content no-padding" id="settingsContent">

                                                <div class="tab-pane fade show active" id="generalSettingTab"
                                                    role="tabpanel" aria-labelledby="general-setting-tab">
                                                    <div class="card m-0">
                                                        <div class="card-body">
                                                            <form action="{{ route('admin.update-header') }}"
                                                                method="POST">
                                                                @method('PUT')
                                                                @csrf
                                                                <input name="code" type="hidden"
                                                                    value="{{ $code }}">
                                                                <div class="form-group">
                                                                    <label
                                                                        for="">{{ __('Header') }}({{ $currentLanguage?->name }})</label>
                                                                    <input class="form-control" name="header"
                                                                        type="text"
                                                                        value="{{ $about->getTranslation($code)->header }}">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label
                                                                        for="">{{ __('Header Description') }}({{ $currentLanguage?->name }})</label>
                                                                    <input class="form-control" name="header_description"
                                                                        type="text"
                                                                        value="{{ $about->getTranslation($code)->header_description }}">
                                                                </div>

                                                                <button class="btn btn-primary"
                                                                    type="submit">{{ __('Update') }}</button>
                                                            </form>

                                                            <hr>
                                                            <h5>{{ __('How It Works Item') }}</h5>
                                                            <hr>
                                                            <table class="table mt-3">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="25%">{{ __('Title') }}</th>
                                                                        <th width="15%">{{ __('Image') }}</th>
                                                                        <th width="40%">{{ __('Description') }}</th>
                                                                        <th width="20%">{{ __('Action') }}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($how_it_works as $how_it_work)
                                                                        <tr>
                                                                            <td>{{ $how_it_work->getTranslation($code)->title }}
                                                                            </td>
                                                                            <td>
                                                                                <img class="w_80"
                                                                                    src="{{ asset($how_it_work->image) }}"
                                                                                    alt="">
                                                                            </td>
                                                                            <td>{{ $how_it_work->getTranslation($code)->description }}
                                                                            </td>
                                                                            <td>
                                                                                <a class="btn btn-danger btn-sm"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#deleteModal"
                                                                                    href="javascript:;"
                                                                                    onclick="deleteHowItWorkData({{ $how_it_work->id }})"><i
                                                                                        class="fa fa-trash"
                                                                                        aria-hidden="true"></i></a>

                                                                                <a class="btn btn-success btn-sm"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#editNewHowItWorkItem-{{ $how_it_work->id }}"
                                                                                    href="javascript:;"><i
                                                                                        class="fas fa-edit"></i> </a>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach

                                                                </tbody>
                                                            </table>

                                                            <button class="btn btn-primary" data-bs-toggle="modal"
                                                                data-bs-target="#addNewHowItWorkItem"><i
                                                                    class="fa fa-plus" aria-hidden="true"></i>
                                                                {{ __('Add New') }}</button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="logoTab" role="tabpanel"
                                                    aria-labelledby="logo-tab">
                                                    <div class="card m-0">
                                                        <div class="card-body">
                                                            <form action="{{ route('admin.update-about-us') }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @method('PUT')
                                                                @csrf
                                                                <input name="code" type="hidden"
                                                                    value="{{ $code }}">
                                                                <div class="form-group">
                                                                    <label
                                                                        for="">{{ __('About Us Title') }}({{ $currentLanguage?->name }})</label>
                                                                    <input class="form-control" name="about_us_title"
                                                                        type="text"
                                                                        value="{{ $about_us_section['about_us_title'] }}">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label
                                                                        for="">{{ __('About Us') }}({{ $currentLanguage?->name }})</label>
                                                                    <textarea class="summernote" id="" name="about_us" cols="30" rows="10">{!! clean($about_us_section['about_us']) !!}</textarea>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label
                                                                        for="">{{ __('Background Image') }}</label>
                                                                    <div>
                                                                        <img class="w_220"
                                                                            src="{{ asset($about_us_section['background_image']) }}"
                                                                            alt="">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label
                                                                        for="">{{ __('New Background') }}</label>
                                                                    <input class="form-control" name="background_image"
                                                                        type="file">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label
                                                                        for="">{{ __('Foreground Image') }}</label>
                                                                    <div>
                                                                        <img class="height_165"
                                                                            src="{{ asset($about_us_section['foreground_image']) }}"
                                                                            alt="">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label
                                                                        for="">{{ __('New Foreground') }}</label>
                                                                    <input class="form-control" name="foreground_image"
                                                                        type="file">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label
                                                                        for="">{{ __('Client Image One') }}</label>
                                                                    <div>
                                                                        <img class="w_70"
                                                                            src="{{ asset($about_us_section['client_image_one']) }}"
                                                                            alt="">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{ __('New Image') }}</label>
                                                                    <input class="form-control" name="client_image_one"
                                                                        type="file">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label
                                                                        for="">{{ __('Client Image Two') }}</label>
                                                                    <div>
                                                                        <img class="w_70"
                                                                            src="{{ asset($about_us_section['client_image_two']) }}"
                                                                            alt="">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{ __('New Image') }}</label>
                                                                    <input class="form-control" name="client_image_two"
                                                                        type="file">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label
                                                                        for="">{{ __('Client Image Three') }}</label>
                                                                    <div>
                                                                        <img class="w_70"
                                                                            src="{{ asset($about_us_section['client_image_three']) }}"
                                                                            alt="">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{ __('New Image') }}</label>
                                                                    <input class="form-control" name="client_image_three"
                                                                        type="file">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">{{ __('Total Rating') }}</label>
                                                                    <input class="form-control" name="total_rating"
                                                                        type="text"
                                                                        value="{{ $about_us_section['total_rating'] }}">
                                                                </div>

                                                                <button class="btn btn-primary"
                                                                    type="submit">{{ __('Update') }}</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="themeColorTab" role="tabpanel"
                                                    aria-labelledby="themeColor-tab">
                                                    <div class="card m-0">
                                                        <div class="card-body">
                                                            <form action="{{ route('admin.update-why-choose-use') }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')

                                                                <input name="code" type="hidden"
                                                                    value="{{ $code }}">
                                                                <div class="form-group">
                                                                    <label
                                                                        for="">{{ __('Title') }}({{ $currentLanguage?->name }})</label>
                                                                    <input class="form-control" name="why_choose_us_title"
                                                                        type="text"
                                                                        value="{{ $why_choose_us['why_choose_us_title'] }}">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label
                                                                        for="">{{ __('Description') }}({{ $currentLanguage?->name }})</label>
                                                                    <textarea class="summernote" id="" name="why_choose_desciption" cols="30" rows="10">{!! clean($why_choose_us['why_choose_desciption']) !!}</textarea>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label
                                                                        for="">{{ __('Background Image') }}</label>
                                                                    <div>
                                                                        <img class="w_220"
                                                                            src="{{ asset($why_choose_us['background_image']) }}"
                                                                            alt="">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label
                                                                        for="">{{ __('New Background') }}</label>
                                                                    <input class="form-control" name="background_image"
                                                                        type="file">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label
                                                                        for="">{{ __('Foreground Image') }}</label>
                                                                    <div>
                                                                        <img class="w_220"
                                                                            src="{{ asset($why_choose_us['foreground_image']) }}"
                                                                            alt="">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label
                                                                        for="">{{ __('New Foreground') }}</label>
                                                                    <input class="form-control" name="foreground_image"
                                                                        type="file">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label
                                                                        for="">{{ __('Item One') }}({{ $currentLanguage?->name }})</label>
                                                                    <input class="form-control" name="item_one"
                                                                        type="text"
                                                                        value="{{ $why_choose_us['item_one'] }}">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label
                                                                        for="">{{ __('Description One') }}({{ $currentLanguage?->name }})</label>
                                                                    <textarea class="form-control text-area-3" id="" name="description_one" cols="30" rows="10">{{ $why_choose_us['description_one'] }}</textarea>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label
                                                                        for="">{{ __('Item Two') }}({{ $currentLanguage?->name }})</label>
                                                                    <input class="form-control" name="item_two"
                                                                        type="text"
                                                                        value="{{ $why_choose_us['item_two'] }}">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label
                                                                        for="">{{ __('Description Two') }}({{ $currentLanguage?->name }})</label>
                                                                    <textarea class="form-control text-area-3" id="" name="description_two" cols="30" rows="10">{{ $why_choose_us['description_two'] }}</textarea>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label
                                                                        for="">{{ __('Item Three') }}({{ $currentLanguage?->name }})</label>
                                                                    <input class="form-control" name="item_three"
                                                                        type="text"
                                                                        value="{{ $why_choose_us['item_three'] }}">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label
                                                                        for="">{{ __('Description Three') }}({{ $currentLanguage?->name }})</label>
                                                                    <textarea class="form-control text-area-3" id="" name="description_three" cols="30" rows="10">{{ $why_choose_us['description_three'] }}</textarea>
                                                                </div>

                                                                <button class="btn btn-primary"
                                                                    type="submit">{{ __('Update') }}</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>

    <x-admin.delete-modal />

    <!-- Modal -->
    <div class="modal fade" id="addNewHowItWorkItem" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Add New') }}</h4>
                    <button class="btn btn-danger" data-dismiss="modal" type="button" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addNewHowItWorkItemForm" action="{{ route('admin.store-how-it-work') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-input mb-3">
                            <label class="form-label" for="add-image">{{ __('Image') }} <span
                                    class="text-danger">*</span></label>
                            <input class="form-control" id="add-image" name="image" type="file">
                        </div>

                        <div class="form-input mb-3">
                            <label class="form-label" for="add-title">{{ __('Title') }} <span
                                    class="text-danger">*</span></label>
                            <input class="form-control" id="add-title" name="title" type="text">
                        </div>

                        <div class="form-input">
                            <label class="form-label" for="add-description">{{ __('Description') }} <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control text-area-5" id="add-description" name="description" cols="30" rows="10"></textarea>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal" type="button">{{ __('Close') }}</button>
                    <button class="btn btn-primary" form="addNewHowItWorkItemForm"
                        type="submit">{{ __('Save') }}</button>
                </div>
            </div>
        </div>
    </div>

    @foreach ($how_it_works as $how_it_work)
        <div class="modal fade" id="editNewHowItWorkItem-{{ $how_it_work->id }}" role="dialog"
            aria-labelledby="modelTitleId" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Edit Item') }}</h5>
                        <button class="btn btn-danger" data-dismiss="modal" type="button" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form action="{{ route('admin.update-how-it-work', $how_it_work->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input name="code" type="hidden" value="{{ $code }}">
                                <div class="form-group">
                                    <label for="">{{ __('Existing Image') }}</label>
                                    <div>
                                        <img class="w_80" src="{{ asset($how_it_work->image) }}" alt="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">{{ __('Image') }}</label>
                                    <input class="form-control" name="image" type="file">
                                </div>

                                <div class="form-group">
                                    <label for="">{{ __('Title') }}({{ $currentLanguage?->name }})</label>
                                    <input class="form-control" name="title" type="text"
                                        value="{{ $how_it_work->getTranslation($code)->title }}">
                                </div>

                                <div class="form-group">
                                    <label
                                        for="">{{ __('Description') }}({{ $currentLanguage?->name }})</label>
                                    <textarea class="form-control text-area-5" id="" name="description" cols="30" rows="10">{{ $how_it_work->getTranslation($code)->description }}</textarea>
                                </div>
                                <button class="btn btn-danger" data-dismiss="modal"
                                    type="button">{{ __('Close') }}</button>
                                <button class="btn btn-primary" type="submit">{{ __('Update') }}</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('js')
    <script>
        "use strict";

        function deleteHowItWorkData(id) {
            $("#deleteForm").attr("action", "{{ url('admin/delete-how-it-work/') }}" + "/" + id)
        }
    </script>
@endpush
