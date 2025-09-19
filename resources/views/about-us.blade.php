<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $dir }}">

<head>
    <link rel="icon" href="{{ asset('logo.png') }}">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="{{ $locale }}">
    <meta name="description" content="{{ __('main.site_subname') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>{{ __('main.site_name') }} - {{ __('titles.about_us') }}</title>

    {{-- Preload --}}
    <link rel="preload" href="{{ asset('css/about-us.css') }}" as="style">
    <link rel="preload" href="{{ asset('/logo.png') }}" as="image">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </noscript>

    <link href="{{ asset('css/about-us.css') }}" rel="stylesheet">

    <link rel="preload" href="{{ asset('/ima1.webp') }}" as="image">
    <link rel="preload" href="{{ asset('/ima2.webp') }}" as="image">
    <link rel="preload" href="{{ asset('/ima3.webp') }}" as="image">



    @php
        // Helper: ارجع نفس الـ URL الحالي لكن مع استبدال البادئة للّغة
        $swapLocaleUrl = function (string $lang) {
            $segments = request()->segments(); // ['ar','home','about-us'...] أو بدون بادئة
            if (!empty($segments) && in_array($segments[0], ['ar', 'en'], true)) {
                $segments[0] = $lang; // بدّل أول جزء
            } else {
                array_unshift($segments, $lang); // أضف البادئة إن لم تكن موجودة
            }
            return url(implode('/', $segments));
        };
    @endphp
</head>

<body>
    {{-- خلفية متغيرة --}}
    <div class="background-slideshow">
        <img src="{{ asset('/ima1.webp') }}" class="active" alt="">
        <img src="{{ asset('/ima2.webp') }}" alt="">
        <img src="{{ asset('/ima3.webp') }}" alt="">
    </div>

    <header id="siteHeader" class="header">
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
                        {{-- ✅ جميع الروابط تمرّر locale --}}
                        <li><a href="{{ route('home', ['locale' => $locale]) }}">{{ __('main.menu.home') }}</a></li>
                        <li><a
                                href="{{ route('sections', ['locale' => $locale]) }}">{{ __('main.menu.services') }}</a>
                        </li>
                        <li><a href="{{ route('events', ['locale' => $locale]) }}">{{ __('main.menu.news') }}</a></li>
                        <li><a
                                href="{{ route('compliants', ['locale' => $locale]) }}">{{ __('main.menu.contact') }}</a>
                        </li>

                        {{-- سويتشر اللغة: يبدّل البادئة في نفس الصفحة --}}
                        <li class="language-switcher">
                            <button class="language-btn" type="button">
                                <i class="fas fa-globe"></i>
                                <span class="current-lang">{{ $locale === 'ar' ? 'العربية' : 'English' }}</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <ul class="language-menu">
                                <li><a href="{{ $swapLocaleUrl('ar') }}"><i class="fas fa-language"></i> العربية</a>
                                </li>
                                <li><a href="{{ $swapLocaleUrl('en') }}"><i class="fas fa-language"></i> English</a>
                                </li>
                            </ul>
                        </li>

                        @if (Auth::guard('custom')->check())
                            <li class="login-btn">
                                <a href="{{ route('logout', ['locale' => $locale]) }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('main.buttons.logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout', ['locale' => $locale]) }}"
                                    method="POST" style="display:none;">
                                    @csrf
                                </form>
                            </li>
                        @else
                            <li class="login-btn">
                                <a
                                    href="{{ route('login', ['locale' => $locale]) }}">{{ __('main.buttons.login') }}</a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>
        {{-- قسم من نحن --}}
        <section class="section">
            <div class="container">
                @php
                    $aboutContent = '';
                    $aboutImage = null;

                    if (is_string($aboutUs)) {
                        $aboutContent = $aboutUs;
                    } elseif ($aboutUs instanceof \App\Models\Setting) {
                        // لا تستخدم أي JS لاستبدال النص؛ نقرأ الترجمة مباشرة
                        $aboutContent =
                            $aboutUs->getTranslation('content', app()->getLocale(), true) ?? __('No content available');
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

    {{-- Footer --}}
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
                        <li><a href="{{ route('home', ['locale' => $locale]) }}">{{ __('main.menu.home') }}</a></li>
                        <li><a
                                href="{{ route('sections', ['locale' => $locale]) }}">{{ __('main.menu.services') }}</a>
                        </li>
                        <li><a href="{{ route('events', ['locale' => $locale]) }}">{{ __('main.menu.news') }}</a>
                        </li>
                        <li><a
                                href="{{ route('compliants', ['locale' => $locale]) }}">{{ __('main.menu.contact') }}</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} {{ __('main.site_name') }}. {{ __('main.footer.copyright') }}</p>
                <div class="social-icons">
                    @if (isset($socialMedia['facebook']))
                        <a href="{{ $socialMedia['facebook'] }}"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    {{-- @if (isset($socialMedia['twitter']))
                        <a href="{{ $socialMedia['twitter'] }}"><i class="fab fa-twitter"></i></a>
                    @endif
                    @if (isset($socialMedia['linkedin']))
                        <a href="{{ $socialMedia['linkedin'] }}"><i class="fab fa-linkedin-in"></i></a>
                    @endif --}}
                    @if (isset($socialMedia['instagram']))
                        <a href="{{ $socialMedia['instagram'] }}"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if (isset($socialMedia['youtube']))
                        <a href="{{ $socialMedia['youtube'] }}" target="_blank"><i class="fab fa-youtube"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </footer>

    {{-- JS: فقط سلوكيات واجهة بدون تبديل نصوص --}}
    <script src="{{ asset('js/about-us.js') }}" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.getElementById('siteHeader');

            function setHeaderPad() {
                if (!header) return;
                document.documentElement.style.setProperty('--header-dyn', header.offsetHeight + 'px');
            }
            setHeaderPad();
            window.addEventListener('resize', setHeaderPad);

            function toggleHeader() {
                if (window.scrollY > 0) header.classList.add('is-hidden');
                else header.classList.remove('is-hidden');
            }
            toggleHeader();
            document.addEventListener('scroll', toggleHeader, {
                passive: true
            });
        });
    </script>
</body>

</html>
