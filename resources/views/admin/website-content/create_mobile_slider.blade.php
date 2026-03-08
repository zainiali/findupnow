@extends('admin.master_layout')
@section('title')
    <title>{{ __('Create mobile slider') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Create mobile slider') }}</h1>

            </div>

            <div class="section-body">

                <a class="btn btn-primary" href="{{ route('admin.mobile-slider.index') }}"><i class="fas fa-list"></i>
                    {{ __('Slider List') }}</a>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.mobile-slider.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">

                                        <div class="form-group col-12">
                                            <label>{{ __('Image') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="image" type="file">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Title one') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="title_one" type="text">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Title two') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="title_two" type="text">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Serial') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="serial" type="number">
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
