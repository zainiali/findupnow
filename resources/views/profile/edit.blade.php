@extends('website.layout')

@section('main-body')
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="form-group inflanar-form-input mg-top-20">
                    <label>{{ __('Name') }}*</label>
                    <input class="ecom-wc__form-input" name="name" type="text" value="{{ $user->name }}"
                        placeholder="{{ __('Name') }}">
                </div>
            </div>

            <div class="col-lg-6 col-12">
                <div class="form-group inflanar-form-input mg-top-20">
                    <label>{{ __('Email') }}*</label>
                    <input class="ecom-wc__form-input" name="email" type="email" value="{{ $user->email }}"
                        placeholder="{{ __('Email') }}" readonly>
                </div>
            </div>

            <div class="col-lg-6 col-12">
                <div class="form-group inflanar-form-input mg-top-20">
                    <label>{{ __('Phone') }}*</label>
                    <input class="ecom-wc__form-input" name="phone" type="text" value="{{ $user->phone }}"
                        placeholder="{{ __('e.g. +92345689008876') }}">
                    <small class="text-muted d-block mt-1">{{ __('Enter + then your country code and number with no spaces (e.g. +92345689008876).') }}</small>
                </div>
            </div>

            <div class="col-12">
                <div class="form-group inflanar-form-input mg-top-20">
                    <label>{{ __('Address') }}*</label>
                    <input class="ecom-wc__form-input" name="address" type="text" value="{{ $user->address }}"
                        placeholder="{{ __('Address') }}">
                </div>
            </div>

        </div>
        <!-- Submit Button -->
        <div class="form-group mg-top-40">
            <button class="inflanar-btn" type="submit"><span>{{ __('Update Profile') }}</span></button>
        </div>
    </form>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <form action="{{ route('user.update-password') }}" method="POST">
        @csrf
        <div class="form-group inflanar-form-input">
            <label>{{ __('Current Password') }}*</label>
            <input class="inflanar-signin__form-input" id="password-field" name="current_password" type="password">
        </div>
        <div class="form-group inflanar-form-input mg-top-20">
            <label>{{ __('New Password') }}*</label>
            <input class="inflanar-signin__form-input" id="password-field" name="password" type="password" placeholder="">
        </div>
        <div class="form-group inflanar-form-input mg-top-20">
            <label>{{ __('Confirm Password') }}*</label>
            <input class="inflanar-signin__form-input" id="password-field" name="password_confirmation" type="password"
                placeholder="">
        </div>
        <div class="inflanar__item-button--group mg-top-50">
            <button class="inflanar-btn" type="submit">{{ __('Update Password') }}</button>
            <a class="inflanar-btn inflanar-btn__cancel" href=""><span>{{ __('Cancel') }}</span></a>
        </div>
    </form>
@endsection
