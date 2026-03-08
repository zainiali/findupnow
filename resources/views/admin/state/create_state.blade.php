@extends('admin.master_layout')
@section('title')
    <title>{{ __('State / Province') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Create State / Province') }}</h1>

            </div>

            <div class="section-body">
                <a class="btn btn-primary" href="{{ route('admin.state.index') }}"><i class="fas fa-list"></i>
                    {{ __('State / Province') }}</a>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.state.store') }}" method="POST">
                                    @csrf
                                    <div class="row">

                                        <div class="form-group col-12">
                                            <label>{{ __('Country / Region') }} <span class="text-danger">*</span></label>
                                            <select class="form-control select2" id="" name="country">
                                                <option value="">{{ __('Select') }}</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('State / Province') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" id="name" name="name" type="text">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Status') }} <span class="text-danger">*</span></label>
                                            <select class="form-control" name="status">
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
