@extends('website.provider.master_layout')
@section('title')
    <title>{{ __('Bank & Handcash') }}</title>
@endsection
@section('provider-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Bank & Handcash') }}</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @if ($bank_handcash)
                                    <form action="{{ route('provider.store-bank-handcash-gateway') }}" method="POST">
                                        @csrf

                                        <div class="form-group">

                                            <label for="">{{ __('Bank Instruction') }}</label>

                                            <textarea class="form-control text-area-5" id="" name="bank_information" cols="30" rows="3">{{ $bank_handcash->bank_information }}</textarea>

                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('Bank Status') }}</label>
                                            <select class="form-control" id="" name="bank_status">
                                                <option value="active"
                                                    {{ $bank_handcash->bank_status == 'active' ? 'selected' : '' }}>
                                                    {{ __('Active') }}</option>
                                                <option value="inactive"
                                                    {{ $bank_handcash->bank_status == 'inactive' ? 'selected' : '' }}>
                                                    {{ __('Inactive') }}</option>
                                            </select>
                                        </div>

                                        <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>

                                    </form>
                                @else
                                    <form action="{{ route('provider.store-bank-handcash-gateway') }}" method="POST">
                                        @csrf

                                        <div class="form-group">

                                            <label for="">{{ __('Bank Instruction') }}</label>

                                            <textarea class="form-control text-area-5" id="" name="bank_instruction" cols="30" rows="3"></textarea>

                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('Bank Status') }}</label>
                                            <select class="form-control" id="" name="bank_status">
                                                <option value="1">{{ __('Active') }}</option>
                                                <option value="0">{{ __('Inactive') }}</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{ __('Handcash Status') }}</label>
                                            <select class="form-control" id="" name="handcash_status">
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
