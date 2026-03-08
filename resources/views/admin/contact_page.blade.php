@extends('admin.master_layout')
@section('title')
    <title>{{ __('Conact Us') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Conact Us') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Conact Us') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @if ($contact)
                                    <form action="{{ route('admin.contact-us.update', $contact->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="form-group col-12">
                                                <label>{{ __('Supporter Image') }}</label>
                                                <div>
                                                    <img src="{{ asset($contact->supporter_image) }}" alt=""
                                                        width="200px">
                                                </div>
                                            </div>
                                            <div class="form-group col-12">
                                                <label>{{ __('New Image') }}</label>
                                                <input class="form-control" id="slug" name="supporter_image"
                                                    type="file">
                                            </div>

                                            <div class="form-group col-12">
                                                <label>{{ __('Email') }} <span class="text-danger">*</span></label>
                                                <textarea class="form-control text-area-5" name="email" cols="30" rows="10">{{ $contact->email }}</textarea>
                                            </div>

                                            <div class="form-group col-12">
                                                <label>{{ __('Phone') }} <span class="text-danger">*</span></label>
                                                <textarea class="form-control text-area-5" name="phone" cols="30" rows="10">{{ $contact->phone }}</textarea>
                                            </div>

                                            <div class="form-group col-12">
                                                <label>{{ __('Address') }} <span class="text-danger">*</span></label>
                                                <textarea class="form-control text-area-5" name="address" cols="30" rows="10">{{ $contact->address }}</textarea>
                                            </div>

                                            <div class="form-group col-12">
                                                <label>{{ __('Support Time') }} <span
                                                        class="text-danger">*</span></label>
                                                <input class="form-control" name="support_time" type="text"
                                                    value="{{ $contact->support_time }}">
                                            </div>

                                            <div class="form-group col-12">
                                                <label>{{ __('Off Day') }} <span class="text-danger">*</span></label>
                                                <input class="form-control" name="off_day" type="text"
                                                    value="{{ $contact->off_day }}">
                                            </div>

                                            <div class="form-group col-12">
                                                <label>{{ __('Google Map') }} <span
                                                        class="text-danger">*</span></label>
                                                <textarea class="form-control text-area-5" name="google_map" cols="30" rows="10">{{ $contact->map }}</textarea>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <button class="btn btn-primary">{{ __('Update') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <form action="{{ route('admin.contact-us.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-12">
                                                <label>{{ __('Banner Image') }}</label>
                                                <input class="form-control" id="slug" name="banner_image"
                                                    type="file">
                                            </div>

                                            <div class="form-group col-12">
                                                <label>{{ __('Email') }} <span class="text-danger">*</span></label>
                                                <input class="form-control" name="email" type="email">
                                            </div>

                                            <div class="form-group col-12">
                                                <label>{{ __('Phone') }} <span class="text-danger">*</span></label>
                                                <input class="form-control" name="phone" type="text">
                                            </div>

                                            <div class="form-group col-12">
                                                <label>{{ __('Address') }} <span class="text-danger">*</span></label>
                                                <input class="form-control" name="address" type="text">
                                            </div>

                                            <div class="form-group col-12">
                                                <label>{{ __('Title') }} <span class="text-danger">*</span></label>
                                                <input class="form-control" name="title" type="text">
                                            </div>

                                            <div class="form-group col-12">
                                                <label>{{ __('Description') }} <span
                                                        class="text-danger">*</span></label>
                                                <textarea class="form-control text-area-5" name="description" cols="30" rows="10"></textarea>
                                            </div>

                                            <div class="form-group col-12">
                                                <label>{{ __('Google Map') }} <span
                                                        class="text-danger">*</span></label>
                                                <textarea class="form-control text-area-5" name="google_map" cols="30" rows="10"></textarea>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <button class="btn btn-primary">{{ __('Save') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
