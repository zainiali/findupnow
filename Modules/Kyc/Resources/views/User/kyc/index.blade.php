@extends('website.provider.master_layout')
@section('title')
    <title>{{ __('Manage Kyc') }}</title>
@endsection
@section('provider-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Manage Kyc') }}</h1>
            </div>

            <div class="section-body">
                <div class="row mt-sm-4">
                    <div class="col-12">
                        <div class="card ">
                            <div class="card-body">
                                @if ($kyc)
                                    <div class="card service_card">
                                        <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                                            <img class="service_image" src="{{ asset($kyc->file) }}" alt="">
                                            <div class="service_detail">
                                                <h4>{{ $kyc->influncer->name }}</h4>
                                                <p>{{ __('Document Name') }} : {{ $kyc->kyc_type->name }}</p>
                                                <p>{{ __('File') }} : <a href="{{ asset($kyc->file) }}" target="_blank"
                                                        rel="noopener noreferrer">{{ __('Download') }}</a></p>
                                                <p>{{ __('Status') }} :
                                                    @if ($kyc->status == 0)
                                                        <span class="badge badge-danger">{{ __('Pending') }}</span>
                                                    @endif
                                                    @if ($kyc->status == 1)
                                                        <span class="badge badge-success">{{ __('Approved') }}</span>
                                                    @endif
                                                    @if ($kyc->status == 2)
                                                        <span class="badge badge-danger">{{ __('Reject') }}</span>
                                                    @endif

                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <form action="{{ route('provider.kyc-submit') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-12">
                                                <label>{{ __('Select Document Type') }} <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control select2" id="category" name="kyc_id">
                                                    <option value="">{{ __('Select Type') }}</option>
                                                    @foreach ($kycType as $type)
                                                        <option value="{{ $type->id }}"
                                                            {{ $type->id == old('kyc_id') ? 'selected' : '' }}>
                                                            {{ $type->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-12">
                                                <label>{{ __('File') }} <span class="text-danger">*</span></label>
                                                <input class="form-control" name="file" type="file" required>
                                            </div>

                                            <div class="form-group col-12">
                                                <label>{{ __('Message') }}</label>
                                                <textarea class="form-control" id="" name="message" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <button class="btn btn-primary">{{ __('Save') }}</button>
                                            </div>
                                        </div>
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
