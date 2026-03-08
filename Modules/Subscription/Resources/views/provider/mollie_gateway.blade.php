@extends('website.provider.master_layout')
@section('title')
    <title>{{ __('Mollie Gateway') }}</title>
@endsection
@section('provider-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Mollie Gateway') }}</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @if ($mollie)
                                    <form action="{{ route('provider.store-mollie-gateway') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">{{ __('Mollie Key') }}</label>
                                            <input class="form-control" name="mollie_key" type="text"
                                                value="{{ $mollie->mollie_key }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('Status') }}</label>
                                            <select class="form-control" id="" name="mollie_status">
                                                <option value="active"
                                                    {{ $mollie->mollie_status == 'active' ? 'selected' : '' }}>
                                                    {{ __('Active') }}</option>
                                                <option value="inactive"
                                                    {{ $mollie->mollie_status == 'inactive' ? 'selected' : '' }}>
                                                    {{ __('Inactive') }}</option>
                                            </select>
                                        </div>

                                        <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>

                                    </form>
                                @else
                                    <form action="{{ route('provider.store-mollie-gateway') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">{{ __('Mollie Key') }}</label>
                                            <input class="form-control" name="mollie_key" type="text">
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
