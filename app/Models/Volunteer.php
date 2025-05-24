<?php

namespace App\Models;

use App\Enums\GenderEnum;
use App\Enums\VolunteerAvailabilityEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Volunteer extends Model
{
    use HasFactory , HasTranslations;

    public array $translatable = [
        'name',
        'gender',
        'profession',
        'skills',
        'availability',
        'notes',
        'CV'
    ];

    protected $fillable = [
        'name',
        'email',
        'phone',
        'national_id',
        'birth_date',
        'gender',
        'profession',
        'skills',
        'availability',
        'join_date',
        'is_active',
        'profile_photo',
        'CV',
        'notes'
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

    protected $casts = [
        'skills' => 'array',
        'gender' =>  GenderEnum::class,
        'availability' => VolunteerAvailabilityEnum::class,
    ];
}
