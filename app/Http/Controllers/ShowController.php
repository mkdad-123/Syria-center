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

class ShowController extends Controller
{

    public function showHomePage(Request $request)
    {
        // تحديد اللغة
        $locale = $request->has('lang') ? $request->lang : 'ar';
        app()->setLocale($locale);

        // جلب المحتوى مع التعامل الآمن مع القيم الفارغة
        $aboutUs = Setting::where('section', 'about-us')->first();
        $vision = Setting::where('section', 'vision')->first();
        $message = Setting::where('section', 'message')->first();
        $targetgroup = Setting::where('section', 'target-group')->first();

        // فريق العمل مع ترجمة آمنة
        $team = Volunteer::all()->map(function ($member) use ($locale) {
            return [
                'id' => $member->id,
                'name' => $this->safeGetTranslation($member, 'name', $locale),
                'profession' => $this->safeGetTranslation($member, 'profession', $locale),
                'bio' => $this->safeGetTranslation($member, 'notes', $locale),
                'image' => $member->profile_photo ?? 'default-member.jpg'
            ];
        });

        // الشركاء مع ترجمة آمنة
        $partners = Partner::all()->map(function ($partner) use ($locale) {
            return [
                'id' => $partner->id,
                'name' => $this->safeGetTranslation($partner, 'name', $locale),
                'description' => $this->safeGetTranslation($partner, 'description', $locale),
                'image' => $partner->image ?? 'default-partner.jpg'
            ];
        });

        // معلومات التواصل ووسائل التواصل الاجتماعي
        $socialMedia = Setting::getSocialMediaLinks();
        $contactInfo = Setting::getContactInfo();

        return view('welcome', [
            'locale' => $locale,
            'aboutUs' => $this->getSafeContent($aboutUs, $locale),
            'targetgroup' => $this->getSafeContent($targetgroup, $locale),
            'message' => $this->getSafeContent($message, $locale),
            'vision' => $this->getSafeContent($vision, $locale),
            'team' => $team,
            'partners' => $partners,
            'socialMedia' => $socialMedia,
            'contactInfo' => $contactInfo
        ]);
    }

    // دالة مساعدة للحصول على الترجمة بشكل آمن
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

    // دالة مساعدة للحصول على المحتوى بشكل آمن
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
        // تحديد اللغة
        $locale = $request->has('lang') ? $request->lang : 'ar';
        app()->setLocale($locale);

        // جلب محتوى about-us مع التعامل الآمن مع القيم الفارغة
        $aboutUs = Setting::where('section', 'about-us')->first();

        if (!$aboutUs) {
            return response()->json([
                'message' => __('Content not found'),
                'data' => null
            ], 404);
        }

        // معلومات التواصل ووسائل التواصل الاجتماعي
        $socialMedia = Setting::getSocialMediaLinks();
        $contactInfo = Setting::getContactInfo();
        $image = $aboutUs->image ;
        return view('about-us', [
            'locale' => $locale,
            'aboutUs' => $this->getSafeContent($aboutUs, $locale),
            'socialMedia' => $socialMedia,
            'contactInfo' => $contactInfo,
            'image' => $image ,
        ]);
    }

    public function showEventsPage(Request $request)
    {
        $locale = $request->has('lang') ? $request->lang : 'ar';
        app()->setLocale($locale);
    
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
    
        return view('events', [
            'events' => $events,
            'locale' => $locale
        ]);
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
        // تحديد اللغة
        $locale = $request->has('lang') ? $request->lang : 'ar';
        app()->setLocale($locale);

        // جلب الأقسام مع الخدمات المرتبطة بها
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
                            // أضف باقي حقول الخدمة هنا
                        ];
                    }),
                    'created_at' => $section->created_at,
                    'updated_at' => $section->updated_at
                ];
            });

        return view('sections', [
            'sections' => $sections,
            'locale' => $locale
        ]);
    }

    public function showServicesPage(Request $request, $id)
    {
        // Set the locale with fallback to 'ar'
        $locale = $request->get('lang', 'ar');
        app()->setLocale($locale);

        // Get services with translations
        $services = Service::where('section_id', $id)
            ->get()
            ->map(function ($service) use ($locale) {
                return [
                    'id' => $service->id,
                    'name' => $this->getTranslatedValue($service->name, $locale),
                    'description' => $this->getTranslatedValue($service->description, $locale),
                    'section_id' => $service->section_id,
                    'created_at' => $service->created_at,
                    'updated_at' => $service->updated_at,
                    'image'     => $service->image
                    // Include any other fields you need
                ];
            });

        return view('services', [
            'services' => $services,
            'locale' => $locale
        ]);
    }

    public function showServicesDetailesPage(Request $request, $id)
{
    // Set the locale with fallback to 'ar'
    $locale = $request->get('lang', 'ar');
    app()->setLocale($locale);

    // Get the service with its articles
    $service = Service::with('articles')->findOrFail($id);

    // Prepare translated service data
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
        'locale' => $locale
    ]);
}

public function showArticlePage(Request $request, $id)
{
    // تعيين اللغة مع التراجع للغة العربية
    $locale = $request->get('lang', 'ar');
    app()->setLocale($locale);

    // جلب المقال مع الخدمة المرتبطة
    $article = Article::with('service')->findOrFail($id);

    // إعداد بيانات المقال المترجمة
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
        'locale' => $locale
    ]);
}
public function showContactInfoPage()
{
    $contactInfo = Setting::where('section', 'contact_info')->first();
    $socialMedia = Setting::where('section', 'social_media')->first();

    // تحويل البيانات إلى تنسيق صحيح
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
    ]);
}

    public function showVolunteerPage(Request $request, $id)
{
    // Set the locale with fallback to 'ar'
    $locale = $request->get('lang', 'ar');
    app()->setLocale($locale);

    // Get the volunteer with translations
    $volunteer = Volunteer::findOrFail($id);

    // Prepare translated volunteer data
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
        'locale' => $locale
    ]);
}
}
