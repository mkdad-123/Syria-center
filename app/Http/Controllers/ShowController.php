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
    use App\Services\Cache\{CacheService, CacheKeyService};
    use App\Services\Pages\{
        HomePageService,
        AboutUsService,
        EventsPageService,
        SectionsPageService,
        ServicesPageService,
        ServiceDetailsPageService,
        ArticlePageService,
        ContactPageService
    };

    class ShowController extends Controller
    {
        public function __construct(
            private CacheService $cache,
            private CacheKeyService $keys,
            private HomePageService $homePage,
            private AboutUsService $aboutPage,
            private EventsPageService $eventsPage,
            private SectionsPageService $sectionsPage,
            private ServicesPageService $servicesPage,
            private ServiceDetailsPageService $serviceDetailsPage,
            private ArticlePageService $articlePage,
            private ContactPageService $contactPage
        ) {}

        public function showHomePage(Request $request)
        {
            $locale = $request->get('lang', 'ar');
            $force  = $request->boolean('refresh');
            $key    = $this->keys->home($locale);

            return $this->cache->remember($key, now()->addHours(24), fn() =>
                $this->homePage->render($locale)
            , $force);
        }

        public function showAbout_usPage(Request $request)
        {
            $locale = $request->get('lang', 'ar');
            $force  = $request->boolean('refresh');
            $key    = $this->keys->about($locale);

            return $this->cache->remember($key, now()->addHours(24), fn() =>
                $this->aboutPage->render($locale)
            , $force);
        }

        public function showEventsPage(Request $request)
        {
            $locale = $request->get('lang', 'ar');
            $force  = $request->boolean('refresh');
            $key    = $this->keys->events($locale);

            return $this->cache->remember($key, now()->addHours(24), fn() =>
                $this->eventsPage->render($locale)
            , $force);
        }

        public function showSectionsPage(Request $request)
        {
            $locale = $request->get('lang', 'ar');
            $force  = $request->boolean('refresh');
            $key    = $this->keys->sections($locale);

            return $this->cache->remember($key, now()->addHours(24), fn() =>
                $this->sectionsPage->render($locale)
            , $force);
        }

        public function showServicesPage(Request $request, $id)
        {
            $locale = $request->get('lang', 'ar');
            $force  = $request->boolean('refresh');
            $key    = $this->keys->servicesList((int)$id, $locale);

            return $this->cache->remember($key, now()->addHours(24), fn() =>
                $this->servicesPage->render($locale, ['section_id' => (int)$id])
            , $force);
        }

        public function showServicesDetailesPage(Request $request, $id)
        {
            $locale = $request->get('lang', 'ar');
            $force  = $request->boolean('refresh');
            $key    = $this->keys->serviceDetails((int)$id, $locale);

            return $this->cache->remember($key, now()->addHours(24), fn() =>
                $this->serviceDetailsPage->render($locale, ['service_id' => (int)$id])
            , $force);
        }

        public function showArticlePage(Request $request, $id)
        {
            $locale = $request->get('lang', 'ar');
            $force  = $request->boolean('refresh');
            $key    = $this->keys->article((int)$id);

            return $this->cache->remember($key, now()->addHours(24), fn() =>
                $this->articlePage->render($locale, ['article_id' => (int)$id])
            , $force);
        }

        public function showContactInfoPage(Request $request)
        {
            $locale = $request->get('lang', 'ar');
            app()->setLocale($locale);

            $force  = $request->boolean('refresh');
            $key    = $this->keys->contact();

            return $this->cache->remember($key, now()->addHours(24), fn() =>
                $this->contactPage->render($locale)
            , $force);
        }
    }
