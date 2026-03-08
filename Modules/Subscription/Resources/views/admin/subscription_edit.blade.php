@extends('admin.master_layout')
@section('title')
    <title>{{ __('Edit Plan') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Edit Plan') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">

                                <a class="btn btn-primary" href="{{ route('admin.subscription-plan.index') }}"><i
                                        class="fa fa-arrow-left"></i> {{ __('Go Back') }}</a>

                            </div>

                            <div class="card-body">

                                <form action="{{ route('admin.subscription-plan.update', $plan->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">

                                        <div class="form-group col-md-6">
                                            <label for="">{{ __('Plan Name') }} <span class="text-danger">*</span>
                                            </label>
                                            <input class="form-control form_control" name="plan_name" type="text"
                                                value="{{ $plan->plan_name }}">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="">{{ __('Plan Price') }} <span
                                                    class="fa fa-info-circle text--primary" data-bs-toggle="tooltip"
                                                    data-placement="top" title="For free plan use(0)"> <span
                                                        class="text-danger">*</span></label>
                                            <input class="form-control form_control" name="plan_price" type="text"
                                                value="{{ $plan->plan_price }}">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="">{{ __('Expiration Date') }} <span
                                                    class="text-danger">*</span></label>

                                            <select class="form-control" id="" name="expiration_date">
                                                <option value="monthly"
                                                    {{ $plan->expiration_date == 'monthly' ? 'selected' : '' }}>
                                                    {{ __('Monthly') }}</option>
                                                <option value="yearly"
                                                    {{ $plan->expiration_date == 'yearly' ? 'selected' : '' }}>
                                                    {{ __('Yearly') }}</option>
                                                <option value="lifetime"
                                                    {{ $plan->expiration_date == 'lifetime' ? 'selected' : '' }}>
                                                    {{ __('Lifetime') }}</option>
                                            </select>

                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="">{{ __('Maximum Service') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input class="form-control form_control" id="maximum_service" name="maximum_service" type="number" min="1" 
                                                    value="{{ $plan->maximum_service == -1 ? '' : $plan->maximum_service }}"
                                                    {{ $plan->maximum_service == -1 ? 'disabled' : '' }} required>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <input type="checkbox" id="unlimited_service" name="unlimited_service" value="1"
                                                            {{ $plan->maximum_service == -1 ? 'checked' : '' }}>
                                                        <label for="unlimited_service" class="ml-2 mb-0">{{ __('Unlimited') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="">{{ __('Serial') }} <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control form_control" name="serial" type="number"
                                                value="{{ $plan->serial }}">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="">{{ __('Status') }} <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" id="" name="status">
                                                <option value="1" {{ $plan->status == 1 ? 'selected' : '' }}>
                                                    {{ __('Active') }}</option>
                                                <option value="0" {{ $plan->status == 0 ? 'selected' : '' }}>
                                                    {{ __('Inactive') }}</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <button class="btn btn-primary" type="submit">{{ __('Update') }}</button>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const unlimitedCheckbox = document.getElementById('unlimited_service');
            const maximumServiceInput = document.getElementById('maximum_service');
            const form = document.querySelector('form');

            if (unlimitedCheckbox && maximumServiceInput && form) {
                // Check if editing and value is -1 (unlimited)
                if (unlimitedCheckbox.checked) {
                    maximumServiceInput.disabled = true;
                    maximumServiceInput.value = -1;
                }

                unlimitedCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        maximumServiceInput.disabled = true;
                        maximumServiceInput.value = -1;
                        maximumServiceInput.removeAttribute('required');
                    } else {
                        maximumServiceInput.disabled = false;
                        if (maximumServiceInput.value == -1 || maximumServiceInput.value == '') {
                            maximumServiceInput.value = '';
                        }
                        maximumServiceInput.setAttribute('required', 'required');
                    }
                });

                // Ensure value is submitted even when input is disabled
                form.addEventListener('submit', function(e) {
                    if (unlimitedCheckbox.checked) {
                        maximumServiceInput.disabled = false;
                        maximumServiceInput.value = -1;
                    }
                });
            }
        });
    </script>
@endsection
