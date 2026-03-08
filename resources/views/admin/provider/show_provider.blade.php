@extends('admin.master_layout')
@section('title')
    <title>{{ __('Provider Details') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Provider Details') }}</h1>

            </div>

            <div class="section-body">
                <a class="btn btn-primary" href="{{ route('admin.provider') }}"><i class="fas fa-list"></i>
                    {{ __('Privider List') }}</a>
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
                        <a href="{{ route('admin.provider-withdraw', ['provider_id' => $provider->id]) }}">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-danger">
                                    <i class="far fa-newspaper"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Total Withdraw') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ currency($total_withdraw ?? 0) }}

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
                                    {{ currency($current_balance ?? 0) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.service.index', ['provider' => $provider->id]) }}">
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
                                @if ($provider->image)
                                    <img class="rounded-circle profile-widget-picture" src="{{ asset($provider->image) }}"
                                        alt="image">
                                @else
                                    <img class="rounded-circle profile-widget-picture"
                                        src="{{ asset($default_avatar->image) }}" alt="image">
                                @endif
                                <div class="profile-widget-items">
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">{{ __('Joined at') }}</div>
                                        <div class="profile-widget-item-value">
                                            {{ $provider?->created_at->format('d M Y') }}
                                        </div>
                                    </div>
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">{{ __('Total Balance') }}</div>
                                        <div class="profile-widget-item-value">
                                            {{ currency($total_balance ?? 0) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-widget-description">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <td>{{ __('Name') }}</td>
                                            <td>{{ html_decode($provider->name) }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Email') }}</td>
                                            <td>{{ html_decode($provider->email) }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Phone') }}</td>
                                            <td>{{ html_decode($provider->phone) }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('User Status') }}</td>
                                            <td>
                                                @if ($provider->status == 1)
                                                    <a href="javascript:;"
                                                        onclick="manageCustomerStatus({{ $provider->id }})">
                                                        <input id="status_toggle" data-toggle="toggle"
                                                            data-on="{{ __('Active') }}" data-off="{{ __('InActive') }}"
                                                            data-onstyle="success" data-offstyle="danger" type="checkbox"
                                                            checked>
                                                    </a>
                                                @else
                                                    <a href="javascript:;"
                                                        onclick="manageCustomerStatus({{ $provider->id }})">
                                                        <input id="status_toggle" data-toggle="toggle"
                                                            data-on="{{ __('Active') }}" data-off="{{ __('InActive') }}"
                                                            data-onstyle="success" data-offstyle="danger" type="checkbox">
                                                    </a>
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
                                                <a class="btn btn-success btn-block btn-lg my-2"
                                                    href="{{ route('providers', $provider?->user_name ?? 0) }}"
                                                    target="_blank">{{ __('Go to Provider Front Page') }}</a>
                                            </div>

                                            <div class="col-12">
                                                <a class="btn btn-primary btn-block btn-lg my-2"
                                                    href="{{ route('admin.review-list', ['provider_id' => $provider->id]) }}">{{ __('Provider Reviews') }}</a>
                                            </div>

                                            <div class="col-12">
                                                <a class="btn btn-warning btn-block btn-lg my-2"
                                                    href="{{ route('admin.send-email-to-provider', $provider->id) }}">{{ __('Send Email') }}</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-12 col-lg-7">
                        <div class="card">
                            <form class="needs-validation" method="post" novalidate=""
                                action="{{ route('admin.provider-update', $provider->id) }}" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="card-header">
                                    <h4>{{ __('Edit Profile') }}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>{{ __('Existing Image') }}</label>
                                            <div>
                                                @if ($provider->image)
                                                    <img class="w_120" src="{{ asset($provider->image) }}" alt="Provider Image">
                                                @else
                                                    <img class="w_120" src="{{ asset($default_avatar->image) }}" alt="Default Avatar">
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('New Image') }}</label>
                                            <input class="form-control" name="image" type="file" accept="image/*">
                                            <small class="text-muted">{{ __('Note: Max File Size 2MB. Allowed formats: PNG, JPEG, JPG, GIF, SVG, WEBP, AVIF, BMP, ICO') }}</small>
                                        </div>

                                        <div class="form-group col-6">
                                            <label>{{ __('Name') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="name" type="text"
                                                value="{{ html_decode($provider->name) }}">
                                        </div>

                                        <div class="form-group col-6">
                                            <label>{{ __('Desgination') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="designation" type="text"
                                                value="{{ html_decode($provider->designation) }}">
                                        </div>

                                        <div class="form-group col-6">
                                            <label>{{ __('Email') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="email" type="email"
                                                value="{{ html_decode($provider->email) }}" readonly>
                                        </div>

                                        <div class="form-group col-6">
                                            <label>{{ __('Phone') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="phone" type="text"
                                                value="{{ html_decode($provider->phone) }}">
                                        </div>

                                        <div class="form-group col-6">
                                            <label>{{ __('Country / Region') }} <span class="text-danger">*</span></label>
                                            <select class="form-control select2" id="country_id" name="country">
                                                <option value="">{{ __('Select') }}</option>
                                                @if ($provider->country_id != 0)
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}"
                                                            {{ $provider->country_id == $country->id ? 'selected' : '' }}>
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
                                                @if ($provider->state_id != 0)
                                                    @foreach ($states as $state)
                                                        <option value="{{ $state->id }}"
                                                            {{ $provider->state_id == $state->id ? 'selected' : '' }}>
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
                                                value="{{ html_decode($provider->address) }}">
                                        </div>

                                    </div>
                                    <button class="btn btn-primary" type="submit">{{ __('Save Changes') }}</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        "use strict";

        function manageCustomerStatus(id) {
            var isDemo = "{{ env('APP_MODE') }}"
            if (isDemo == 'DEMO') {
                toastr.error('This Is Demo Version. You Can Not Change Anything');
                return;
            }
            $.ajax({
                type: "put",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                url: "{{ url('/admin/customer-status/') }}" + "/" + id,
                success: function(response) {
                    toastr.success(response)
                },
                error: function(err) {

                }
            })
        }

        function manageCustomerStatus(id) {
            var isDemo = "{{ env('APP_MODE') }}"
            if (isDemo == 'DEMO') {
                toastr.error('This Is Demo Version. You Can Not Change Anything');
                return;
            }
            $.ajax({
                type: "put",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                url: "{{ url('/admin/provider-status/') }}" + "/" + id,
                success: function(response) {
                    toastr.success(response)
                },
                error: function(err) {

                }
            })
        }
    </script>

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
                                var response =
                                    "<option value=''>{{ __('Select') }}</option>";
                                $("#city_id").html(response);
                            },
                            error: function(err) {

                            }
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
                            url: "{{ url('/admin/city-by-state/') }}" + "/" + countryId,
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
