<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Event;
use App\Models\Partner;
use App\Models\Section;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class ShowController extends Controller
{

    public function showHomePage(Request $request)
    {
        $locale = $request->has('lang') ? $request->lang : 'ar';
        $cacheKey = $this->generateCacheKey($locale);

        $forceRefresh = $request->has('refresh') && $request->refresh == 'true';
        return Cache::remember($cacheKey, now()->addHours(24), function () use ($locale) {
            return $this->generateHomePageData($locale);
        }, $forceRefresh);
    }

    protected function generateCacheKey($locale)
    {
        $lastModified = collect([
            Setting::max('updated_at'),
            Volunteer::max('updated_at'),
            Partner::max('updated_at')
        ])->filter()
            ->map(fn($date) => is_string($date) ? Carbon::parse($date) : $date)
            ->max();

        $key = "home_page_{$locale}";

        return $lastModified ? "{$key}_{$lastModified->timestamp}" : $key;
    }

    protected function generateHomePageData($locale)
    {
        app()->setLocale($locale);

        // جلب البيانات (مثال محسن)
        $data = [
            'locale' => $locale,
            'aboutUs' => $this->getSectionContent('about-us', $locale),
            'targetgroup' => $this->getSectionContent('target-group', $locale),
            'message' => $this->getSectionContent('message', $locale),
            'vision' => $this->getSectionContent('vision', $locale),
            'team' => $this->getTeamData($locale),
            'partners' => $this->getPartnersData($locale),
            'socialMedia' => Setting::getSocialMediaLinks(),
            'contactInfo' => Setting::getContactInfo()
        ];

        // توليد محتوى الـ Blade وتخزينه
        return view('welcome', $data)->render();
    }

    protected function getSectionContent($section, $locale)
    {
        $setting = Setting::where('section', $section)->first();
        return $this->getSafeContent($setting, $locale);
    }

    protected function getTeamData($locale)
    {
        return Volunteer::all()->map(function ($member) use ($locale) {
            return [
                'id' => $member->id,
                'name' => $this->safeGetTranslation($member, 'name', $locale),
                'skills' => $this->safeGetTranslation($member, 'skills', $locale),
                'bio' => $this->safeGetTranslation($member, 'notes', $locale),
                'image' => $member->profile_photo ?? 'default-member.jpg'
            ];
        });
    }

    protected function getPartnersData($locale)
    {
        return Partner::all()->map(function ($partner) use ($locale) {
            return [
                'id' => $partner->id,
                'name' => $this->safeGetTranslation($partner, 'name', $locale),
                'description' => $this->safeGetTranslation($partner, 'description', $locale),
                'image' => $partner->image ?? 'default-partner.jpg'
            ];
        });
    }
    private function safeGetTranslation($model, $attribute, $locale)
    {
        if (!$model) {
            return __('No content available');
        }

        try {
            return $model->getTranslation($attribute, $locale, false)
                ?? $model->$attribute
                ?? __('No content available');
        } catch (\Exception $e) {
            return $model->$attribute ?? __('No content available');
        }
    }

    private function getSafeContent($model, $locale)
    {
        if (!$model) {
            return __('No content available');
        }

        try {
            return $model->getTranslation('content', $locale, false)
                ?? $model->content
                ?? __('No content available');
        } catch (\Exception $e) {
            return $model->content ?? __('No content available');
        }
    }

    public function showAbout_usPage(Request $request)
    {
        $locale = $request->has('lang') ? $request->lang : 'ar';

        // Generate cache key based on locale and last modification
        $cacheKey = $this->generateAboutUsCacheKey($locale);

        // Check for force refresh request
        $forceRefresh = $request->has('refresh') && $request->refresh == 'true';

        // Use remember() with force refresh capability
        return Cache::remember($cacheKey, now()->addHours(24), function () use ($locale) {
            return $this->generateAboutUsPageData($locale);
        }, $forceRefresh);
    }

    protected function generateAboutUsCacheKey($locale)
    {
        // Get last modified time for about-us section
        $lastModified = Setting::where('section', 'about-us')
            ->max('updated_at');

        // Create unique cache key
        $key = "about_us_page_{$locale}";

        $lastModified = Carbon::parse($lastModified);
        return $lastModified ? "{$key}_{$lastModified->timestamp}" : $key;
    }

    protected function generateAboutUsPageData($locale)
    {
        app()->setLocale($locale);

        // Get about-us content with null safety
        $aboutUs = Setting::where('section', 'about-us')->first();

        if (!$aboutUs) {
            return view('about-us', [
                'locale' => $locale,
                'aboutUs' => "",
                'socialMedia' => [],
                'contactInfo' => [],
                'image' => "",
            ])->render();
        }

        // Prepare data
        $data = [
            'locale' => $locale,
            'aboutUs' => $this->getSafeContent($aboutUs, $locale),
            'socialMedia' => Setting::getSocialMediaLinks(),
            'contactInfo' => Setting::getContactInfo(),
            'image' => $aboutUs->image,
        ];

        // Generate and return rendered view
        return view('about-us', $data)->render();
    }

    public function showEventsPage(Request $request)
    {
        $locale = $request->has('lang') ? $request->lang : 'ar';

        // Generate cache key based on locale and events modification
        $cacheKey = $this->generateEventsCacheKey($locale);

        // Check for force refresh request
        $forceRefresh = $request->has('refresh') && $request->refresh == 'true';

        // Use remember() with force refresh capability
        return Cache::remember($cacheKey, now()->addHours(24), function () use ($locale) {
            return $this->generateEventsPageData($locale);
        }, $forceRefresh);
    }

    protected function generateEventsCacheKey($locale)
    {
        // Get last modified time for published events
        $lastModified = Event::where('is_published', '1')
            ->max('updated_at');

        // Create unique cache key
        $key = "events_page_{$locale}";

        return $lastModified ? "{$key}_{$lastModified->timestamp}" : $key;
    }

    protected function generateEventsPageData($locale)
    {
        app()->setLocale($locale);

        // Get published events with formatted data
        $events = Event::where('is_published', '1')
            ->orderByDesc('id')
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'description' => $event->description,
                    'type' => $event->type,
                    'start_date' => $event->start_date,
                    'end_date' => $event->end_date,
                    'location' => $event->location,
                    'max_participants' => $event->max_participants,
                    'cover_image' => $event->cover_image,
                    'created_at' => $event->created_at,
                    'updated_at' => $event->updated_at
                ];
            });

        // Generate and return rendered view
        return view('events', [
            'events' => $events,
            'locale' => $locale,
            'socialMedia' => Setting::getSocialMediaLinks(), // Added social media
            'contactInfo' => Setting::getContactInfo() // Added contact info
        ])->render();
    }

    protected function getTranslatedValue($value, $locale)
    {
        // If the value is a JSON string containing translations
        if (is_string($value) && $decoded = json_decode($value, true)) {
            return $decoded[$locale] ?? 'No content available';
        }

        // If it's already an array (if using casts)
        if (is_array($value)) {
            return $value[$locale] ?? 'No content available';
        }

        // If no translation exists, return the raw value
        return $value ?? 'No content available';
    }
    public function showSectionsPage(Request $request)
    {
        $locale = $request->has('lang') ? $request->lang : 'ar';

        // مفتاح الكاش الفريد
        $cacheKey = $this->generateSectionsCacheKey($locale);

        // إمكانية التحديث القسري
        $forceRefresh = $request->has('refresh') && $request->refresh == 'true';

        return Cache::remember($cacheKey, now()->addHours(24), function () use ($locale) {
            return $this->generateSectionsPageData($locale);
        }, $forceRefresh);
    }

    protected function generateSectionsCacheKey($locale)
    {
        // آخر تحديث للأقسام أو الخدمات
        $lastModified = max(
            Section::max('updated_at'),
            Service::max('updated_at')
        );

        $key = "sections_page_{$locale}";

        if ($lastModified && is_string($lastModified)) {
            $lastModified = Carbon::parse($lastModified);
        }
        return $lastModified ? "{$key}_{$lastModified->timestamp}" : $key;
    }

    protected function generateSectionsPageData($locale)
    {
        app()->setLocale($locale);

        $sections = Section::with('services')
            ->get()
            ->map(function ($section) use ($locale) {
                return [
                    'id' => $section->id,
                    'name' => $this->getTranslatedValue($section->name, $locale),
                    'description' => $this->getTranslatedValue($section->description, $locale),
                    'image' => $section->image,
                    'services' => $section->services->map(function ($service) use ($locale) {
                        return [
                            'id' => $service->id,
                            'name' => $this->getTranslatedValue($service->name, $locale),
                            'description' => $this->getTranslatedValue($service->description, $locale),
                        ];
                    }),
                    'created_at' => $section->created_at,
                    'updated_at' => $section->updated_at
                ];
            });

        return view('sections', [
            'sections' => $sections,
            'locale' => $locale,
            'socialMedia' => Setting::getSocialMediaLinks(),
            'contactInfo' => Setting::getContactInfo()
        ])->render();
    }

    public function showServicesPage(Request $request, $id)
    {
        $locale = $request->get('lang', 'ar');

        // مفتاح الكاش الفريد (يشمل معرف القسم واللغة)
        $cacheKey = $this->generateServicesCacheKey($id, $locale);

        // إمكانية التحديث القسري
        $forceRefresh = $request->has('refresh') && $request->refresh == 'true';

        return Cache::remember($cacheKey, now()->addHours(24), function () use ($id, $locale) {
            return $this->generateServicesPageData($id, $locale);
        }, $forceRefresh);
    }

    protected function generateServicesCacheKey($sectionId, $locale)
    {
        // آخر تحديث للخدمات في هذا القسم
        $lastModified = Service::where('section_id', $sectionId)
            ->max('updated_at');

        $key = "services_page_{$sectionId}_{$locale}";

        if ($lastModified && is_string($lastModified)) {
            $lastModified = Carbon::parse($lastModified);
        }
        return $lastModified ? "{$key}_{$lastModified->timestamp}" : $key;
    }

    protected function generateServicesPageData($sectionId, $locale)
    {
        app()->setLocale($locale);

        $services = Service::where('section_id', $sectionId)
            ->get()
            ->map(function ($service) use ($locale) {
                return [
                    'id' => $service->id,
                    'name' => $this->getTranslatedValue($service->name, $locale),
                    'description' => $this->getTranslatedValue($service->description, $locale),
                    'section_id' => $service->section_id,
                    'created_at' => $service->created_at,
                    'updated_at' => $service->updated_at,
                    'image' => $service->image
                ];
            });

        return view('services', [
            'services' => $services,
            'locale' => $locale,
            'sectionId' => $sectionId, // إضافة معرف القسم للقالب
            'socialMedia' => Setting::getSocialMediaLinks(),
            'contactInfo' => Setting::getContactInfo()
        ])->render();
    }
    public function showServicesDetailesPage(Request $request, $id)
    {
        $locale = $request->get('lang', 'ar');

        // مفتاح الكاش الفريد (يشمل معرف الخدمة واللغة)
        $cacheKey = $this->generateServiceDetailsCacheKey($id, $locale);

        // إمكانية التحديث القسري
        $forceRefresh = $request->has('refresh') && $request->refresh == 'true';

        return Cache::remember($cacheKey, now()->addHours(24), function () use ($id, $locale) {
            return $this->generateServiceDetailsPageData($id, $locale);
        }, $forceRefresh);
    }

    protected function generateServiceDetailsCacheKey($serviceId, $locale)
    {
        // آخر تحديث للخدمة أو مقالاتها
        $lastModified = max(
            Service::where('id', $serviceId)->value('updated_at'),
            Article::where('service_id', $serviceId)->max('updated_at')
        );

        $key = "service_details_{$serviceId}_{$locale}";

        if ($lastModified && is_string($lastModified)) {
            $lastModified = Carbon::parse($lastModified);
        }
        return $lastModified ? "{$key}_{$lastModified->timestamp}" : $key;
    }

    protected function generateServiceDetailsPageData($serviceId, $locale)
    {
        app()->setLocale($locale);

        $service = Service::with('articles')->findOrFail($serviceId);

        $translatedService = [
            'id' => $service->id,
            'name' => $service->getTranslatedAttribute('name', $locale) ?? $service->name,
            'description' => $service->getTranslatedAttribute('description', $locale) ?? $service->description,
            'section_id' => $service->section_id,
            'created_at' => $service->created_at,
            'updated_at' => $service->updated_at,
            'image' => $service->image,
            'articles' => $service->articles->map(function ($article) use ($locale) {
                return [
                    'id' => $article->id,
                    'title' => $article->getTranslatedAttribute('title', $locale) ?? $article->title,
                    'content' => $article->getTranslatedContent($locale),
                    'service_id' => $article->service_id,
                    'created_at' => $article->created_at,
                    'updated_at' => $article->updated_at
                ];
            })
        ];

        return view('servicesdetailes', [
            'service' => $translatedService,
            'locale' => $locale,
            'socialMedia' => Setting::getSocialMediaLinks(),
            'contactInfo' => Setting::getContactInfo()
        ])->render();
    }

    public function showArticlePage(Request $request, $id)
    {
        $locale = $request->get('lang', 'ar');

        // مفتاح الكاش الفريد (يشمل معرف المقال واللغة)
        $cacheKey = $this->generateArticleCacheKey($id, $locale);

        // إمكانية التحديث القسري
        $forceRefresh = $request->has('refresh') && $request->refresh == 'true';

        return Cache::remember($cacheKey, now()->addHours(24), function () use ($id, $locale) {
            return $this->generateArticlePageData($id, $locale);
        }, $forceRefresh);
    }

    protected function generateArticleCacheKey($id)
{
    // الحصول على تاريخ تحديث المقال
    $articleLastModified = Article::where('id', $id)->value('updated_at');
    
    // إذا كنت تحتاج إلى تاريخ تحديث الخدمة المرتبطة
    // $serviceLastModified = Service::where(...)->value('updated_at');
    
    $lastModified = null;
    
    if ($articleLastModified) {
        $lastModified = Carbon::parse($articleLastModified);
    }
    
    // إذا كنت تستخدم تاريخ تحديث الخدمة أيضاً
    /*
    if ($serviceLastModified) {
        $serviceDate = Carbon::parse($serviceLastModified);
        $lastModified = $lastModified ? max($lastModified, $serviceDate) : $serviceDate;
    }
    */
    
    $key = "article_{$id}";
    
    return $lastModified ? "{$key}_{$lastModified->timestamp}" : $key;
}

    protected function generateArticlePageData($articleId, $locale)
    {
        app()->setLocale($locale);

        $article = Article::with('service')->findOrFail($articleId);

        $translatedArticle = [
            'id' => $article->id,
            'title' => $article->getTranslatedAttribute('title', $locale) ?? $article->title,
            'content' => $article->getTranslatedContent($locale),
            'service_id' => $article->service_id,
            'created_at' => $article->created_at,
            'updated_at' => $article->updated_at,
            'image' => $article->image,
            'service' => $article->service ? [
                'id' => $article->service->id,
                'name' => $article->service->getTranslatedAttribute('name', $locale) ?? $article->service->name,
            ] : null
        ];

        return view('article', [
            'article' => $translatedArticle,
            'locale' => $locale,
            'socialMedia' => Setting::getSocialMediaLinks(),
            'contactInfo' => Setting::getContactInfo()
        ])->render();
    }
    public function showContactInfoPage(Request $request)
    {
        $locale = $request->get('lang', 'ar');
        app()->setLocale($locale);

        $cacheKey = $this->generateContactInfoCacheKey();
        $forceRefresh = $request->has('refresh') && $request->refresh == 'true';

        return Cache::remember($cacheKey, now()->addHours(24), function () {
            return $this->generateContactInfoPageData();
        }, $forceRefresh);
    }

    protected function generateContactInfoCacheKey()
    {
        $lastModified = Setting::whereIn('section', ['contact_info', 'social_media'])
            ->max('updated_at');

        return $lastModified ? "contact_info_{$lastModified->timestamp}" : "contact_info";
    }

    protected function generateContactInfoPageData()
    {
        $contactInfo = Setting::where('section', 'contact_info')->first();
        $socialMedia = Setting::where('section', 'social_media')->first();

        $contactData = [
            'phones' => isset($contactInfo->phones) ? explode(',', $contactInfo->phones) : [],
            'emails' => isset($contactInfo->emails) ? explode(',', $contactInfo->emails) : [],
            'address' => $contactInfo->address ?? null,
            'working_hours' => $contactInfo->working_hours ?? null
        ];

        $socialData = [
            'facebook' => $socialMedia->facebook ?? null,
            'twitter' => $socialMedia->twitter ?? null,
            'linkedin' => $socialMedia->linkedin ?? null,
            'instagram' => $socialMedia->instagram ?? null,
            'youtube' => $socialMedia->youtube ?? null
        ];

        return view('compliants', [
            'contactInfo' => $contactData,
            'socialMedia' => $socialData
        ])->render();
    }

    public function showVolunteerPage(Request $request, $id)
    {
        $locale = $request->get('lang', 'ar');

        $cacheKey = $this->generateVolunteerCacheKey($id, $locale);
        $forceRefresh = $request->has('refresh') && $request->refresh == 'true';

        return Cache::remember($cacheKey, now()->addHours(24), function () use ($id, $locale) {
            return $this->generateVolunteerPageData($id, $locale);
        }, $forceRefresh);
    }

    protected function generateVolunteerCacheKey($volunteerId, $locale)
    {
        $lastModified = Volunteer::where('id', $volunteerId)
            ->value('updated_at');

        $key = "volunteer_{$volunteerId}_{$locale}";
        return $lastModified ? "{$key}_{$lastModified->timestamp}" : $key;
    }

    protected function generateVolunteerPageData($volunteerId, $locale)
    {
        app()->setLocale($locale);

        $volunteer = Volunteer::findOrFail($volunteerId);

        $translatedVolunteer = [
            'id' => $volunteer->id,
            'name' => $volunteer->getTranslation('name', $locale) ?? $volunteer->name,
            'email' => $volunteer->email,
            'phone' => $volunteer->phone,
            'national_id' => $volunteer->national_id,
            'birth_date' => $volunteer->birth_date,
            'gender' => $volunteer->getTranslation('gender', $locale) ?? $volunteer->gender,
            'profession' => $volunteer->getTranslation('profession', $locale) ?? $volunteer->profession,
            'skills' => $volunteer->getTranslation('skills', $locale) ?? $volunteer->skills,
            'availability' => $volunteer->getTranslation('availability', $locale) ?? $volunteer->availability,
            'join_date' => $volunteer->join_date,
            'is_active' => $volunteer->is_active,
            'profile_photo' => $volunteer->profile_photo,
            'CV' => $volunteer->CV,
            'notes' => $volunteer->getTranslation('notes', $locale) ?? $volunteer->notes,
        ];

        return view('volunteer', [
            'volunteer' => $translatedVolunteer,
            'locale' => $locale,
            'socialMedia' => Setting::getSocialMediaLinks(),
            'contactInfo' => Setting::getContactInfo()
        ])->render();
    }
}
