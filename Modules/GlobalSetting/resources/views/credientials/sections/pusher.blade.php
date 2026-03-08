<div class="tab-pane fade" id="pusher_tab" role="tabpanel">
    <form action="{{ route('admin.update-pusher') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <x-admin.form-input id="pusher_app_id" name="pusher_app_id" value="{{ $setting->pusher_app_id }}"
                label="{{ __('Pusher App ID') }}" />
        </div>
        <div class="form-group">
            <x-admin.form-input id="pusher_app_key" name="pusher_app_key" value="{{ $setting->pusher_app_key }}"
                label="{{ __('Pusher App Key') }}" />
        </div>
        <div class="form-group">
            <x-admin.form-input id="pusher_app_secret" name="pusher_app_secret"
                value="{{ $setting->pusher_app_secret }}" label="{{ __('Pusher App Secret') }}" />
        </div>
        <div class="form-group">
            <x-admin.form-input id="pusher_app_cluster" name="pusher_app_cluster"
                value="{{ $setting->pusher_app_cluster }}" label="{{ __('Pusher App Cluster') }}" />
        </div>
        <div class="form-group">
            <x-admin.form-switch name="pusher_status" label="{{ __('Status') }}" active_value="active"
                inactive_value="inactive" :checked="$setting->pusher_status == 'active'" />
        </div>
        <x-admin.update-button :text="__('Update')" />

    </form>
</div>
