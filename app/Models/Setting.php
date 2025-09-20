<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'settings';

    public $translatable = ['title', 'content'];

    // لا نذكر 'key' لأن الجدول لا يحتوي هذا العمود
    protected $fillable = ['title', 'content', 'image', 'extra', 'section'];

    protected $casts = [
        'extra'   => 'array',
        'section' => 'string',   // نتجنّب الـ Enum لأن القيمة عندك نص حر مثل "about us"
    ];

    /**
     * أول سجل لقسم "من نحن" (ندعم بعض الصيغ المحتملة في القيمة)
     */
    public static function firstAboutUs(): ?self
    {
        $sections = ['about us', 'about-us', 'about_us', 'about', 'aboutus'];

        return self::query()
            ->where(function ($q) use ($sections) {
                foreach ($sections as $s) {
                    $q->orWhere('section', $s);
                }
            })
            ->first();
    }

    /**
     * روابط السوشيال مع قيم افتراضية
     */
    public static function getSocialMediaLinks(): array
    {
        $setting = self::firstAboutUs();

        $links = [
            'facebook' => '#',
            'instagram' => '#',
            'twitter'  => '#',
            'youtube'  => '#',
            'linkedin' => '#',
        ];

        $extra = is_array($setting?->extra) ? $setting->extra : [];

        // extra متوقع تكون مصفوفة عناصر من نوع ['key' => ..., 'value' => ...]
        foreach ($extra as $item) {
            if (is_array($item) && isset($item['key'], $item['value'])) {
                $k = strtolower($item['key']);
                if (isset($links[$k])) {
                    $links[$k] = $item['value'];
                }
            }
        }

        return $links;
    }

    /**
     * معلومات التواصل مع قيم افتراضية
     */
    public static function getContactInfo(): array
    {
        $setting = self::firstAboutUs();

        $data = [
            'emails'         => [],
            'phones'         => [],
            'mobile_numbers' => [],
            'address'        => __('Damascus, Syria'),
            'working_hours'  => __('9:00 AM - 5:00 PM'),
            'instagram'      => '',
        ];

        $extra = is_array($setting?->extra) ? $setting->extra : [];

        foreach ($extra as $item) {
            if (!is_array($item) || !isset($item['key'], $item['value'])) {
                continue;
            }
            switch ($item['key']) {
                case 'Email':
                    $data['emails'][] = $item['value'];
                    break;
                case 'Phone':
                    $data['phones'][] = $item['value'];
                    break;
                case 'Address':
                    $data['address']  = $item['value'];
                    break;
                case 'Instagram':
                    $data['instagram'] = $item['value'];
                    break;
            }
        }

        return $data;
    }

    public function getExtraValue(string $key, mixed $default = null): mixed
    {
        $extra = is_array($this->extra) ? $this->extra : [];
        return $extra[$key] ?? $default;
    }

    public function setExtraValue(string $key, mixed $value): void
    {
        $extra = is_array($this->extra) ? $this->extra : [];
        $extra[$key] = $value;
        $this->extra = $extra;
    }

    /**
     * كاش مبسّط بدون الاعتماد على عمود غير موجود
     */
    public static function cached(): array
    {
        return Cache::remember('settings', now()->addDay(), function () {
            return self::all()->toArray(); // لا نستخدم keyBy('key')
        });
    }

    public static function getCached(string $key): ?array
    {
        $rows = self::cached();
        foreach ($rows as $row) {
            if (($row['section'] ?? null) === $key) {
                return $row;
            }
        }
        return null;
    }
}
