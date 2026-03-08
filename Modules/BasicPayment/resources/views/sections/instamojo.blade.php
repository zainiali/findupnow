<div class="tab-pane fade" id="instamojo_tab" role="tabpanel">
    <form action="{{ route('admin.instamojo-update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="form-group col-md-6">
                <x-admin.form-input id="instamojo_charge" name="instamojo_charge"
                    value="{{ $payment_setting->instamojo_charge }}" label="{{ __('Gateway charge') }}(%)" />
            </div>

            <div class="form-group col-md-6">
                <x-admin.form-select class="form-select" id="instamojo_account_mode" name="instamojo_account_mode"
                    label="{{ __('Account Mode') }}" required="true">
                    <x-admin.select-option value="live" :selected="$payment_setting->instamojo_account_mode == 'live'" text="{{ __('Live') }}" />
                    <x-admin.select-option value="sandbox" :selected="$payment_setting->instamojo_account_mode == 'sandbox'" text="{{ __('Sandbox') }}" />
                </x-admin.form-select>
            </div>

            <div class="form-group col-md-6">
                <label class="form-label" for="">{{ __('Client ID') }}</label>
                <input class="form-control" name="instamojo_client_id" type="text"
                    value="{{ $payment_setting->instamojo_client_id }}">
            </div>

            <div class="form-group col-md-6">
                <label class="form-label" for="">{{ __('Client Secret') }}</label>
                <input class="form-control" name="instamojo_client_secret" type="text"
                    value="{{ $payment_setting->instamojo_client_secret }}">
            </div>

        </div>

        <div class="form-group">
            <x-admin.form-image-preview name="instamojo_image" div_id="instamojo_image_preview"
                label_id="instamojo_image_label" input_id="instamojo_image_upload" :image="$payment_setting->instamojo_image"
                label="{{ __('Existing Image') }}" button_label="{{ __('Update Image') }}" required="0" />
        </div>
        <div class="form-group">
            <x-admin.form-switch name="instamojo_status" label="{{ __('Status') }}" active_value="active"
                inactive_value="inactive" :checked="$payment_setting->instamojo_status == 'active'" />
        </div>

        <x-admin.update-button :text="__('Update')" />
    </form>
</div>
