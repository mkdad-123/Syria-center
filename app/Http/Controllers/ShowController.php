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

    public function showServicesPage(Request $request, $id)
    {
        $locale    = app()->getLocale();
        $force     = $request->boolean('refresh');
        $sectionId = (int) $id;

        return $this->servicesPage->render($locale, [
            'section_id' => $sectionId,
            'refresh'    => $force,
        ]);
    }

    public function showServicesDetailesPage(Request $request, $id)
    {
        $locale    = app()->getLocale();
        $force     = $request->boolean('refresh');
        $serviceId = (int) $id;

        return $this->serviceDetailsPage->render($locale, [
            'service_id' => $serviceId,
            'refresh'    => $force,
        ]);
    }

    public function showArticlePage(Request $request, $id)
    {
        $locale    = app()->getLocale();
        $force     = $request->boolean('refresh');
        $articleId = (int) $id;

        return $this->articlePage->render($locale, [
            'article_id' => $articleId,
            'refresh'    => $force,
        ]);
    }

    public function showContactInfoPage(Request $request)
    {
        $locale = app()->getLocale();
        $force  = $request->boolean('refresh');

        return $this->contactPage->render($locale, ['refresh' => $force]);
    }

    public function showVolunteerPage(Request $request, $vol)
    {
        $locale = app()->getLocale();
        $force  = $request->boolean('refresh');
        $id     = (int) $vol;

        return $this->volunteerPage->render($locale, [
            'volunteer_id' => $id,
            'refresh'      => $force,
        ]);
    }
}
