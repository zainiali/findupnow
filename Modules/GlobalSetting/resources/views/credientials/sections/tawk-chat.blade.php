<div class="tab-pane fade" id="tawk_chat_tab" role="tabpanel">
    <form action="{{ route('admin.update-tawk-chat') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="live_chat">{{ __('Live Chat') }}</label>
            <select class="form-select" id="live_chat" name="live_chat">
                <option value="">{{ __('Select Status') }}</option>
                <option value="enable" {{ $setting->live_chat == 'enable' ? 'selected' : '' }}>
                    {{ __('Enable') }}</option>
                <option value="disable" {{ $setting->live_chat == 'disable' ? 'selected' : '' }}>
                    {{ __('Disable') }}</option>
            </select>
        </div>
        <div class="form-group">
            <x-admin.form-input id="tawk_chat_link" name="tawk_chat_link" value="{{ $setting->tawk_chat_link }}"
                label="{{ __('Tawk Chat Link') }}" />
        </div>
        <div class="form-group">
            <x-admin.form-switch name="tawk_status" label="{{ __('Status') }}" active_value="active"
                inactive_value="inactive" :checked="$setting->tawk_status == 'active'" />
        </div>
        <x-admin.update-button :text="__('Update')" />
    </form>
</div>
