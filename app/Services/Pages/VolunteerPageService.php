<?php

namespace App\Services\Pages;

use App\Models\Volunteer;
use App\Services\Contracts\PageSectionService;
use App\Services\Support\SettingReader;

class VolunteerPageService implements PageSectionService
{
    public function __construct(private SettingReader $reader) {}

    public function render(string $locale, array $params = []): string
    {
        app()->setLocale($locale);

        $id = (int)($params['volunteer_id'] ?? 0);
        $v  = Volunteer::findOrFail($id);

        $volunteer = [
            'id'            => $v->id,
            'name'          => $this->reader->safeGetTranslation($v, 'name', $locale),
            'email'         => $v->email,
            'phone'         => $v->phone,
            'national_id'   => $v->national_id,
            'birth_date'    => $v->birth_date,
            'gender'        => $this->reader->safeGetTranslation($v, 'gender', $locale),
            'profession'    => $this->reader->safeGetTranslation($v, 'profession', $locale),
            'skills'        => $this->reader->safeGetTranslation($v, 'skills', $locale),
            'availability'  => $this->reader->safeGetTranslation($v, 'availability', $locale),
            'join_date'     => $v->join_date,
            'is_active'     => $v->is_active,
            'profile_photo' => $v->profile_photo,
            'CV'            => $this->reader->safeGetTranslation($v, 'CV', $locale),
            'notes'         => $this->reader->safeGetTranslation($v, 'notes', $locale),
        ];

        return view('volunteer', [
            'volunteer'  => $volunteer,
            'locale'     => $locale,
            'socialMedia'=> $this->reader->social(),
            'contactInfo'=> $this->reader->contact(),
        ])->render();
    }
}
