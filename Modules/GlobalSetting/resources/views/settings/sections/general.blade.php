<div class="tab-pane fade active show" id="general_tab" role="tabpanel">
    <form action="{{ route('admin.update-general-setting') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <x-admin.form-input id="app_name" name="app_name" value="{{ $setting->app_name }}"
                label="{{ __('App Name') }}" />
        </div>

        <div class="form-group">
            <label for="">{{ __('Sidebar Large Header') }}</label>
            <input class="form-control" name="sidebar_lg_header" type="text"
                value="{{ $setting->sidebar_lg_header }}">
        </div>

        <div class="form-group">
            <label for="">{{ __('Sidebar Small Header') }}</label>
            <input class="form-control" name="sidebar_sm_header" type="text"
                value="{{ $setting->sidebar_sm_header }}">
        </div>

        <div class="form-group">
            <label for="">{{ __('Select Theme') }}</label>
            <select class="form-control" id="" name="selected_theme">
                <option
                    value="0" {{ $setting->selected_theme == 0 ? 'selected' : '' }}>{{ __('All Theme') }}
                </option>
                <option
                    value="1" {{ $setting->selected_theme == 1 ? 'selected' : '' }}>{{ __('Theme One') }}
                </option>
                <option
                    value="2" {{ $setting->selected_theme == 2 ? 'selected' : '' }}>{{ __('Theme Two') }}
                </option>
                <option
                    value="3" {{ $setting->selected_theme == 3 ? 'selected' : '' }}>{{ __('Theme Three') }}
                </option>
            </select>
        </div>

        @php
            $selected_theme = $setting->selected_theme;
        @endphp

        @if ($selected_theme == 0 || $selected_theme == 1)
            <div class="form-group">
                <label for="">{{ __('Theme One Color') }}</label>
                <input class="form-control" name="theme_one_color" type="color"
                    value="{{ $setting->theme_one_color }}">
            </div>
        @endif

        @if ($selected_theme == 0 || $selected_theme == 2)
            <div class="form-group">
                <label for="">{{ __('Theme Two Color') }}</label>
                <input class="form-control" name="theme_two_color" type="color"
                    value="{{ $setting->theme_two_color }}">
            </div>
        @endif

        @if ($selected_theme == 0 || $selected_theme == 3)
            <div class="form-group">
                <label for="">{{ __('Theme Three Color') }}</label>
                <input class="form-control" name="theme_three_color" type="color"
                    value="{{ $setting->theme_three_color }}">
            </div>
        @endif

        <div class="form-group">
            <label for="">{{ __('Commission Type') }}</label>
            <select class="form-control" id="commission_type" name="commission_type">
                <option
                    value="commission" {{ $setting->commission_type == 'commission' ? 'selected' : '' }}>
                    {{ __('Commission') }}</option>
                <option
                    value="subscription" {{ $setting->commission_type == 'subscription' ? 'selected' : '' }}>
                    {{ __('Subscription') }}</option>
            </select>
        </div>

        <div class="form-group">
            <label for="">{{ __('Live Chat') }}</label>
            <select class="form-control" id="live_chat" name="live_chat">
                <option
                    value="enable" {{ $setting->live_chat == 'enable' ? 'selected' : '' }}>{{ __('Enable') }}
                </option>
                <option
                    value="disable" {{ $setting->live_chat == 'disable' ? 'selected' : '' }}>
                    {{ __('Disable') }}</option>
            </select>
        </div>

        <div class="form-group">
            <label for="">{{ __('Show provider contact info') }}</label>
            <select class="form-control" id="show_provider_contact_info" name="show_provider_contact_info">
                <option
                    value="1" {{ $setting?->show_provider_contact_info == '1' ? 'selected' : '' }}>
                    {{ __('Enable') }}</option>
                <option
                    value="0" {{ $setting?->show_provider_contact_info == '0' ? 'selected' : '' }}>
                    {{ __('Disable') }}</option>
            </select>
        </div>

        <x-admin.update-button :text="__('Update')" />

    </form>
</div>
