@php
    $selected_theme = Session::get('selected_theme');
    if ($selected_theme == 'theme_one') {
        $color = $setting->theme_one_color;
    } elseif ($selected_theme == 'theme_two') {
        $color = $setting->theme_two_color;
    } elseif ($selected_theme == 'theme_three') {
        $color = $setting->theme_three_color;
    } else {
        $color = $setting->theme_one_color;
    }
@endphp

<style>
    .search_form {
        background: {{ $color }} !important;
    }

    :root {
        --colorPrimary: {{ $color }} !important;
    }
</style>
