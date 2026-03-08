@extends('website.provider.master_layout')
@section('title')
    <title>{{ __('Change Password') }}</title>
@endsection
@section('provider-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Change Password') }}</h1>

            </div>
            <div class="section-body">
                <div class="row mt-sm-4">
                    <div class="col-12">
                        <div class="card profile-widget">
                            <div class="profile-widget-description">
                                <form action="{{ route('provider.password-update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">

                                        <div class="form-group col-12">
                                            <label>{{ __('New Password') }}</label>
                                            <input class="form-control" name="password" type="password">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Confirm Password') }}</label>
                                            <input class="form-control" name="password_confirmation" type="password">
                                        </div>
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
