@extends('website.provider.master_layout')
@section('title')
    <title>{{ __('Create Ticket') }}</title>
@endsection
@section('provider-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Create Ticket') }}</h1>
            </div>

            <div class="section-body">
                <a class="btn btn-primary" href="{{ route('provider.ticket') }}"> <i class="fa fa-list" aria-hidden="true"></i>
                    {{ __('Ticket List') }}</a>
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('provider.store-new-ticket') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">{{ __('Select Order') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control select2" id="" name="order_id">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($orders as $order)
                                                <option value="{{ $order->id }}">{{ $order->order_id }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('Subject') }} <span class="text-danger">*</span></label>
                                        <input class="form-control" name="subject" type="text">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('Message') }} <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control text-area-5" id="" name="message" cols="30" rows="10"></textarea>
                                    </div>

                                    <button class="btn btn-primary">{{ __('Save') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
