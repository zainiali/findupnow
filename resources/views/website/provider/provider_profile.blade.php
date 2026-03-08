@extends('website.provider.master_layout')
@section('title')
    <title>{{ __('My Profile') }}</title>
@endsection
@section('provider-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('My Profile') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('provider.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('My Profile') }}</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row mt-5">
                    <div class="col-md-3">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-coins"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>{{ __('Total Service Sold') }}</h4>
                                </div>
                                <div class="card-body">
                                    {{ $total_sold_service }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <a href="{{ route('provider.my-withdraw.index') }}">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-danger">
                                    <i class="far fa-newspaper"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Total Withdraw') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ currency($total_withdraw) }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                                <i class="far fa-file"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>{{ __('Current Balance') }}</h4>
                                </div>
                                <div class="card-body">
                                    {{ currency($current_balance) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('provider.service.index') }}">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-success">
                                    <i class="fas fa-circle"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Total Service') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $total_service }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-5">
                        <div class="card profile-widget">
                            <div class="profile-widget-header">
                                @if ($user->image)
                                    <img class="rounded-circle profile-widget-picture" src="{{ asset($user->image) }}"
                                        alt="image">
                                @else
                                    <img class="rounded-circle profile-widget-picture"
                                        src="{{ asset($default_avatar->image) }}" alt="image">
                                @endif
                                <div class="profile-widget-items">
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">{{ __('Joined at') }}</div>
                                        <div class="profile-widget-item-value">{{ $user->created_at->format('d M Y') }}
                                        </div>
                                    </div>
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">{{ __('Balance') }}</div>
                                        <div class="profile-widget-item-value">
                                            {{ currency($total_balance) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-widget-description">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <td>{{ __('Name') }}</td>
                                            <td>{{ $user->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Email') }}</td>
                                            <td>{{ $user->email }}</td>
                                        </tr>

                                        <tr>
                                            <td>{{ __('User Status') }}</td>
                                            <td>
                                                @if ($user->status == 1)
                                                    <span class="badge badge-success">{{ __('Active') }}</span>
                                                @else
                                                    <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                                @endif
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h1>{{ __('Provider Action') }}</h1>
                                    </div>
                                    <div class="card-body text-center">
                                        <div class="row">

                                            <div class="col-12">
                                                <a class="btn btn-primary btn-block btn-lg my-2"
                                                    href="{{ route('provider.review-list') }}">{{ __('My Reviews') }}</a>
                                            </div>

                                            <div class="col-12">
                                                <a class="btn btn-warning btn-block btn-lg my-2"
                                                    href="{{ route('provider.change-password') }}">{{ __('Change Password') }}</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-12 col-lg-7">
                        <div class="card">
                            <form action="{{ route('provider.update-provider-profile') }}" enctype="multipart/form-data"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-header">
                                    <h4>{{ __('Edit Profile') }}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>{{ __('New Image') }}</label>
                                            <input class="form-control" name="image" type="file">
                                        </div>

                                        <div class="form-group col-6">
                                            <label>{{ __('Name') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="name" type="text"
                                                value="{{ $user->name }}">
                                        </div>

                                        <div class="form-group col-6">
                                            <label>{{ __('Designation') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="designation" type="text"
                                                value="{{ $user->designation }}">
                                        </div>

                                        <div class="form-group col-6">
                                            <label>{{ __('Email') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="email" type="email"
                                                value="{{ $user->email }}" readonly>
                                        </div>

                                        <div class="form-group col-6">
                                            <label>{{ __('Phone') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="phone" type="text"
                                                value="{{ $user->phone }}"
                                                placeholder="{{ __('e.g. +92345689008876') }}">
                                            <small class="text-muted d-block mt-1">{{ __('Enter + then your country code and number with no spaces (e.g. +92345689008876).') }}</small>
                                        </div>

                                        <div class="form-group col-6">
                                            <label>{{ __('Country / Region') }} <span class="text-danger">*</span></label>
                                            <select class="form-control select2" id="country_id" name="country">
                                                <option value="">{{ __('Select') }}</option>
                                                @if ($user->country_id != 0)
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}"
                                                            {{ $user->country_id == $country->id ? 'selected' : '' }}>
                                                            {{ $country->name }}</option>
                                                    @endforeach
                                                @else
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <div class="form-group col-6">
                                            <label>{{ __('State / Province') }} <span class="text-danger">*</span></label>
                                            <select class="form-control select2" id="state_id" name="state">
                                                <option value="">{{ __('Select') }}</option>
                                                @if ($user->state_id != 0)
                                                    @foreach ($states as $state)
                                                        <option value="{{ $state->id }}"
                                                            {{ $user->state_id == $state->id ? 'selected' : '' }}>
                                                            {{ $state->name }}</option>
                                                    @endforeach
                                                @else
                                                    @foreach ($states as $state)
                                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Address') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="address" type="text"
                                                value="{{ $user->address }}">
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">{{ __('Update') }}</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h4>{{ __('Service Area') }}</h4>

                                    <a class="btn btn-success"
                                        href="{{ route('provider.export-service-area', $user->state_id) }}"> <i
                                            class="fa fa-download" aria-hidden="true"></i>
                                        {{ __('Download Demo Area') }}</a>
                                </div>

                                <hr>

                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SN') }}</th>
                                                <th>{{ __('Area') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($service_areas as $index => $service_area)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>{{ $service_area->city->name }}</td>

                                                    <td>
                                                        <a class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal" href="javascript:;"
                                                            onclick="deleteData({{ $service_area->id }})"><i
                                                                class="fa fa-trash" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newArea"
                                        href="javascript:;"> <i class="fa fa-download" aria-hidden="true"></i>
                                        {{ __('New Area') }}</a>

                                    <a class="btn btn-success" href="{{ route('provider.export-selected-area') }}"> <i
                                            class="fa fa-download" aria-hidden="true"></i>
                                        {{ __('Download Selected Area') }}</a>
                                </div>

                                <hr>

                                <form action="{{ route('provider.store-import-service-area') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label for="">{{ __('File') }}</label>
                                        <input class="form-control" name="file" type="file">
                                    </div>

                                    <button class="btn btn-primary" type="submit">{{ __('Upload') }}</button>
                                </form>

                                <div class="alert alert-success mt-3" role="alert">
                                    <p>{{ __('Before import delivery area you have to download area list from left side. In the download file you see 3 column (area id, state id and area name). Then you have to download selected area list from right side. In this file you can see your selected area id. If you import new area id you have to remove previous all area and entry your new area id. You can not provide duplicate area id') }}
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="newArea" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true"
        tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Create new area') }}</h5>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ route('provider.store-single-area') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">{{ __('Service Area') }}</label>
                                <select class="form-select" id="" name="delivery_area_id">
                                    <option value="">{{ __('Select') }}</option>
                                    @if ($user->state_id != 0)
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <button class="btn btn-primary">{{ __('Save') }}</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function deleteData(id) {
            $("#deleteForm").attr("action", '{{ url('provider/remove-single-area/') }}' + "/" + id)
        }

        (function($) {
            "use strict";
            $(document).ready(function() {

                $("#country_id").on("change", function() {
                    var countryId = $("#country_id").val();
                    if (countryId) {
                        $.ajax({
                            type: "get",
                            url: "{{ url('/provider/state-by-country/') }}" + "/" + countryId,
                            success: function(response) {
                                $("#state_id").html(response.states);
                                var response =
                                    "<option value=''>{{ __('Select') }}</option>";
                                $("#city_id").html(response);
                            },
                            error: function(err) {}
                        })
                    } else {
                        var response = "<option value=''>{{ __('Select') }}</option>";
                        $("#state_id").html(response);
                        var response = "<option value=''>{{ __('Select') }}</option>";
                        $("#city_id").html(response);
                    }

                })

                $("#state_id").on("change", function() {
                    var countryId = $("#state_id").val();
                    if (countryId) {
                        $.ajax({
                            type: "get",
                            url: "{{ url('/provider/city-by-state/') }}" + "/" + countryId,
                            success: function(response) {
                                $("#city_id").html(response.cities);
                            },
                            error: function(err) {}
                        })
                    } else {
                        var response = "<option value=''>{{ __('Select') }}</option>";
                        $("#city_id").html(response);
                    }

                })

            });
        })(jQuery);
    </script>
@endsection
