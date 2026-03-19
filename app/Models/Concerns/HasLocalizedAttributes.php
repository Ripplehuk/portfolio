<?php

namespace App\Models\Concerns;

trait HasLocalizedAttributes
{
    protected function getLocalizedValue(string $baseAttribute): mixed
    {
        $locale = app()->getLocale() === 'uz' ? 'uz' : 'en';
        $fallbackLocale = $locale === 'uz' ? 'en' : 'uz';

        $primary = $this->getAttributeFromArray("{$baseAttribute}_{$locale}");
        $fallback = $this->getAttributeFromArray("{$baseAttribute}_{$fallbackLocale}");
        $legacy = $this->getAttributeFromArray($baseAttribute);

        return $primary ?: $fallback ?: $legacy;
    }
}
