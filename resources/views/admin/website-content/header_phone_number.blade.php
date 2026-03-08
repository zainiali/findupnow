@extends('admin.master_layout')
@section('title')
    <title>{{ __('Header Information') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Header Information') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Header Information') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.update-topbar-contact') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="">{{ __('Header Phone') }}</label>
                                        <input class="form-control" name="topbar_phone" type="text"
                                            value="{{ $setting->topbar_phone }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">{{ __('Header Email') }}</label>
                                        <input class="form-control" name="topbar_email" type="email"
                                            value="{{ $setting->topbar_email }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('Opening Time') }}</label>
                                        <input class="form-control" name="opening_time" type="text"
                                            value="{{ $setting->opening_time }}">
                                    </div>
                                    <button class="btn btn-primary" type="submit">{{ __('Update') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
