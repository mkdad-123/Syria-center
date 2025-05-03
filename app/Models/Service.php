<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Service extends Model
{
    public $translatable = ['description','name'];

    protected $fillable = [
        'name' ,
        'description' ,
        'section_id'
    ];
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
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
public function getTranslatedAttribute($attribute, $locale = null)
{
    $locale = $locale ?: app()->getLocale();
    
    // If the attribute is not translatable, return its normal value
    if (!in_array($attribute, $this->translatable)) {
        return $this->{$attribute};
    }

    // Get the translations array
    $translations = $this->{$attribute};
    
    // If translations is a JSON string, decode it
    if (is_string($translations)) {
        $translations = json_decode($translations, true) ?? [];
    }

    // Return the translation for the current locale or fallback to the first available
    return $translations[$locale] ?? 
           $translations[app()->getFallbackLocale()] ?? 
           $this->{$attribute};
}
}
