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
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {   Service::observe(ServiceDetailsObserver::class);
        Article::observe(ArticleObserver::class);
        Section::observe(SectionObserver::class);
        Service::observe(ServiceObserver::class);
        Event::observe(EventObserver::class);
        Setting::observe(SettingObserver::class);
        Volunteer::observe(VolunteerObserver::class);
        Partner::observe(PartnerObserver::class);
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['ar','en']);

        });

        URL::defaults(['lang' => app()->getLocale()]);

        Route::pattern('lang', 'ar|en');
        $this->configureRateLimiting();

    }
protected function configureRateLimiting()
{
    RateLimiter::for('login', function (Request $request) {
        return Limit::perMinute(5)
            ->by($request->ip())
            ->response(function (Request $request) {  // <-- أضف Request هنا
                return back()->withErrors([
                    'name' => trans('auth.throttle', ['seconds' => 60]),
                ])->withInput($request->only('name', 'remember'));
            });
    });
}
}
