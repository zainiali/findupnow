@extends('website.provider.master_layout')
@section('title')
    <title>{{ __('Stripe Gateway') }}</title>
@endsection
@section('provider-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Stripe Gateway') }}</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @if ($stripe)
                                    <form action="{{ route('provider.store-stripe-gateway') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">{{ __('Stripe Publishable Key') }}</label>
                                            <input class="form-control" name="stripe_key" type="text"
                                                value="{{ $stripe->stripe_key }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('Stripe Secret Key') }}</label>
                                            <input class="form-control" name="stripe_secret" type="text"
                                                value="{{ $stripe->stripe_secret }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('Status') }}</label>
                                            <select class="form-control" id="stripe_status" name="stripe_status">
                                                <option value="active"
                                                    {{ $stripe->stripe_status == 'active' ? 'selected' : '' }}>
                                                    {{ __('Active') }}</option>
                                                <option value="inactive"
                                                    {{ $stripe->stripe_status == 'inactive' ? 'selected' : '' }}>
                                                    {{ __('Inactive') }}</option>
                                            </select>
                                        </div>

                                        <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>

                                    </form>
                                @else
                                    <form action="{{ route('provider.store-stripe-gateway') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">{{ __('Stripe Publishable Key') }}</label>
                                            <input class="form-control" name="stripe_key" type="text">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('Stripe Secret Key') }}</label>
                                            <input class="form-control" name="stripe_secret" type="text">
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
