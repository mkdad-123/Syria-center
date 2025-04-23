<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'title',
        'content',
        'image',
        'extra',
    ];

    protected $casts = [
      'extra' => 'array'
    ];

    /***
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     *
     * get value of extra
     */
    public function getExtraValue(string $key, mixed $default = null): mixed
    {
        return $this->extra[$key] ?? $default;
    }

    /***
     * @param string $key
     * @param mixed $value
     * @return void
     *
     * update value of extra
     */
    public function setExtraValue(string $key, mixed $value): void
    {
        $extra = $this->extra ?? [];
        $extra[$key] = $value;
        $this->extra = $extra;
    }

    /***
     * @return array
     *
     * cache to optimization
     */
    public static function cached(): array
    {
        return Cache::remember('settings', now()->addDay(), function () {
            return self::all()->keyBy('key')->toArray();
        });
    }

    /***
     * @param string $key
     * @return array|null
     *
     * get values from cache
     */
    public static function getCached(string $key): ?array
    {
        return self::cached()[$key] ?? null;
    }
}
