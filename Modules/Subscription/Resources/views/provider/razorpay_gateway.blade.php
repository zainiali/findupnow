@extends('website.provider.master_layout')
@section('title')
    <title>{{ __('Razorpay Gateway') }}</title>
@endsection
@section('provider-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Razorpay Gateway') }}</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @if ($razorpay)
                                    <form action="{{ route('provider.store-razorpay-gateway') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">{{ __('Razorpay Key') }}</label>
                                            <input class="form-control" name="razorpay_key" type="text"
                                                value="{{ $razorpay->razorpay_key }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('Razorpay Secret Key') }}</label>
                                            <input class="form-control" name="razorpay_secret" type="text"
                                                value="{{ $razorpay->razorpay_secret }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('Status') }}</label>
                                            <select class="form-control" id="razorpay_status" name="razorpay_status">
                                                <option value="active"
                                                    {{ $razorpay->razorpay_status == 'active' ? 'selected' : '' }}>
                                                    {{ __('Active') }}</option>
                                                <option value="inactive"
                                                    {{ $razorpay->razorpay_status == 'inactive' ? 'selected' : '' }}>
                                                    {{ __('Inactive') }}</option>
                                            </select>
                                        </div>

                                        <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>

                                    </form>
                                @else
                                    <form action="{{ route('provider.store-razorpay-gateway') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">{{ __('Razorpay Key') }}</label>
                                            <input class="form-control" name="key" type="text">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('Razorpay Secret Key') }}</label>
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
