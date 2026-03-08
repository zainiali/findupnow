@extends('admin.master_layout')
@section('title')
    <title>{{ __('Service Area') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Edit Service Area') }}</h1>

            </div>

            <div class="section-body">
                <a class="btn btn-primary" href="{{ route('admin.city.index') }}"><i class="fas fa-list"></i>
                    {{ __('Service Area') }}</a>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.city.update', $city->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">

                                        <div class="form-group col-12">
                                            <label>{{ __('Country / Region') }} <span class="text-danger">*</span></label>
                                            <select class="form-control select2" id="country_id" name="country">
                                                <option value="">{{ __('Select') }}</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}"
                                                        {{ $city->countryState->country_id == $country->id ? 'selected' : '' }}>
                                                        {{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('State / Province') }} <span class="text-danger">*</span></label>
                                            <select class="form-control select2" id="state_id" name="state">
                                                <option value="">{{ __('Select') }}</option>
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->id }}"
                                                        {{ $city->country_state_id == $state->id ? 'selected' : '' }}>
                                                        {{ $state->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Service Area') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" id="name" name="name" type="text"
                                                value="{{ $city->name }}">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Status') }} <span class="text-danger">*</span></label>
                                            <select class="form-control" name="status">
                                                <option value="1" {{ $city->status == 1 ? 'selected' : '' }}>
                                                    {{ __('Active') }}</option>
                                                <option value="0" {{ $city->status == 0 ? 'selected' : '' }}>
                                                    {{ __('Inactive') }}</option>
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
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {

                $("#country_id").on("change", function() {
                    var countryId = $("#country_id").val();
                    if (countryId) {
                        $.ajax({
                            type: "get",
                            url: "{{ url('/admin/state-by-country/') }}" + "/" + countryId,
                            success: function(response) {
                                $("#state_id").html(response.states);
                            },
                            error: function(err) {

                            }
                        })
                    } else {
                        var response = "<option value=''>{{ __('Select a State') }}</option>";
                        $("#state_id").html(response);
                    }

                })
            });
        })(jQuery);
    </script>
@endsection
