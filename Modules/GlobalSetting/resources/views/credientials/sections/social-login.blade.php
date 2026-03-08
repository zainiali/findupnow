<div class="tab-pane fade" id="social_login_tab" role="tabpanel">
    @php
        $socialLogin = \App\Models\SocialLoginInformation::first();
    @endphp
    <form action="{{ route('admin.update-social-login') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <x-admin.form-input id="gmail_client_id" name="gmail_client_id" value="{{ $socialLogin->gmail_client_id }}"
                label="{{ __('Google Client ID') }}" />
        </div>
        <div class="form-group">
            <x-admin.form-input id="gmail_secret_id" name="gmail_secret_id" value="{{ $socialLogin->gmail_secret_id }}"
                label="{{ __('Google Secret ID') }}" />
        </div>
        <div class="form-group">
            <x-admin.form-switch name="is_gmail" label="{{ __('Status') }}" active_value="1" inactive_value="0"
                :checked="$socialLogin->is_gmail == 1" />
        </div>

        <div class="form-group">
            <x-admin.form-input id="facebook_client_id" name="facebook_client_id"
                value="{{ $socialLogin->facebook_client_id }}" label="{{ __('Facebook Client ID') }}" />
        </div>
        <div class="form-group">
            <x-admin.form-input id="facebook_secret_id" name="facebook_secret_id"
                value="{{ $socialLogin->facebook_secret_id }}" label="{{ __('Facebook Secret ID') }}" />
        </div>
        <div class="form-group">
            <x-admin.form-switch name="is_facebook" label="{{ __('Status') }}" active_value="1" inactive_value="0"
                :checked="$socialLogin->is_facebook == 1" />
        </div>

        <x-admin.update-button :text="__('Update')" />

    </form>

    <div class="form-group mt-3">
        <label>{{ __('Google Redirect Url') }} <span class="fa fa-info-circle text--primary" data-bs-toggle="tooltip"
                data-placement="top"
                title="{{ __('Copy the google login URL and paste it wherever you need to use it.') }}"></span></label>
        <div class="input-group mb-3">
            <input class="form-control" id="gmail_redirect_url" type="text" value="{{ route('callback-google') }}"
                readonly>
            <x-admin.button id="copyButton" text="{{ __('Click to copy') }}" />
        </div>
    </div>

    <div class="form-group mt-3">
        <label>{{ __('Facebook Redirect Url') }} <span class="fa fa-info-circle text--primary" data-bs-toggle="tooltip"
                data-placement="top"
                title="{{ __('Copy the facebook login URL and paste it wherever you need to use it.') }}"></span></label>
        <div class="input-group mb-3">
            <input class="form-control" id="facebook_redirect_url" type="text"
                value="{{ route('callback-facebook') }}" readonly>
            <x-admin.button id="copyButton" text="{{ __('Click to copy') }}" />
        </div>
    </div>
</div>
