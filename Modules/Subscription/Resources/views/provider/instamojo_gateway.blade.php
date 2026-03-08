@extends('website.provider.master_layout')
@section('title')
    <title>{{ __('Instamojo Gateway') }}</title>
@endsection
@section('provider-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Instamojo Gateway') }}</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @if ($instamojo)
                                    <form action="{{ route('provider.store-instamojo-gateway') }}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <label for="">{{ __('Instamojo Client Id') }}</label>
                                            <input class="form-control" name="instamojo_client_id" type="text"
                                                value="{{ $instamojo->instamojo_client_id }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('Instamojo Client Secret') }}</label>
                                            <input class="form-control" name="instamojo_client_secret" type="text"
                                                value="{{ $instamojo->instamojo_client_secret }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('Status') }}</label>
                                            <select class="form-control" id="" name="instamojo_status">
                                                <option value="active"
                                                    {{ $instamojo->instamojo_status == 'active' ? 'selected' : '' }}>
                                                    {{ __('Active') }}</option>
                                                <option value="inactive"
                                                    {{ $instamojo->instamojo_status == 'inactive' ? 'selected' : '' }}>
                                                    {{ __('Inactive') }}</option>
                                            </select>
                                        </div>

                                        <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>

                                    </form>
                                @else
                                    <form action="{{ route('provider.store-instamojo-gateway') }}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <label for="">{{ __('Account Mode') }}</label>
                                            <select class="form-control" id="" name="account_mode">
                                                <option value="Sandbox">{{ __('Sandbox') }}</option>
                                                <option value="Live">{{ __('Live') }}</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('API Key') }}</label>
                                            <input class="form-control" name="api_key" type="text">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('Auth Token') }}</label>
                                            <input class="form-control" name="auth_token" type="text">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('Status') }}</label>
                                            <select class="form-control" id="" name="status">
                                                <option value="1">{{ __('Active') }}</option>
                                                <option value="0">{{ __('Inactive') }}</option>
                                            </select>
                                        </div>

                                        <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>

                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
