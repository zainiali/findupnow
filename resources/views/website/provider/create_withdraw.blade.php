@extends('website.provider.master_layout')
@section('title')
    <title>{{ __('My withdraw') }}</title>
@endsection
@section('provider-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('My withdraw') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('provider.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('My withdraw') }}</div>
                </div>
            </div>

            <div class="section-body">
                <a class="btn btn-primary" href="{{ route('provider.my-withdraw.index') }}"><i class="fas fa-list"></i>
                    {{ __('My withdraw') }}</a>
                <div class="row mt-4">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('provider.my-withdraw.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">{{ __('Withdraw Method') }}</label>
                                        <select class="form-control" id="method_id" name="method_id">
                                            <option value="">{{ __('Select Method') }}</option>
                                            @foreach ($methods as $method)
                                                <option value="{{ $method->id }}">{{ $method->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('Withdraw Amount') }}</label>
                                        <input class="form-control" name="withdraw_amount" type="text">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('Account Information') }}</label>
                                        <textarea class="form-control text-area-5" id="" name="account_info" cols="30" rows="10"></textarea>
                                    </div>

                                    <button class="btn btn-primary" type="submit">{{ __('Send Request') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 d-none" id="method_des_box">
                        <div class="card">
                            <div class="card-body" id="method_des">

                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>

    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                $("#method_id").on('change', function() {
                    var methodId = $(this).val();
                    $.ajax({
                        type: "get",
                        url: "{{ url('/provider/get-withdraw-account-info/') }}" + "/" +
                            methodId,
                        success: function(response) {
                            $("#method_des").html(response)
                            $("#method_des_box").removeClass('d-none')
                        },
                        error: function(err) {}
                    })

                    if (!methodId) {
                        $("#method_des_box").addClass('d-none')
                    }

                })
            });

        })(jQuery);
    </script>
@endsection
