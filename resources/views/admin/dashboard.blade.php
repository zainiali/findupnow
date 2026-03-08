@extends('admin.master_layout')
@section('title')
    <title>{{ __('Dashboard') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        {{-- Show Credentials Setup Alert --}}
        <div class="row position-relative">
            @if (Route::is('admin.dashboard') && ($checkCrentials = checkCrentials()))
                @foreach ($checkCrentials as $checkCrential)
                    @if ($checkCrential->status)
                        <div
                            class="alert alert-danger alert-has-icon alert-dismissible position-absolute w-100 missingCrentialsAlert">
                            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                            <div class="alert-body">
                                <div class="alert-title">{{ $checkCrential->message }}</div>
                                <button class="btn-close" data-bs-dismiss="alert" type="button"></button>

                                {{ $checkCrential->description }} <b><a class="btn btn-sm btn-outline-warning"
                                        href="{{ !empty($checkCrential->route) ? route($checkCrential->route) : url($checkCrential->url) }}">{{ __('Update') }}</a></b>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>

        @if ($setting->is_queable == 'active' && Cache::get('corn_working') !== 'working')
            <div class="alert alert-danger alert-has-icon alert-dismissible show fade">
                <div class="alert-icon"><i class="fas fa-sync"></i></div>
                <div class="alert-body">
                    <div class="alert-title"><a href="{{ route('admin.general-setting') }}" target="_blank"
                            rel="noopener noreferrer">{{ __('Corn Job Is Not Running! Many features will be disabled and face errors') }}</a>
                    </div>
                    <button class="btn-close" data-bs-dismiss="alert" type="button"></button>
                </div>
            </div>
        @endif

        <section class="section">
            <x-admin.breadcrumb title="{{ __('Dashboard') }}" />

            @adminCan('dashboard.view')
                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="dashboard_title">{{ __('Today') }}</h4>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Total Booking') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $today_total_order }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Awaiting Booking') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $today_total_awating_order }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Active Booking') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $today_approved_order }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Complete Booking') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $today_complete_order }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-success">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Total Earnings') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ currency($today_total_earning) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-success">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Withdraw Request') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ currency($today_withdraw_request) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-success">
                                    <i class="fas fa-undo"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Refund Request') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ currency($today_total_refund) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-success">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('New Client/Provider') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $today_users }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <h4 class="dashboard_title">{{ __('This Month') }}</h4>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Total Booking') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $monthly_total_order }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Awaiting Booking') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $monthly_total_awating_order }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Active Booking') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $monthly_approved_order }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Complete Booking') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $monthly_complete_order }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-warning">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Total Earnings') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ currency($monthly_total_earning) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-warning">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Withdraw Request') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ currency($monthly_withdraw_request) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-warning">
                                    <i class="fas fa-undo"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Refund Request') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ currency($monthly_total_refund) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-warning">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('New Client/Provider') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $monthly_users }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <h4 class="dashboard_title">{{ __('This Year') }}</h4>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Total Booking') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $yearly_total_order }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Awaiting Booking') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $yearly_total_awating_order }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Active Booking') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $yearly_approved_order }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Complete Booking') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $yearly_complete_order }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-danger">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Total Earnings') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ currency($yearly_total_earning) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-danger">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Withdraw Request') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ currency($yearly_withdraw_request) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-danger">
                                    <i class="fas fa-undo"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Refund Request') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ currency($yearly_total_refund) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-danger">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('New Client/Provider') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $yearly_users }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <h4 class="dashboard_title">{{ __('Total') }}</h4>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Total Booking') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $total_total_order }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Awaiting Booking') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $total_total_awating_order }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Active Booking') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $total_approved_order }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Complete Booking') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $total_complete_order }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-success">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Total Earnings') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ currency($total_total_earning) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-success">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Withdraw Request') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ currency($total_withdraw_request) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-success">
                                    <i class="fas fa-undo"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Refund Request') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ currency($total_total_refund) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-success">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('New Client/Provider') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $total_users }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-warning">
                                    <i class="fas fa-th-large"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Service') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $total_service }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-warning">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Providers') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $total_providers }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-warning">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Client') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $total_clients }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-warning">
                                    <i class="fas fa-th-large"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Blog') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $total_blog }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endadminCan
        </section>
    </div>
@endsection
