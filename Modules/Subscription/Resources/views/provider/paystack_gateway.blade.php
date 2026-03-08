@extends('website.provider.master_layout')
@section('title')
    <title>{{ __('Paystack Gateway') }}</title>
@endsection
@section('provider-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Paystack Gateway') }}</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @if ($paystack)
                                    <form action="{{ route('provider.store-paystack-gateway') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">{{ __('Public Key') }}</label>
                                            <input class="form-control" name="paystack_public_key" type="text"
                                                value="{{ $paystack->paystack_public_key }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('Secret Key') }}</label>
                                            <input class="form-control" name="paystack_secret_key" type="text"
                                                value="{{ $paystack->paystack_secret_key }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('Status') }}</label>
                                            <select class="form-control" id="" name="paystack_status">
                                                <option value="active"
                                                    {{ $paystack->paystack_status == 'active' ? 'selected' : '' }}>
                                                    {{ __('Active') }}</option>
                                                <option value="inactive"
                                                    {{ $paystack->paystack_status == 'inactive' ? 'selected' : '' }}>
                                                    {{ __('Inactive') }}</option>
                                            </select>
                                        </div>

                                        <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>

                                    </form>
                                @else
                                    <form action="{{ route('provider.store-paystack-gateway') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">{{ __('Public Key') }}</label>
                                            <input class="form-control" name="public_key" type="text">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('Secret Key') }}</label>
                                            <input class="form-control" name="secret_key" type="text">
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
