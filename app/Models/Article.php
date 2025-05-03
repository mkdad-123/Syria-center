<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Article extends Model
{

    use HasTranslations;


    protected $table = 'articles';
    protected $fillable = ['content', 'service_id', 'title'];
    public $translatable = ['title' , 'content' ];



    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
    public function getTranslatedAttribute($attribute, $locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        
        if (!in_array($attribute, $this->translatable)) {
            return $this->{$attribute};
        }

        $translations = json_decode($this->{$attribute}, true) ?? [];
        
        return $translations[$locale] ?? 
               $translations[config('app.fallback_locale')] ?? 
               $this->{$attribute};
    }

    public function getTranslatedContent($locale, $default = null)
    {
        try {
            $translations = json_decode($this->content, true) ?? [];
            return $translations[$locale] ?? 
                   $translations[config('app.fallback_locale')] ?? 
                   $this->content ?? 
                   $default ?? 
                   __('No content available');
        } catch (\Exception $e) {
            return $this->content ?? $default ?? __('No content available');
        }
    }

}
