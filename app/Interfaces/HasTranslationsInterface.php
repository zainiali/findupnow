<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

interface HasTranslationsInterface
{
    /**
     * Get all translations for the model.
     *
     * @return HasMany
     */
    public function translations(): HasMany;

    /**
     * Get the translation for the current locale.
     *
     * @return HasOne|null
     */
    public function translation(): HasOne | null;

    /**
     * Get the translation for the specified locale.
     *
     * @param  string        $code
     * @return HasOne|null
     */
    public function getTranslation(string $code);
}
