<?php

namespace App\Services\Support;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;

class SettingReader
{

    public function safeGetTranslation($model, string $attribute, string $locale): string
    {
        if (!$model) {
            return __('No content available');
        }

        try {
            $val = $model->getTranslation($attribute, $locale, false)
                ?? $model->$attribute
                ?? '';
        } catch (\Throwable) {
            $val = $model->$attribute ?? '';
        }

        // إن كانت Array (مثل skills)، حوّلها لنص
        if (is_array($val)) {
            $val = implode(', ', array_filter(array_map('trim', $val)));
        }

        $val = trim((string) $val);
        return $val !== '' ? $val : __('No content available');
    }

    /**
     * محتوى الأقسام دائماً نعيده كسلسلة نصية
     */
    public function getSafeContent(?Setting $model, string $locale): string
    {
        if (!$model) {
            return __('No content available');
        }

        $value = null;

        if (method_exists($model, 'getTranslation')) {
            try {
                $value = $model->getTranslation('content', $locale, false);
            } catch (\Throwable) {
                // تجاهل
            }
        }

        if ($value === null) {
            $value = $model->content ?? null;
        }

        if (is_array($value)) {
            // لو كان مخزّن كمصفوفة لأي سبب، نحوله لنص
            return implode(' ', array_map(
                fn($v) => is_string($v) ? $v : '',
                $value
            ));
        }

        if (is_string($value) && $value !== '') {
            return $value;
        }

        if (is_scalar($value)) {
            return (string) $value;
        }

        return __('No content available');
    }

    public function sectionContent(string $section, string $locale): string
    {
        $setting = Setting::where('section', $section)->first();
        return $this->getSafeContent($setting, $locale);
    }

    public function social(): array
    {
        return Setting::getSocialMediaLinks();
    }

    public function contact(): array
    {
        return Setting::getContactInfo();
    }

     public function getTranslatedValue($value, string $locale, ?string $fallback = null): string
    {
        $fallback = $fallback ?: config('app.fallback_locale', 'en');

        if (is_null($value)) {
            return '';
        }

        // لو القيمة JSON string حاول فكّها
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $value = $decoded;
            } else {
                // نص عادي غير متعدد اللغات
                return $value;
            }
        }

        // لو القيمة Arrayable/ArrayObject حوّلها إلى مصفوفة
        if ($value instanceof Arrayable) {
            $value = $value->toArray();
        } elseif ($value instanceof ArrayObject) {
            $value = $value->getArrayCopy();
        }

        if (is_array($value)) {
            // النص حسب اللغة
            if (array_key_exists($locale, $value) && filled($value[$locale])) {
                return (string) $value[$locale];
            }
            // فallback
            if ($fallback && array_key_exists($fallback, $value) && filled($value[$fallback])) {
                return (string) $value[$fallback];
            }
            // أول قيمة غير فاضية
            foreach ($value as $v) {
                if (filled($v)) {
                    return (string) $v;
                }
            }
            return '';
        }

        // أي نوع آخر نحوله لنص
        return (string) $value;
    }

    // Alias قصير لو حبيت تستخدمه
    public function t($value, string $locale, ?string $fallback = null): string
    {
        return $this->getTranslatedValue($value, $locale, $fallback);
    }
}
