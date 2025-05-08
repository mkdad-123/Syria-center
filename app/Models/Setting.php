<?php

namespace App\Models;
use App\Enums\SectionEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    use HasTranslations;

    public $translatable = [
        'title',
        'content',
        'extra',
        'address', 'working_hours'
    ];

    protected $fillable = [
        'key',
        'title',
        'content',
        'image',
        'extra',
        'section',
        'address', 'working_hours'
    ];

    protected $casts = [
        'extra' => 'array',
        'title' => 'array',
        'content' => 'array',
        'section' => SectionEnum::class,
    ];

    /**
     * الحصول على روابط السوشيال ميديا مع قيم افتراضية آمنة
     */
    public static function getSocialMediaLinks()
    {
        $setting = self::where('section', 'social_media')->first();

        $defaults = [
            'facebook' => '#',
            'instagram' => '#',
            'twitter' => '#',
            'youtube' => '#',
            'linkedin' => '#'
        ];

        if (!$setting || !is_array($setting->extra)) {
            return $defaults;
        }

        return array_merge($defaults, $setting->extra);
    }

    /**
     * الحصول على معلومات التواصل مع قيم افتراضية آمنة
     */
    public static function getContactInfo()
    {
        $setting = self::where('section', 'contact_info')->first();

        $defaults = [
            'emails' => ['info@example.com'],
            'phones' => ['123-456-789'],
            'mobile_numbers' => [],
            'address' => __('Damascus, Syria'),
            'working_hours' => __('9:00 AM - 5:00 PM')
        ];

        if (!$setting || !is_array($setting->extra)) {
            return $defaults;
        }

        // تأكد من أن القيم الأساسية هي مصفوفات
        $extra = $setting->extra;
        foreach (['emails', 'phones', 'mobile_numbers'] as $arrayField) {
            if (isset($extra[$arrayField]) && !is_array($extra[$arrayField])) {
                $extra[$arrayField] = (array)$extra[$arrayField];
            }
        }

        return array_merge($defaults, $extra);
    }
    /**
     * الحصول على قيمة من الحقل extra
     */
    public function getExtraValue(string $key, mixed $default = null): mixed
    {
        return $this->extra[$key] ?? $default;
    }

    /**
     * تحديث قيمة في الحقل extra
     */
    public function setExtraValue(string $key, mixed $value): void
    {
        $extra = $this->extra ?? [];
        $extra[$key] = $value;
        $this->extra = $extra;
    }

    /**
     * تخزين الإعدادات في الكاش لتحسين الأداء
     */
    public static function cached(): array
    {
        return Cache::remember('settings', now()->addDay(), function () {
            return self::all()->keyBy('key')->toArray();
        });
    }

    /**
     * الحصول على إعدادات من الكاش
     */
    public static function getCached(string $key): ?array
    {
        return self::cached()[$key] ?? null;
    }
}
