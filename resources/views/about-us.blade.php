<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $locale == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="{{ $locale }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ __('main.site_subname') }}">
    <title>{{ __('main.site_name') }} - {{ __('titles.about_us') }}</title>

    <!-- Preload أهم الموارد -->
    <link rel="preload" href="{{ asset('css/about-us.css') }}" as="style">
    <link rel="preload" href="{{ asset('/logo.png') }}" as="image">

    <!-- تحسين تحميل Font Awesome -->
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </noscript>

    <!-- تحميل CSS الأساسي -->
    <link href="{{ asset('css/about-us.css') }}" rel="stylesheet" media="print" onload="this.media='all'">

    <!-- Preload صور الخلفية -->
    <link rel="preload" href="{{ asset('/ima1.webp') }}" as="image">
    <link rel="preload" href="{{ asset('/ima2.webp') }}" as="image">
    <link rel="preload" href="{{ asset('/ima3.webp') }}" as="image">
</head>

<body>
    <!-- خلفية متغيرة للصفحة -->
    <div class="background-slideshow">
        <img src="{{ asset('/ima1.webp') }}" class="active" alt="خلفية 1">
        <img src="{{ asset('/ima2.webp') }}" alt="خلفية 2">
        <img src="{{ asset('/ima3.webp') }}" alt="خلفية 3">
    </div>

    <header class="header">
        <div class="container">
            <div class="logo-container">
                <div class="logo">
                    <img src="{{ asset('/logo.png') }}" alt="{{ __('main.site_name') }}">
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
                        <li><a href="{{ route('sections') }}">{{ __('main.menu.services') }}</a></li>
                        <li><a href="{{ route('events') }}">{{ __('main.menu.news') }}</a></li>
                        <li><a href="{{ route('compliants') }}">{{ __('main.menu.contact') }}</a></li>
                        <li class="language-switcher">
                            <button class="language-btn">
                                <i class="fas fa-globe"></i>
                                <span class="current-lang">{{ $locale == 'ar' ? 'العربية' : 'English' }}</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <ul class="language-menu">
                                <li><a href="#" data-lang="ar"><i class="fas fa-language"></i> العربية</a></li>
                                <li><a href="#" data-lang="en"><i class="fas fa-language"></i> English</a></li>
                            </ul>
                        </li>
                        @if (Auth::guard('custom')->check())
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
                        @else
                            <li class="login-btn"><a href="{{ route('login') }}">{{ __('main.buttons.login') }}</a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- القسم الرئيسي -->
    <main>
        <!-- قسم من نحن -->
        <section class="section">
            <div class="container">
                @php
                    $aboutContent = '';
                    $aboutImage = null;

                    if (is_string($aboutUs)) {
                        $aboutContent = $aboutUs;
                    } elseif ($aboutUs instanceof \App\Models\Setting) {
                        $aboutContent =
                            $aboutUs->getTranslation('content', app()->getLocale(), false) ??
                            __('No content available');
                        $aboutImage = $aboutUs->image;
                    } else {
                        $aboutContent = __('No content available');
                    }
                @endphp

                @if (!empty($image))
                    <div class="about-header-image">
                        <img src="{{ asset('storage/' . $image) }}" alt="{{ __('main.titles.about') }}"
                            class="about-hero-img">
                        <div class="about-image-overlay"></div>
                    </div>
                @endif
                <h1 class="section-title">{{ __('main.titles.about') }}</h1>
                <div class="about-content-container">
                    <div id="about-content">
                        {!! $aboutContent !!}
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- تذييل الصفحة -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="{{ asset('/logo.png') }}" alt="{{ __('main.site_name') }}">
                    <p>{{ __('main.site_name') }} - {{ __('main.site_subname') }}</p>
                </div>
                <div class="footer-links">
                    <h4>{{ __('main.footer.quick_links') }}</h4>
                    <ul>
                        <li><a href="{{ route('home') }}">{{ __('main.menu.home') }}</a></li>
                        <li><a href="{{ route('sections') }}">{{ __('main.menu.services') }}</a></li>
                        <li><a href="{{ route('events') }}">{{ __('main.menu.news') }}</a></li>
                        <li><a href="{{ route('compliants') }}">{{ __('main.menu.contact') }}</a></li>
                    </ul>
                </div>

            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} {{ __('main.site_name') }}. {{ __('main.footer.copyright') }}</p>
                <div class="social-icons">
                    @if (isset($socialMedia['facebook']))
                        <a href="{{ $socialMedia['facebook'] }}"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if (isset($socialMedia['twitter']))
                        <a href="{{ $socialMedia['twitter'] }}"><i class="fab fa-twitter"></i></a>
                    @endif
                    @if (isset($socialMedia['linkedin']))
                        <a href="{{ $socialMedia['linkedin'] }}"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                    @if (isset($socialMedia['instagram']))
                        <a href="{{ $socialMedia['instagram'] }}"><i class="fab fa-instagram"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/about-us.js') }}" defer></script>

</body>

</html>
