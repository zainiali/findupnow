@extends('admin.master_layout')
@section('title')
    <title>{{ __('Edit Partner') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Edit Partner') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.partner.index') }}">{{ __('Partner List') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Edit Partner') }}</div>
                </div>
            </div>

            <div class="section-body">
                <a class="btn btn-primary" href="{{ route('admin.partner.index') }}"><i class="fas fa-list"></i>
                    {{ __('Partner List') }}</a>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.partner.update', $partner->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">

                                        <div class="form-group col-12">
                                            <label>{{ __('Existing Logo') }}</label>
                                            <div>
                                                <img src="{{ asset($partner->logo) }}" alt="" width="100px">
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>{{ __('Logo') }}</label>
                                            <input class="form-control" name="logo" type="file">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Link') }} </label>
                                            <input class="form-control" id="link" name="link" type="text"
                                                value="{{ $partner->link }}">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Status') }} <span class="text-danger">*</span></label>
                                            <select class="form-select" name="status">
                                                <option value="1" {{ $partner->status == 1 ? 'selected' : '' }}>
                                                    {{ __('Active') }}</option>
                                                <option value="0" {{ $partner->status == 0 ? 'selected' : '' }}>
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
