<?php

namespace App\Models;

use App\Enums\SectionEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Http\Controllers\ShowController;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = [
        'title',
        'content',

    ];

    protected $fillable = [
        'key',
        'title',
        'content',
        'image',
        'extra',
        'section',

    ];

    protected $casts = [
        'extra' => 'array',

        'section' => SectionEnum::class,
    ];

    /**
     * الحصول على روابط السوشيال ميديا مع قيم افتراضية آمنة
     */
  public static function getSocialMediaLinks()
{
    $setting = self::where('section', 'about us')->first();

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

    $socialLinks = $defaults;

    foreach ($setting->extra as $item) {
        if (in_array($item['key'], ['Facebook', 'Instagram', 'Twitter', 'Youtube', 'Linkedin'])) {
            $key = strtolower($item['key']);
            $socialLinks[$key] = $item['value'];
        }
    }

    return $socialLinks;
}

    /**
     * الحصول على معلومات التواصل مع قيم افتراضية آمنة
     */
  public static function getContactInfo()
{
    $setting = self::where('section', 'about us')->first();

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

    $extra = [
        'emails' => [],
        'phones' => [],
        'mobile_numbers' => [],
        'address' => '',
        'instagram' => ''
    ];

    foreach ($setting->extra as $item) {
        switch ($item['key']) {
            case 'Email':
                $extra['emails'][] = $item['value'];
                break;
            case 'Phone':
                $extra['phones'][] = $item['value'];
                break;
            case 'Address':
                $extra['address'] = $item['value'];
                break;
            case 'Instagram':
                $extra['instagram'] = $item['value'];
                break;
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
