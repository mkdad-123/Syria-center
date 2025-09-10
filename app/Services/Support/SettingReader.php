<?php

namespace App\Services\Support;

use App\Models\Setting;

class SettingReader
{
    public function sectionContent(string $section, string $locale): string
    {
        $s = Setting::where('section', $section)->first();
        return $this->getSafeContent($s, $locale);
    }

    public function social(): array
    {
        return Setting::getSocialMediaLinks();
    }

    public function contact(): array
    {
        return Setting::getContactInfo();
    }

    public function safeGetTranslation($model, string $attribute, string $locale): string
    {
        if (!$model) return __('No content available');

        try {
            return $model->getTranslation($attribute, $locale, false)
                ?? $model->$attribute
                ?? __('No content available');
        } catch (\Throwable) {
            return $model->$attribute ?? __('No content available');
        }
    }

    public function getSafeContent(?Setting $model, string $locale): string
    {
        if (!$model) return __('No content available');

        try {
            return $model->getTranslation('content', $locale, false)
                ?? $model->content
                ?? __('No content available');
        } catch (\Throwable) {
            return $model->content ?? __('No content available');
        }
    }

    public function getTranslatedValue($value, string $locale): string
    {
        if (is_string($value) && $decoded = json_decode($value, true)) {
            return $decoded[$locale] ?? 'No content available';
        }
        if (is_array($value)) {
            return $value[$locale] ?? 'No content available';
        }
        return $value ?? 'No content available';
    }
}
