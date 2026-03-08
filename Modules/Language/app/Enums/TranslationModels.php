<?php

namespace Modules\Language\app\Enums;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

enum TranslationModels: string {
    /**
     * whenever update new case also update getAll() method
     * to return all values in array
     */
    case Menu                            = "Modules\CustomMenu\app\Models\MenuTranslation";
    case MenuItem                        = "Modules\CustomMenu\app\Models\MenuItemTranslation";
    case CustomizablePage                = "Modules\PageBuilder\app\Models\CustomizablePageTranslation";
    case CATEGORY                        = "App\Models\CategoryTranslation";
    case SECTION_CONTENT_TRANSLATION     = "App\Models\SectionContentTranslation";
    case SLIDER_TRANSLATION              = "App\Models\SliderTranslation";
    case MOBILE_SLIDER_TRANSLATION       = "App\Models\MobileSliderTranslation";
    case COUNTER_TRANSLATION             = "App\Models\CounterTranslation";
    case TESTIMONIAL_TRANSLATION         = "App\Models\TestimonialTranslation";
    case SETTING_TRANSLATION             = "App\Models\SettingTranslation";
    case FOOTER_TRANSLATION              = "App\Models\FooterTranslation";
    case ABOUT_US_TRANSLATION            = "App\Models\AboutUsTranslation";
    case HOW_IT_WORK_TRANSLATION         = "App\Models\HowItWorkTranslation";
    case TERMS_AND_CONDITION_TRANSLATION = "App\Models\TermsAndConditionTranslation";
    case FAQ_TRANSLATION                 = "App\Models\FaqTranslation";

    public static function getAll(): array
    {
        return array_merge([
            self::Menu->value,
            self::MenuItem->value,
            self::CustomizablePage->value,
            self::CATEGORY->value,
            self::SECTION_CONTENT_TRANSLATION->value,
            self::SLIDER_TRANSLATION->value,
            self::MOBILE_SLIDER_TRANSLATION->value,
            self::COUNTER_TRANSLATION->value,
            self::TESTIMONIAL_TRANSLATION->value,
            self::SETTING_TRANSLATION->value,
            self::FOOTER_TRANSLATION->value,
            self::ABOUT_US_TRANSLATION->value,
            self::HOW_IT_WORK_TRANSLATION->value,
            self::TERMS_AND_CONDITION_TRANSLATION->value,
            self::FAQ_TRANSLATION->value,
        ], self::getDynamicTranslatableModels());
    }

    /**
     * @return mixed
     */
    protected static function getDynamicTranslatableModels(): array
    {
        return Cache::remember('dynamic_translatable_models', now()->addHours(1), function () {
            $dynamicModels = [];
            $modulesPath   = base_path('Modules');

            foreach (File::directories($modulesPath) as $moduleDir) {
                $configPath = $moduleDir . '/wsus.json';

                if (File::exists($configPath)) {
                    $config = json_decode(File::get($configPath), true);

                    // Check if 'translate' is true and 'translate_models' exists as an array
                    if (!empty($config['options']['translate']) && $config['options']['translate'] === true) {
                        $translateModels = $config['options']['translate_models'] ?? [];
                        if (is_array($translateModels)) {
                            foreach ($translateModels as $model) {
                                $dynamicModels[] = $model;
                            }
                        }
                    }
                }
            }

            return $dynamicModels;
        });
    }

    public static function ignoreColumns(): array
    {
        return [
            'id',
            'lang_code',
            'created_at',
            'updated_at',
            'deleted_at',
        ];
    }
}
