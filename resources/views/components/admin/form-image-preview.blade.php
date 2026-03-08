@props([
    'div_id' => 'image-preview',
    'label_id' => 'image-label',
    'input_id' => 'image-upload',
    'name' => 'image',
    'label' => __('Thumbnail Image'),
    'button_label' => __('Upload Image'),
    'required' => true,
    'image' => null,
    'disabled' => false,
])

<label>
    {{ $label }} @if ($required)
        <span class="text-danger">*</span>
    @endif
</label>
<div id="{{ $div_id }}" {{ $attributes->merge(['class' => 'image-preview']) }}
    @if ($image) style="background-image: url({{ asset($image) }});" @endif>
    <label id="{{ $label_id }}" for="{{ $input_id }}">{{ $button_label }}</label>
    <input id="{{ $input_id }}" name="{{ $name }}" type="file" {{ $disabled !== false ? 'disabled' : '' }}>
</div>
@error($name)
    <span class="text-danger">{{ $message }}</span>
@enderror
