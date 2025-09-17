<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Pages\{
    HomePageService,
    AboutUsService,
    EventsPageService,
    SectionsPageService,
    ServicesPageService,
    ServiceDetailsPageService,
    ArticlePageService,
    ContactPageService,
    VolunteerPageService
};

class ShowController extends Controller
{
    public function __construct(
        private HomePageService          $homePage,
        private AboutUsService           $aboutPage,
        private EventsPageService        $eventsPage,
        private SectionsPageService      $sectionsPage,
        private ServicesPageService      $servicesPage,
        private ServiceDetailsPageService $serviceDetailsPage,
        private ArticlePageService       $articlePage,
        private ContactPageService       $contactPage,
        private VolunteerPageService     $volunteerPage,
    ) {}

    public function showHomePage(Request $request)
    {
        $locale = app()->getLocale();
        $force  = $request->boolean('refresh');

        // الكاش يتم داخل الخدمة
        return $this->homePage->render($locale, ['refresh' => $force]);
    }

    public function showAbout_usPage(Request $request)
    {
        $locale = app()->getLocale();
        $force  = $request->boolean('refresh');

        return $this->aboutPage->render($locale, ['refresh' => $force]);
    }

    public function showEventsPage(Request $request)
    {
        $locale = app()->getLocale();
        $force  = $request->boolean('refresh');

        return $this->eventsPage->render($locale, ['refresh' => $force]);
    }

    public function showSectionsPage(Request $request)
    {
        $locale = app()->getLocale();
        $force  = $request->boolean('refresh');

        return $this->sectionsPage->render($locale, ['refresh' => $force]);
    }
    public function showServicesPage(Request $request)
    {
        // التقط القيم صراحةً من الراوت
        $locale    = $request->route('locale') ?? app()->getLocale();
        $sectionId = (int) $request->route('section');

        if ($sectionId <= 0) {
            abort(404);
        }

        $force = $request->boolean('refresh');

        return $this->servicesPage->render($locale, [
            'section_id' => $sectionId,
            'refresh'    => $force,
        ]);
    }


    public function showServicesDetailesPage(Request $request)
    {
        // التقط القيم صراحةً من الراوت
        $locale    = $request->route('locale') ?? app()->getLocale();
        $serviceId = (int) $request->route('service'); // اسم الباراميتر من الراوت

        if ($serviceId <= 0) {
            abort(404);
        }

        return $this->serviceDetailsPage->render($locale, [
            'service_id' => $serviceId,
            'refresh'    => $request->boolean('refresh'),
        ]);
    }

    public function showArticlePage(Request $request)
    {
        $locale    = $request->route('locale') ?? app()->getLocale();
        $articleId = (int) $request->route('id');

        if ($articleId <= 0) {
            abort(404);
        }

        return $this->articlePage->render($locale, [
            'article_id' => $articleId,
            'refresh'    => $request->boolean('refresh'),
        ]);
    }


    public function showContactInfoPage(Request $request)
    {
        $locale = app()->getLocale();
        $force  = $request->boolean('refresh');

        return $this->contactPage->render($locale, ['refresh' => $force]);
    }

    public function showVolunteerPage(Request $request)
    {
        // إقرأ البادئة والـ id من الراوت مباشرة
        $locale = $request->route('locale') ?? app()->getLocale();

        // {vol} اختياري في الراوت عندك، لذلك قد يكون null
        $volId  = $request->route('vol');
        $id     = is_numeric($volId) ? (int) $volId : 0;

        // إن أردتها إلزامية:
        // if ($id <= 0) abort(404);

        return $this->volunteerPage->render($locale, [
            'volunteer_id' => $id,                        // 0 لو لم يُمرَّر
            'refresh'      => $request->boolean('refresh'),
        ]);
    }
}
