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
        'address',
        'working_hours'
    ];

    protected $fillable = [
        'key',
        'title',
        'content',
        'image',
        'extra',
        'section',
        'address',
        'working_hours'
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

        return array_merge($defaults, $setting->extra);
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

        // تأكد من أن القيم الأساسية هي مصفوفات
        $extra = $setting->extra;

        // معالجة الإيميلات (كما في السابق)
        if (!isset($extra['emails']) || !is_array($extra['emails'])) {
            $extra['emails'] = [];
        }

        foreach ($extra as $key => $value) {
            if (str_starts_with($key, 'email') && is_string($value)) {
                if (!in_array($value, $extra['emails'])) {
                    $extra['emails'][] = $value;
                }
            }
        }

        // معالجة أرقام الهواتف (phones)
        if (!isset($extra['phones']) || !is_array($extra['phones'])) {
            $extra['phones'] = [];
        }

        foreach ($extra as $key => $value) {
            if (str_starts_with($key, 'phone') && is_string($value)) {
                if (!in_array($value, $extra['phones'])) {
                    $extra['phones'][] = $value;
                }
            }
        }

        // معالجة الأرقام المحمولة (mobile_numbers)
        if (!isset($extra['mobile_numbers']) || !is_array($extra['mobile_numbers'])) {
            $extra['mobile_numbers'] = [];
        }

        foreach ($extra as $key => $value) {
            if (str_starts_with($key, 'mobile_number') && is_string($value)) {
                if (!in_array($value, $extra['mobile_numbers'])) {
                    $extra['mobile_numbers'][] = $value;
                }
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
