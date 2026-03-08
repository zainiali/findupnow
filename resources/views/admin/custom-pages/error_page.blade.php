@extends('admin.master_layout')
@section('title')
    <title>{{ __('Error Page') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Error Page') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Error Page') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-3">
                                    <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                                        @foreach ($errorPages as $index => $errorPage)
                                            <li class="nav-item border rounded mb-1">
                                                <a class="nav-link {{ $index == 0 ? 'active' : '' }}"
                                                    id="error-tab-{{ $errorPage->id }}" data-bs-toggle="tab"
                                                    href="#errorTab-{{ $errorPage->id }}" role="tab"
                                                    aria-controls="errorTab-{{ $errorPage->id }}"
                                                    aria-selected="true">{{ $errorPage->page_name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-12 col-sm-12 col-md-9">
                                    <div class="border rounded">
                                        <div class="tab-content no-padding" id="settingsContent">
                                            @foreach ($errorPages as $index => $errorpage)
                                                <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}"
                                                    id="errorTab-{{ $errorpage->id }}" role="tabpanel"
                                                    aria-labelledby="error-tab-{{ $errorpage->id }}">
                                                    <div class="card m-0">
                                                        <div class="card-body">
                                                            <form
                                                                action="{{ route('admin.error-page.update', $errorpage->id) }}"
                                                                method="POST">
                                                                @method('PATCH')
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="">{{ __('Page Name') }}</label>
                                                                            <input class="form-control" name="page_name"
                                                                                type="text"
                                                                                value="{{ $errorpage->page_name }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="">{{ __('Page Number') }}</label>
                                                                            <input class="form-control" name="page_number"
                                                                                type="text"
                                                                                value="{{ $errorpage->page_number }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="">{{ __('Header') }}</label>
                                                                            <input class="form-control" name="header"
                                                                                type="text"
                                                                                value="{{ $errorpage->header }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="">{{ __('Button Text') }}</label>
                                                                            <input class="form-control" name="button_text"
                                                                                type="text"
                                                                                value="{{ $errorpage->button_text }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="">{{ __('Description') }}</label>
                                                                            <textarea class="form-control text-area-5" id="" name="description" cols="30" rows="5">{{ $errorpage->description }}</textarea>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <button class="btn btn-primary"
                                                                    type="submit">{{ __('Update') }}</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
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
@endsection
