@php
    $maintenance = Cache::remember('maintenance', now()->addDay(), function () {
        $setting_info = Modules\GlobalSetting\app\Models\Setting::whereIn('key', [
            'maintenance_mode',
            'maintenance_title',
            'maintenance_description',
            'maintenance_image',
        ])->get();

        $setting = [];
        foreach ($setting_info as $setting_item) {
            $setting[$setting_item->key] = $setting_item->value;
        }

        $setting = (object) $setting;

        return $setting;
    });
@endphp

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
            content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
            rel="stylesheet">
        <title>{{ $maintenance->maintenance_title }}</title>

        <link href="{{ asset('frontend/css/all.min.css') }}" rel="stylesheet">
        <link href="{{ asset('global/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/dev.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet">

    </head>

    <body>

        <!--============================
        maintenance mode start
    ==============================-->
        <section class="maintenance_mode" id="wsus__404 m-auto">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 col-md-10 col-lg-8 col-xxl-6 m-auto">
                        <div class="wsus__404_text">
                            <img src="{{ asset($maintenance->maintenance_image) }}" alt="" width="150px">
                            <h4 class="heading">{{ $maintenance->maintenance_title }}</h4>
                            <p class="description">{!! clean(nl2br($maintenance->maintenance_description)) !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--============================
        maintenance mode start end
    ==============================-->

    </body>

</html>
