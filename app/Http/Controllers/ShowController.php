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
        $targetgroup = Setting::where('section', 'target group')->first();
    
        // فريق العمل مع ترجمة آمنة
        $team = Volunteer::all()->map(function($member) use ($locale) {
            return [
                'id' => $member->id,
                'name' => $this->safeGetTranslation($member, 'name', $locale),
                'profession' => $this->safeGetTranslation($member, 'profession', $locale),
                'bio' => $this->safeGetTranslation($member, 'bio', $locale),
                'image' => $member->image ?? 'default-member.jpg'
            ];
        });
    
        // الشركاء مع ترجمة آمنة
        $partners = Partner::all()->map(function($partner) use ($locale) {
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

    public function showAbout_usPage()
    {
        // جلب المحتوى حيث section = 'about-us'
        $aboutUs = Setting::where('section', 'about-us')->first();
        if (!$aboutUs) {
            return response()->json([
                'message' => 'Content not found',
                'data' => null
            ], 404);
        }
        return view('about-us', compact('aboutUs'));
    }

    public function showEventsPage()
    {
        $events = Event::where('is_published', '1')
            ->orderByDesc('id')
            ->get();
        return view('events', compact('events'));
    }

    public function showSectionsPage()
    {
        $sections = Section::with('services')->get();

        return view('sections', compact('sections'));
    }


    public function showServicesPage($id)
    {
        $services = Service::where('section_id', $id)->get();

        return view('services', compact('services'));
    }

    public function showServicesDetailesPage($id)
    {
        $service = Service::with('articles')->findOrFail($id);

        return view('servicesdetailes', compact('service'));
    }

    public function showArticlePage($id)
    {
        $article = Article::where('id' , $id )->get();

        return view('article', compact('article'));
    }

    public function showContactInfoPage()
    {
        // الحصول على بيانات التواصل من الكاش أو من الداتابيز
        $contactInfo = Setting::getContactInfo() ?? [
            'emails' => [],
            'phones' => [],
            'mobile_numbers' => [],
            'address' => null,
            'working_hours' => null
        ];

        // الحصول على روابط السوشيال ميديا
        $socialMedia = Setting::getSocialMediaLinks() ?? [
            'facebook' => null,
            'instagram' => null,
            'twitter' => null,
            'youtube' => null,
            'linkedin' => null
        ];

        return view('compliants',compact('socialMedia','contactInfo'));

    }

    public  function showVolunteerPage($id)  {

    $volunteer = Volunteer::findOrFail($id); // Get single volunteer

    return view('volunteer', compact('volunteer'));


    }
}
