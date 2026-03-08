@extends('website.provider.master_layout')
@section('title')
    <title>{{ __('Paypal Gateway') }}</title>
@endsection
@section('provider-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Paypal Gateway') }}</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">

                            <div class="card-body">
                                @if ($paypal)
                                    <form action="{{ route('provider.store-paypal-gateway') }}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <label for="">{{ __('Paypal Client Id') }}</label>
                                            <input class="form-control" name="paypal_client_id" type="text"
                                                value="{{ $paypal->paypal_client_id }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('Paypal Secret Id') }}</label>
                                            <input class="form-control" name="paypal_secret_key" type="text"
                                                value="{{ $paypal->paypal_secret_key }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('Status') }}</label>
                                            <select class="form-control" id="paypal_status" name="paypal_status">
                                                <option value="active"
                                                    {{ $paypal->paypal_status == 'active' ? 'selected' : '' }}>
                                                    {{ __('Active') }}</option>
                                                <option value="inactive"
                                                    {{ $paypal->paypal_status == 'inactive' ? 'selected' : '' }}>
                                                    {{ __('Inactive') }}</option>
                                            </select>
                                        </div>

                                        <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>

                                    </form>
                                @else
                                    <form action="{{ route('provider.store-paypal-gateway') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">{{ __('Paypal App Id') }}</label>
                                            <input class="form-control" name="client_id" type="text">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('Paypal Secret Id') }}</label>
                                            <input class="form-control" name="secret_id" type="text">
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
