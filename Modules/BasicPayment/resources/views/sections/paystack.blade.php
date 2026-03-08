<div class="tab-pane fade" id="paystack_tab" role="tabpanel">
    <form action="{{ route('admin.paystack-update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="form-group col-md-12">
                <x-admin.form-input id="paystack_charge" name="paystack_charge"
                    value="{{ $payment_setting->paystack_charge }}" label="{{ __('Gateway charge') }}(%)" />
            </div>
            <div class="form-group col-md-12">
                @if (env('APP_MODE') == 'DEMO')
                    <x-admin.form-input id="paystack_public_key" name="paystack_public_key"
                        value="paystack-test-348949439-public-key" label="{{ __('Public key') }}" required="true" />
                @else
                    <x-admin.form-input id="paystack_public_key" name="paystack_public_key"
                        value="{{ $payment_setting->paystack_public_key }}" label="{{ __('Public key') }}"
                        required="true" />
                @endif
            </div>

            <div class="form-group col-md-12">
                @if (env('APP_MODE') == 'DEMO')
                    <x-admin.form-input id="paystack_secret_key" name="paystack_secret_key"
                        value="paystack-test-8384934-key-secret" label="{{ __('Secret key') }}" required="true" />
                @else
                    <x-admin.form-input id="paystack_secret_key" name="paystack_secret_key"
                        value="{{ $payment_setting->paystack_secret_key }}" label="{{ __('Secret key') }}"
                        required="true" />
                @endif
            </div>

        </div>

        <div class="form-group">
            <x-admin.form-image-preview name="paystack_image" div_id="paystack_image_preview"
                label_id="paystack_image_label" input_id="paystack_image_upload" :image="$payment_setting->paystack_image"
                label="{{ __('Existing Image') }}" button_label="{{ __('Update Image') }}" required="0" />
        </div>
        <div class="form-group">
            <x-admin.form-switch name="paystack_status" label="{{ __('Status') }}" active_value="active"
                inactive_value="inactive" :checked="$payment_setting->paystack_status == 'active'" />
        </div>

        <x-admin.update-button :text="__('Update')" />
    </form>
</div>
