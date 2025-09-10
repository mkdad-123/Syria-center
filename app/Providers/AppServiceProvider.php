<?php

namespace App\Providers;

use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use App\Models\Partner;
use App\Models\Setting;
use App\Models\Volunteer;
use App\Models\Event;
use App\Models\Service;
use App\Models\Section;
use App\Models\Article;
use App\Observers\EventObserver;
use App\Observers\ServiceObserver;
use App\Observers\ServiceDetailsObserver;
use App\Observers\ArticleObserver;
use App\Observers\SectionObserver;
use App\Observers\PartnerObserver;
use App\Observers\SettingObserver;
use App\Observers\VolunteerObserver;
use App\Services\Support\SettingReader;
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

class AppServiceProvider extends ServiceProvider
{


    public function register(): void
    {
        // Helpers
        $this->app->singleton(SettingReader::class);
        $this->app->singleton(CacheService::class);
        $this->app->singleton(CacheKeyService::class);

        $this->app->singleton(HomePageService::class, fn($app) => new HomePageService($app->make(SettingReader::class)));
        $this->app->singleton(AboutUsService::class, fn($app) => new AboutUsService($app->make(SettingReader::class)));
        $this->app->singleton(EventsPageService::class, fn($app) => new EventsPageService($app->make(SettingReader::class)));
        $this->app->singleton(SectionsPageService::class, fn($app) => new SectionsPageService($app->make(SettingReader::class)));
        $this->app->singleton(ServicesPageService::class, fn($app) => new ServicesPageService($app->make(SettingReader::class)));
        $this->app->singleton(ServiceDetailsPageService::class, fn($app) => new ServiceDetailsPageService($app->make(SettingReader::class)));
        $this->app->singleton(ArticlePageService::class, fn($app) => new ArticlePageService($app->make(SettingReader::class)));
        $this->app->singleton(ContactPageService::class, fn($app) => new ContactPageService($app->make(SettingReader::class)));
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Service::observe(ServiceDetailsObserver::class);
        Article::observe(ArticleObserver::class);
        Section::observe(SectionObserver::class);
        Service::observe(ServiceObserver::class);
        Event::observe(EventObserver::class);
        Setting::observe(SettingObserver::class);
        Volunteer::observe(VolunteerObserver::class);
        Partner::observe(PartnerObserver::class);
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['ar', 'en']);
        });

        URL::defaults(['lang' => app()->getLocale()]);

        Route::pattern('lang', 'ar|en');
        $this->configureRateLimiting();
    }
    protected function configureRateLimiting()
    {
        RateLimiter::for('login', function (Request $request) {
            $key = sprintf('login:%s|%s', $request->ip(), (string) $request->input('name'));

            return Limit::perMinute(5)
                ->by($key)
                ->response(function (Request $request) {
                    return back()->withErrors([
                        'name' => trans('auth.throttle', ['seconds' => 60]),
                    ])->withInput($request->only('name', 'remember'));
                });
        });
    }
}
