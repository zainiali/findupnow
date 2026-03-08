@extends('website.provider.master_layout')
@section('title')
    <title>{{ __('Schedule') }}</title>
@endsection
@section('provider-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Schedule') }}</h1>

            </div>
            <div class="section-body">
                <div class="row mt-sm-4">
                    <div class="col-12">
                        <div class="card profile-widget">
                            <div class="profile-widget-description">
                                <form action="{{ route('provider.update-schedule') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        @if ($schedules->count() == 0)
                                            @foreach ($days as $day)
                                                <div class="form-group col-md-3">
                                                    <label>{{ __('Day') }}</label>

                                                    <input class="form-control" name="days[]" type="text"
                                                        value="{{ $day }}" readonly>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label>{{ __('Start') }}</label>
                                                    <input class="form-control clockpicker" name="start[]" data-align="top"
                                                        data-autoclose="true" type="text" autocomplete="off">
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label>{{ __('End') }}</label>
                                                    <input class="form-control clockpicker" name="end[]" data-align="top"
                                                        data-autoclose="true" type="text" autocomplete="off">
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label>{{ __('Status') }}</label>
                                                    <select class="form-control" id="" name="status[]">
                                                        <option value="1">{{ __('On') }}</option>
                                                        <option value="0">{{ __('Off') }}</option>
                                                    </select>
                                                </div>
                                            @endforeach
                                        @else
                                            @foreach ($schedules as $schedule)
                                                <input name="ids[]" type="hidden" value="{{ $schedule->id }}">
                                                <div class="form-group col-md-3">
                                                    <label>{{ __('Day') }}</label>

                                                    <input class="form-control" name="days[]" type="text"
                                                        value="{{ $schedule->day }}" readonly>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label>{{ __('Start') }}</label>
                                                    <input class="form-control clockpicker" name="start[]" data-align="top"
                                                        data-autoclose="true" type="text" value="{{ $schedule->start }}"
                                                        autocomplete="off">
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label>{{ __('End') }}</label>
                                                    <input class="form-control clockpicker" name="end[]" data-align="top"
                                                        data-autoclose="true" type="text" value="{{ $schedule->end }}"
                                                        autocomplete="off">
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label>{{ __('Status') }}</label>
                                                    <select class="form-control" id="" name="status[]">
                                                        <option value="1"
                                                            {{ $schedule->status == 1 ? 'selected' : '' }}>
                                                            {{ __('On') }}</option>
                                                        <option value="0"
                                                            {{ $schedule->status == 0 ? 'selected' : '' }}>
                                                            {{ __('Off') }}</option>
                                                    </select>
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-primary">{{ __('Update') }}</button>
                                        </div>
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
