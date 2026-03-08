<?php

namespace Modules\Language\app\Traits;

use Modules\Language\app\Enums\TranslationModels;

trait TranslateableModelsTrait
{
    public function getTranslatableModelsArray(): array
    {
        return TranslationModels::getAll();
    }

    public function getIgnoredColumnsArray(): array
    {
        return TranslationModels::ignoreColumns();
    }
}
