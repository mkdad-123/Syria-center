<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $translatable = ['description' , 'title' ,'type' , 'location' ,'max_participants'];

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
