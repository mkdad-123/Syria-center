<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Event extends Model
{
    use HasTranslations;
    public $translatable = ['title', 'description', 'type', 'location'];

    protected $fillable = [
        'title',
        'description',
        'type',
        'start_date',
        'end_date',
        'location',
        'max_participants',
        'is_published',
        'cover_image'
    ];
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'title' => 'array',
        'description' => 'array',
        'location' => 'array',
        'type' => 'array'
    ];
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

}
