<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale()==='ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="{{ $locale }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>{{ __('main.site_name') }} - {{ __('titles.sections') }}</title>

    <!-- Preload الموارد الحرجة -->
    <link rel="preload" href="{{ asset('css/sections.css') }}" as="style">
    <link rel="preload" href="{{ asset('/logo.png') }}" as="image" type="image/png">

    <!-- تحميل Font Awesome بشكل غير متزامن -->
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </noscript>

    <!-- تحسين تحميل الصور -->
    <link rel="preload" href="{{ asset('/ima1.webp') }}" as="image" type="image/webp">
    <link rel="preload" href="{{ asset('/ima2.webp') }}" as="image" type="image/webp">
    <link rel="preload" href="{{ asset('/ima3.webp') }}" as="image" type="image/webp">

    <!-- تحميل CSS بشكل غير متزامن -->
    <link href="{{ asset('css/sections.css') }}" rel="stylesheet" media="print" onload="this.media='all'">
</head>

<body>
    <!-- تحسين خلفية Slideshow -->
    <div class="background-slideshow">
        <img src="{{ asset('/ima1.webp') }}" class="active" alt="خلفية 1" loading="lazy" width="1920"
            height="1080">
        <img src="{{ asset('/ima2.webp') }}" alt="خلفية 2" loading="lazy" width="1920" height="1080">
        <img src="{{ asset('/ima3.webp') }}" alt="خلفية 3" loading="lazy" width="1920" height="1080">
    </div>

    <header id="siteHeader" class="header">
        <div class="container">
            <div class="logo-container">
                <div class="logo">
                    <img src="{{ asset('/logo.png') }}" alt="{{ __('main.site_name') }}" width="50" height="50"
                        loading="eager">
                </div>
                <div class="org-name">
                    <span class="org-name-line1">{{ __('main.site_name') }}</span>
                    <span class="org-name-line2">{{ __('main.site_subname') }}</span>
                </div>
            </div>
            <div class="buttons-container">
                <nav class="nav">
                    <ul class="nav-list">
                        <li><a href="{{ route('home') }}">{{ __('main.menu.home') }}</a></li>
                        <li><a href="{{ route('about-us') }}">{{ __('main.menu.about') }}</a></li>
                        <li><a href="{{ route('events') }}">{{ __('main.menu.news') }}</a></li>
                        <li><a href="{{ route('compliants') }}">{{ __('main.menu.contact') }}</a></li>
                        <li class="language-switcher" style="list-style: none;">
                            <button class="language-btn" aria-label="Change language">
                                <i class="fas fa-globe"></i>
                                <span class="current-lang">{{ $locale == 'ar' ? 'العربية' : 'English' }}</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <ul class="language-menu">
                                <li><a href="#" data-lang="ar"><i class="fas fa-language"></i> العربية</a></li>
                                <li><a href="#" data-lang="en"><i class="fas fa-language"></i> English</a></li>
                            </ul>
                        </li>
                        <li class="login-btn">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('main.buttons.logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- القسم الرئيسي -->
    <main>
        <section class="section">
            <div class="container">
                <h1 class="section-title">{{ __('main.titles.sections') }}</h1>
                <div class="sections-container">
                    @foreach ($sections as $index => $section)
                        <div class="section-card" style="animation-delay: {{ $index * 0.1 }}s">
                            <div class="section-image-container">
                                @if ($section['image'])
                                    <img src="{{ asset('storage/' . $section['image']) }}"
                                        alt="{{ $section['name'] }}" class="section-image" loading="lazy"
                                        width="300" height="200">
                                @else
                                    <img src="{{ asset('/default-section.jpg') }}"
                                        alt="{{ __('main.default_image') }}" class="section-image" loading="lazy"
                                        width="300" height="200">
                                @endif
                            </div>
                            <div class="section-content">
                                <h3 class="section-title-card">{{ $section['name'] }}</h3>
                                <span class="services-count">{{ count($section['services']) }}
                                    {{ __('main.titles.services_count') }}</span>
                                <p class="section-description">{{ Str::limit($section['description'], 100) }}</p>
                                <a href="{{ route('services', ['section' => $section['id']]) }}"
                                    class="explore-btn">{{ __('main.buttons.explore') }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>

    <!-- تذييل الصفحة -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <!-- قسم الشعار والمعلومات -->
                <div class="footer-logo">
                    <img src="{{ asset('logo.png') }}"  alt="{{ __('main.site_name') }}" width="50" height="50"
                        loading="lazy">
                    <p>{{ __('main.site_name') }}<br>
                        <span style="color: var(--secondary-color);">{{ __('main.site_subname') }}</span>
                    </p>
                </div>

                <!-- قسم الروابط السريعة -->
                <div class="footer-links">
                    <h4>{{ __('main.footer.quick_links') }}</h4>
                    <ul>
                        <li><a href="{{ route('events') }}">{{ __('main.menu.news') }}</a></li>
                        <li><a href="{{ route('sections') }}">{{ __('main.menu.services') }}</a></li>
                        <li><a href="{{ route('compliants') }}">{{ __('main.menu.contact') }}</a></li>
                        <li><a href="{{ route('home') }}">{{ __('main.menu.home') }}</a></li>
                    </ul>
                </div>
            </div>

            <!-- حقوق النشر ووسائل التواصل الاجتماعي -->
            <div class="footer-bottom">
                <p>{{ __('main.footer.copyright') }} &copy; {{ date('Y') }}</p>
                <div class="social-icons">
                    @if (isset($socialMedia['facebook']))
                        <a href="{{ $socialMedia['facebook'] }}" target="_blank" rel="noopener noreferrer"><i
                                class="fab fa-facebook-f"></i></a>
                    @endif
                    @if (isset($socialMedia['twitter']))
                        <a href="{{ $socialMedia['twitter'] }}" target="_blank" rel="noopener noreferrer"><i
                                class="fab fa-twitter"></i></a>
                    @endif
                    @if (isset($socialMedia['linkedin']))
                        <a href="{{ $socialMedia['linkedin'] }}" target="_blank" rel="noopener noreferrer"><i
                                class="fab fa-linkedin-in"></i></a>
                    @endif
                    @if (isset($socialMedia['instagram']))
                        <a href="{{ $socialMedia['instagram'] }}" target="_blank" rel="noopener noreferrer"><i
                                class="fab fa-instagram"></i></a>
                    @endif
                    @if (isset($socialMedia['youtube']))
                        <a href="{{ $socialMedia['youtube'] }}" target="_blank" rel="noopener noreferrer"><i
                                class="fab fa-youtube"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </footer>

    <!-- تحميل JavaScript بشكل غير متزامن -->
    <script src="{{ asset('js/sections.js') }}" defer></script>

    <!-- Preload الصور التالية للخلفية -->
    <link rel="preload" href="{{ asset('/ima2.webp') }}" as="image" media="(min-width: 800px)">


</body>

</html>
