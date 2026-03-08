@extends('website.provider.master_layout')
@section('title')
    <title>{{ __('Flutterwave Gateway') }}</title>
@endsection
@section('provider-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Flutterwave Gateway') }}</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @if ($flutterwave)
                                    <form action="{{ route('provider.store-flutterwave-gateway') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">{{ __('Public Key') }}</label>
                                            <input class="form-control" name="flutterwave_public_key" type="text"
                                                value="{{ $flutterwave->flutterwave_public_key }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('Secret Key') }}</label>
                                            <input class="form-control" name="flutterwave_secret_key" type="text"
                                                value="{{ $flutterwave->flutterwave_secret_key }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('Status') }}</label>
                                            <select class="form-control" id="" name="flutterwave_status">
                                                <option value="active"
                                                    {{ $flutterwave->flutterwave_status == 'active' ? 'selected' : '' }}>
                                                    {{ __('Active') }}</option>
                                                <option value="inactive"
                                                    {{ $flutterwave->flutterwave_status == 'inactive' ? 'selected' : '' }}>
                                                    {{ __('Inactive') }}</option>
                                            </select>
                                        </div>

                                        <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>

                                    </form>
                                @else
                                    <form action="{{ route('provider.store-flutterwave-gateway') }}" method="POST">
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
