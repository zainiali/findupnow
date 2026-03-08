@extends('admin.master_layout')
@section('title')
    <title>{{ __('Edit Profile') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <x-admin.breadcrumb title="{{ __('Edit Profile') }}" :list="[
                __('Dashboard') => route('admin.dashboard'),
                __('Edit Profile') => '#',
            ]" />

            {{-- edit profile area  --}}
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card profile-widget">
                            <div class="profile-widget-description">
                                <form @adminCan('admin.profile.update') action="{{ route('admin.profile-update') }}"
                                    @endadminCan enctype="multipart/form-data" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <x-admin.form-image-preview :image="!empty($admin->image) ? $admin->image : $setting->default_avatar" label="{{ __('Existing Image') }}"
                                                button_label="{{ __('Update Image') }}" />
                                        </div>

                                        <div class="form-group col-12">
                                            <x-admin.form-input id="name" name="name" value="{{ $admin->name }}"
                                                label="{{ __('Name') }}" required="true" />
                                        </div>

                                        <div class="form-group col-12">
                                            <x-admin.form-input id="email" name="email" type="email"
                                                value="{{ $admin->email }}" label="{{ __('Email') }}" required="true" />
                                        </div>
                                    </div>
                                    @adminCan('admin.profile.update')
                                        <div class="row">
                                            <div class="col-12">
                                                <x-admin.update-button :text="__('Update')" />
                                            </div>
                                        </div>
                                    @endadminCan
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            {{-- edit profile area  --}}

            {{-- edit password area --}}

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card ">
                            <div class="card-body">
                                <form @adminCan('admin.profile.update') action="{{ route('admin.update-password') }}"
                                    @endadminCan enctype="multipart/form-data" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">

                                        <div class="form-group col-12">
                                            <x-admin.form-input id="current_password" name="current_password"
                                                type="password" label="{{ __('Current Password') }}" required="true" />
                                        </div>

                                        <div class="form-group col-12">
                                            <x-admin.form-input id="password" name="password" type="password"
                                                label="{{ __('New Password') }}" required="true" />
                                        </div>

                                        <div class="form-group col-12">
                                            <x-admin.form-input id="password_confirmation" name="password_confirmation"
                                                type="password" label="{{ __('Confirm Password') }}" required="true" />
                                        </div>

                                    </div>
                                    @adminCan('admin.profile.update')
                                        <div class="row">
                                            <div class="col-12">
                                                <x-admin.update-button id="update-btn-2" :text="__('Update')" />
                                            </div>
                                        </div>
                                    @endadminCan
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- edit password area --}}

        </section>
    </div>
@endsection
@push('js')
    <script src="{{ asset('backend/js/jquery.uploadPreview.min.js') }}"></script>
    <script>
        "use strict";

        $.uploadPreview({
            input_field: "#image-upload",
            preview_box: "#image-preview",
            label_field: "#image-label",
            label_default: "{{ __('Choose Image') }}",
            label_selected: "{{ __('Change Image') }}",
            no_label: false,
            success_callback: null
        });
    </script>
@endpush
