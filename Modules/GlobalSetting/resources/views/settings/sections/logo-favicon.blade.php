<div class="tab-pane fade" id="logo_favicon_tab" role="tabpanel">
    <form action="{{ route('admin.update-logo-favicon') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <x-admin.form-image-preview name="logo" :image="$setting->logo" label="{{ __('Existing Logo') }}"
                button_label="{{ __('Update Image') }}" :required="(bool) false" />
        </div>

        <div class="form-group">
            <x-admin.form-image-preview name="favicon" div_id="favicon-preview" label_id="favicon-label"
                input_id="favicon-upload" :image="$setting->favicon" label="{{ __('Existing Favicon') }}"
                button_label="{{ __('Update Image') }}" :required="(bool) false" />
        </div>

        <div class="form-group">
            <x-admin.form-image-preview name="footer_logo" div_id="footer-preview" label_id="footer-label"
                input_id="footer-upload" :image="$setting->footer_logo" label="{{ __('Existing footer') }}"
                button_label="{{ __('Update Image') }}" :required="(bool) false" />
        </div>

        <x-admin.update-button :text="__('Update')" />
    </form>
</div>
