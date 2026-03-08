@extends('website.provider.master_layout')
@section('title')
    <title>{{ __('Create Appointment Schedule') }}</title>
@endsection
@section('provider-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Create Appointment Schedule') }}</h1>
            </div>

            <div class="section-body">
                <a class="btn btn-primary" href="{{ route('provider.appointment-schedule.index') }}"><i
                        class="fas fa-list"></i> {{ __('Schedule List') }}</a>
                <div class="row mt-sm-4">
                    <div class="col-12">
                        <div class="card ">
                            <div class="card-body">
                                <form action="{{ route('provider.appointment-schedule.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="">{{ __('Day') }} <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" id="" name="day">
                                                <option value="">{{ __('Select Day') }}</option>
                                                @foreach ($days as $day)
                                                    <option value="{{ $day }}">{{ $day }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-12">
                                            <label for="start_time">{{ __('Start Time') }} <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control clockpicker" name="start_time" data-align="top"
                                                data-autoclose="true" type="time" autocomplete="off">
                                        </div>

                                        <div class="form-group col-12">
                                            <label for="end_time">{{ __('End Time') }} <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control clockpicker" name="end_time" data-align="top"
                                                data-autoclose="true" type="time" autocomplete="off">
                                        </div>

                                        <div class="form-group col-12">
                                            <label class="mt-2">
                                                <input class="custom-switch-input" name="schedule_allows" type="checkbox">
                                                <span class="custom-switch-indicator"></span>
                                                <span
                                                    class="custom-switch-description">{{ __('This schedule allows all days') }}</span>
                                            </label>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Status') }} <span class="text-danger">*</span></label>
                                            <select class="form-control" id="" name="status">
                                                <option value="1">{{ __('Active') }}</option>
                                                <option value="0">{{ __('Inactive') }}</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
