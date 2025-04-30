<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'content', 'extra'];
    protected $fillable = ['key', 'title', 'content', 'image', 'extra', 'section'];
    protected $casts = ['extra' => 'array', 'title' => 'array', 'content' => 'array'];

    /**

     * الحصول على روابط السوشيال ميديا
     */
    public static function getSocialMediaLinks()
    {
        $setting = self::where('section', 'social_media')->first();
        return $setting ? $setting->extra : [
            'facebook' => null,
            'instagram' => null,
            'twitter' => null,
            'youtube' => null,
            'linkedin' => null
        ];
    }

    /**
     * الحصول على معلومات التواصل
     */
    public static function getContactInfo()
    {
        $setting = self::where('section', 'contact_info')->first();
        return $setting ? $setting->extra : [
            'emails' => [],
            'phones' => [],
            'mobile_numbers' => [],
            'address' => null,
            'working_hours' => null
        ];
    }

    /**
     * الحصول على المحتوى المترجم
     */
    public function getTranslatedContent($locale, $default = null)
    {
        try {
            return $this->getTranslation('content', $locale, false) 
                   ?? $this->content 
                   ?? $default 
                   ?? __('No content available');
        } catch (\Exception $e) {
            return $this->content ?? $default ?? __('No content available');
        }
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