@extends('admin.master_layout')
@section('title')
    <title>{{ __('Counter') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Create Counter') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.counter.index') }}">{{ __('Counter') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Create Counter') }}</div>
                </div>
            </div>

            <div class="section-body">
                <a class="btn btn-primary" href="{{ route('admin.counter.index') }}"><i class="fas fa-list"></i>
                    {{ __('Counter') }}</a>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.counter.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">

                                        <div class="form-group col-12">
                                            <label>{{ __('Icon') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="icon" type="file">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Title') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" id="title" name="title" type="text">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Number') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="number" type="number">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Status') }} <span class="text-danger">*</span></label>
                                            <select class="form-select" name="status">
                                                <option value="1">{{ __('Active') }}</option>
                                                <option value="0">{{ __('Inactive') }}</option>
                                            </select>
                                        </div>
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
