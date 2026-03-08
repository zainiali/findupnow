@extends('admin.master_layout')
@section('title')
    <title>{{ __('Assign Plan') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Assign Plan') }}</h1>

            </div>

            <div class="section-body">
                <div class="row">

                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">

                                <a class="btn btn-primary" href="{{ route('admin.purchase-history') }}"><i
                                        class="fa fa-arrow-left"></i>
                                    {{ __('Go Back') }}</a>

                            </div>

                            <div class="card-body">

                                <form action="{{ route('admin.store-assign-plan') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">

                                        <div class="form-group col-12">
                                            <label for="">{{ __('Select Plan') }} <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" id="" name="plan_id">
                                                @foreach ($plans as $plan)
                                                    <option value="{{ $plan->id }}">{{ $plan->plan_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-12">
                                            <label for="">{{ __('Select Provider') }} <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control select2 " id="" name="provider_id">
                                                <option value="">{{ __('Select') }}</option>
                                                @foreach ($providers as $provider)
                                                    <option value="{{ $provider->id }}">{{ $provider->name }} -
                                                        {{ $provider->user_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <button class="btn btn-primary" type="submit">{{ __('Assign Plan') }}</button>
                                        </div>

                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
